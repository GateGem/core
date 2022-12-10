<div class="el-filemanager__body--folder p-1" wire:init="SelectPath('')">
    {!! GateGem\Core\Builder\Form\TreeViewBuilder::Render($optionTree, [], []) !!} 
</div>
