<div class="modal fade show" style="display: block;" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Modal {{$i}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button class="btn btn-danger" wire:click="clickDemo">Xin chào</button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Open second modal</button>
                <button class="btn btn-danger" wire:component='core::dashboard({"testdata":"adsfasfds{{time()}}"})''>Modal</button>
            </div>
        </div>
    </div>
</div>
