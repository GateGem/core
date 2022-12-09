<div class="el-filemanager">
    <div class="el-filemanager__toolbar p-2">
        <button class="btn btn-primary btn-sm" wire:component="core::common.filemanager.input-name({})">Create Folder</button>
    </div>
    <div class="el-filemanager__body">
        @livewire('core::common.filemanager.folder')
        @livewire('core::common.filemanager.file')
    </div>
</div>