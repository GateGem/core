<div class="page-manager">
    <div class="mb-2">
        <h4>{{ $page_title }}</h4>
    </div>
    <button wire:component='core::table.index({"module":"user"})' class="btn btn-danger">bab</button>
    {!! (new \GateGem\Core\Builder\Dashboard\DashboardBuilder())->ToHtml() !!}
</div>
