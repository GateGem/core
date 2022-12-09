<div class="page-manager">
    <div class="mb-2">
        <h4>{{ $page_title  }}</h4>
    </div>
    <button wire:component="core::common.filemanager()" class="btn btn-danger btn-sm">Test</button>
    {!! (new \GateGem\Core\Builder\Dashboard\DashboardBuilder())->ToHtml()!!}
</div>
