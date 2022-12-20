<div class="page-manager">
    <div class="mb-2">
        <h4>{{ $page_title }}</h4>
        {!! (new \GateGem\Core\Builder\Dashboard\DashboardBuilder())->ToHtml() !!}
        @json($data1)
    </div>
</div>