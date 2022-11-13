<div class="p-2">
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <h2>Role</h2>
            <div class="permission overflow-auto">
                @foreach ($roleAll as $key=> $item)
                <div class="px-2">
                    <div class="form-check">
                        <input wire:model="role.{{$item->id}}" class="form-check-input" type="checkbox" value="{{$item->id}}" id="role_{{$key}}">
                        <label class="form-check-label" for="role_{{$key}}">
                            {{$item->name}}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-9 col-md-12">
            <h2>Permission</h2>
            <div class="row">
                <div class="p-1">
                    <?php echo LaraIO\Core\Builder\Form\TreeViewBuilder::Render($optionTree, [], []); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center pt-2"> <button wire:click="doSave()" class="btn btn-sm btn-danger"> <i class="bi bi-download"></i> <span>Save</span></button></div>
</div>