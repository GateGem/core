<div class="el-filemanager__body--file" x-data="{ files: @entangle('files') }">
    <div class="file-list">
        <template x-for="(fileInfo, index) in files">
            <div class="file-info" :class="{ 'active': fileInfo !== undefined && fileSelect === fileInfo }"
                x-on:click="fileSelect = fileInfo">
                <div class="file-icon">
                    <i class="bi bi-file-text "></i>
                </div>
                <div class="file-name">
                    <span x-text="fileInfo"></span>
                </div>
            </div>
        </template>
    </div>
    <div x-show="fileSelect" class="file-property">
        <span x-text="fileSelect"></span>
    </div>
</div>
