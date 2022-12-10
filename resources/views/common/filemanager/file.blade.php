<div class="el-filemanager__body--file">

    @if (isset($files) && is_array($files))
        @foreach ($files as $file)
            <div class="file-info" x-data='{ fileInfo: @json($file) }' :class="{ 'active': fileInfo!==undefined && fileSelect === fileInfo }"
                x-on:click="fileSelect = fileInfo">
                <div class="file-icon">
                    <i class="bi bi-folder2 "></i>
                </div>
                <div class="file-name">
                    {{ $file }}
                </div>
            </div>
        @endforeach

    @endif

</div>
