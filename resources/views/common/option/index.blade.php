<div>
    @if (isset($option_data) && isset($option_data['title']))
        <h4>{{ $option_data['title'] }}</h4>
        <div>
            {!! FormRender($option_data) !!}
            <button class="btn btn-primary" wire:click="doSave()">{{ __('core::table.button.save') }}</button>
        </div>
    @else
        <h2>Not found {{ $option_key }}</h2>
    @endif
</div>
