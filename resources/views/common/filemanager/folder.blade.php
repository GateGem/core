<div class="el-filemanager__body--folder" wire:init="SelectPath('')">
    {!! GateGem\Core\Builder\Form\TreeViewBuilder::Render($optionTree, [], []) !!} 
</div>
