<?php

namespace LaraPlatform\Core\Http\Livewire\Common\LanguageSelector;

use LaraPlatform\Core\Facades\Core;
use LaraPlatform\Core\Livewire\Modal;

class Index extends Modal
{
    public $langs;
    public $lang_current;
    public function mount()
    {
        $this->langs = apply_filters('language_list', []);
        $this->lang_current = app()->getLocale();
    }
    public function DoSelector($lang)
    {
         Core::SwitchLanguage($lang);
         return $this->redirectCurrent();
    }
    public function render()
    {
        return $this->viewModal('core::common.language-selector.index');
    }
}
