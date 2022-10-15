@extends(get_layout_theme())
@section('content')
<div>
    xin chào
    chao2
    <button class="btn btn-danger" wire:click="clickDemo">Xin chào</button>
    <button class="btn btn-danger" wire:component='core::dashboard({"testdata":"adsfasfds{{time()}}"})''>Modal</button>

</div>
@endsection