<div class="{{ $widget_column }}  p-1">
    <div class="dashboard-widget border rounded-1  {{ $widget_class }} p-1"
        @if ($widget_poll) wire:poll{{ $widget_poll }}="process_data()" @endif>
        @if ($widget_title)
            <h4>
                @if ($widget_icon)
                    <i class="{{ $widget_icon }}"></i>
                @endif
                {{ __($widget_title) }}
            </h4>
        @endif
        <p>
            @includeif()
        </p>
    </div>
</div>
