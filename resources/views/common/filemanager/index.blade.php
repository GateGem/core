<div class="el-filemanager">
    <div class="el-filemanager__toolbar p-2">
        <button class="btn btn-primary btn-sm" wire:component="core::common.filemanager.input-name({})">New
            Folder</button>
        <button class="btn btn-primary btn-sm"
            wire:component="core::common.filemanager.upload-file({'path':'{{ $path_current }}','disk':'{{ $disk }}'})">Upload
            File</button>

    <button wire:component="core::common.filemanager()" class="btn btn-danger btn-sm">Test</button>
    </div>
    <div class="el-filemanager__body">
        @livewire('core::common.filemanager.folder')
        @livewire('core::common.filemanager.file')
    </div>
</div>
