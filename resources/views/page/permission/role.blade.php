<div class="p-2">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h2>Permission</h2>
            <div class="row">
                <div class="p-1">
                    {!! GateGem\Core\Builder\Form\TreeViewBuilder::Render($optionTree, [], []) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="text-center pt-2"> <button wire:click="doSave()" class="btn btn-sm btn-danger"> <i
                class="bi bi-download"></i> <span>Save</span></button></div>
</div>
