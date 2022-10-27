<div @if($modal_isPage) class="manager-table" @else class="p-2" @endif @if(getValueByKey($option,'poll','')) wire:poll.{{getValueByKey($option,'poll','')}}@endif>
    <div @if($modal_isPage) class="manager-table-content" @endif>
        @if($modal_isPage)
        <div class="mb-2">
            <h4>{{$modal_title}}</h4>
        </div>
        @endif
        <div class="mb-2 d-flex flex-row">
            <div style="flex:auto">
                @if($checkAdd===true || true)
                <button class="btn btn-primary btn-sm" wire:component='{{$viewEdit}}({"module":"{{$module}}"})'>
                    <i class="bi bi-plus-square"></i> <span>Thêm mới</span>
                </button>
                @endif
                @foreach(getValueByKey($option, 'action.append', []) as $button)
                @if (getValueByKey($button, 'type', '') == 'new' && (!isset($button['permission']) || \Gate::check($button['permission'])||true))
                <button class="btn btn-sm  {{getValueByKey($button, 'class', 'btn-danger')}}" {!!getValueByKey($button,"action" , function(){})()!!}> {!!getValueByKey($button, 'icon', '')!!} <span> {{getValueByKey($button, 'title', '') }} </span></button>
                @endif
                @endforeach
            </div>
            <div style="flex:none">
                @if($checkInportExcel)
                <button class="btn btn-primary btn-sm" wire:openmodal='core::table.import({"module":"{{$module}}"})'>
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    <span>Nhập excel</span>
                </button>
                @endif
                @if($checkExportExcel)
                <button class="btn btn-primary btn-sm" wire:openmodal='core::table.export({"module":"{{$module}}"})'>
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    <span>Xuất excel</span>
                </button>
                @endif
            </div>
        </div>
        {!!\LaraPlatform\Core\Builder\Table\TableBuilder::Render($data,$option,['sort'=>$sort])!!}
        @if(isset($data)&& $data!=null)
        {{ $data->links() }}
        @endif
    </div>
</div>