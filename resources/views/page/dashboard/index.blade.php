<div class="page-manager">
    <div class="mb-2">
        <h4>{{ $page_title }}</h4>
        <div class="p-1">
            <div class="row dashboard-header">
                @foreach (getDashboard('header') as $key => $item)
                    @livewire('widget-' . $item->getWidgetName(), ['key_widget' => $key])
                @endforeach
            </div>
            <div class="row dashboard-body">
                @foreach (getDashboard('body') as $key => $item)
                    @livewire('widget-' . $item->getWidgetName(), ['key_widget' => $key])
                @endforeach
            </div>
            <div class="row dashboard-footer">
                @foreach (getDashboard('footer') as $key => $item)
                    @livewire('widget-' . $item->getWidgetName(), ['key_widget' => $key])
                @endforeach
            </div>
        </div>
    </div>
</div>
