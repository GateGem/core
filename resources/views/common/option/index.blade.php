<div >
    @if (isset($option_data) && isset($option_data['title']))
        <h4>{{ $option_data['title'] }}</h4>
        <div>
            @foreach($option_data['fields'] as $field)
            <div class="mb-3">
                <label class="form-label">{{$field['title']}}</label>
                {!!\LaraIO\Core\Builder\Form\FieldBuilder::Render($field,null,null)!!}
              </div>
            @endforeach
        <div><button class="btn btn-primary" wire:click="doSave()">Save</button></div>
        </div>
    @else
        <h2>Not found {{ $option_key }}</h2>
    @endif
</div>
