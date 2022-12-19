<?php

namespace GateGem\Core;

use Illuminate\Support\Str;
use Livewire\LivewireManager;

class GateBladeDirectives
{
    public static function childSlot()
    {
        return "<?php
            if (isset(\$_instance) && isset(\$_instance->childSlot)) {
                echo \$_instance->childSlot;
            }
            ?>
        ";
    }
    public static function livewireG($expression)
    {
        $cachedKey = "'" . Str::random(7) . "'";

        // If we are inside a Livewire component, we know we're rendering a child.
        // Therefore, we must create a more deterministic view cache key so that
        // Livewire children are properly tracked across load balancers.
        if (LivewireManager::$currentCompilingViewPath !== null) {
            // $cachedKey = '[hash of Blade view path]-[current @livewire directive count]'
            $cachedKey = "'l" . crc32(LivewireManager::$currentCompilingViewPath) . "-" . LivewireManager::$currentCompilingChildCounter . "'";

            // We'll increment count, so each cache key inside a compiled view is unique.
            LivewireManager::$currentCompilingChildCounter++;
        }

        $pattern = "/,\s*?key\(([\s\S]*)\)/"; //everything between ",key(" and ")"
        $expression = preg_replace_callback($pattern, function ($match) use (&$cachedKey) {
            $cachedKey = trim($match[1]) ?: $cachedKey;
            return "";
        }, $expression);

        return <<<EOT
<?php
\$componentGate = \\GateGem\Core\Facades\Core::Livewire({$expression});
ob_start();
?>
EOT;
    }
    public static function endLivewireG($expression)
    {
        return "<?php
            if (isset(\$componentGate)) {
                \$__contents = ob_get_clean();
                \$componentGate->instance->childSlot=\$__contents;
                echo \$componentGate
                ->renderToView()
                ->initialDehydrate()
                ->toInitialResponse()
                ->html();
            }
            ?>
        ";
    }
}
