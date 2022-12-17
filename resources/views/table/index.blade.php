<div @if ($modal_isPage) class="page-manager" @else class="p-2" @endif
    @if (getValueByKey($option, \GateGem\Core\Support\Config\ConfigManager::POLL, '')) wire:poll.{{ getValueByKey($option,  \GateGem\Core\Support\Config\ConfigManager::POLL, '') }} @endif>
    <div @if ($modal_isPage) class="manager-table-content" @endif>
        @if ($modal_isPage)
            <div class="mb-2">
                <h4>{{ $modal_title }}</h4>
            </div>
        @endif
        @if (getValueByKey($option, \GateGem\Core\Support\Config\ConfigManager::INCLUDE_BEFORE, ''))
            @includeIf(getValueByKey($option, \GateGem\Core\Support\Config\ConfigManager::INCLUDE_BEFORE, ''))
        @endif
        <div class="mb-2 d-flex flex-row">
            <div style="flex:auto">
                @if ($checkAdd === true)
                    <button class="btn btn-primary btn-sm"
                        wire:component='{{ $viewEdit }}({"module":"{{ $module }}"})'>
                        <i class="bi bi-plus-square"></i> <span>{{ __('core::table.button.add') }}</span>
                    </button>
                @endif
                @foreach (getValueByKey($option,  \GateGem\Core\Support\Config\ConfigManager::ACTION . '.' .  \GateGem\Core\Support\Config\ConfigManager::TITLE, []) as $button)
                    @if (getValueByKey($button, \GateGem\Core\Support\Config\ButtonConfig::BUTTON_TYPE, '') ==  \GateGem\Core\Support\Config\ButtonConfig::TYPE_ADD &&
                        (!isset($button[\GateGem\Core\Support\Config\ButtonConfig::BUTTON_PERMISSION]) || \GateGem\Core\Facades\Core::checkPermission($button[ \GateGem\Core\Support\Config\ButtonConfig::BUTTON_PERMISSION])))
                        <button class="btn btn-sm  {{ getValueByKey($button, \GateGem\Core\Support\Config\ButtonConfig::BUTTON_CLASS, 'btn-danger') }}"
                            {!! getValueByKey($button, \GateGem\Core\Support\Config\ButtonConfig::BUTTON_ACTION, function () {})() !!}> {!! getValueByKey($button, \GateGem\Core\Support\Config\ButtonConfig::BUTTON_ICON, '') !!} <span>
                                {{ __(getValueByKey($button, \GateGem\Core\Support\Config\ButtonConfig::BUTTON_TITLE, '')) }} </span></button>
                    @endif
                @endforeach
                {!! apply_filters('module_action_left', '', $this) !!}
                {!! apply_filters('module_' . $module . '_action_left', '', $this) !!}
            </div>
            <div style="flex:none">
                @if ($checkInportExcel && false)
                    <button class="btn btn-primary btn-sm"
                        wire:openmodal='core::table.import({"module":"{{ $module }}"})'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>{{ __('core::table.button.import') }}</span>
                    </button>
                @endif
                @if ($checkExportExcel && false)
                    <button class="btn btn-primary btn-sm"
                        wire:openmodal='core::table.export({"module":"{{ $module }}"})'>
                        <i class="bi bi-file-earmark-excel-fill"></i>
                        <span>{{ __('core::table.button.export') }}</span>
                    </button>
                @endif
                {!! apply_filters('module_action_right', '', $this) !!}
                {!! apply_filters('module_' . $module . '_action_right', '', $this) !!}
            </div>
        </div>
        {!! TableRender($data, $option, ['sort' => $sort]) !!}
        @if (getValueByKey($option, \GateGem\Core\Support\Config\ConfigManager::INCLUDE_AFTER, ''))
            @includeIf(getValueByKey($option, \GateGem\Core\Support\Config\ConfigManager::INCLUDE_AFTER, ''))
        @endif
        @if (isset($data) && $data != null)
            {!! $data->links() !!}
        @endif
        {!! apply_filters('module_footer', '', $this) !!}
        {!! apply_filters('module_' . $module . '_footer', '', $this) !!}
    </div>
</div>
