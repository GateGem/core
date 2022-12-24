<div class="page-manager">
    <div class="mb-2">
        <h4>{{ $page_title }}</h4>
        <widget:core::chartjs :option="$option" poll='.1s' />
        @json($data1)
    </div>
</div>
