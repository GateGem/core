<div @if ($modal_isPage) class="page-manager" @else class="p-2" @endif>
    @if ($modal_isPage)
        <div class="mb-2">
            <h4>{{ $modal_title }}</h4>
        </div>
    @endif
    <div class="d-flex align-items-start">
        <ul class="nav flex-column nav-pills me-4 " id="tab-{{ $this->id }}" role="tablist">
            @foreach ($data_option as $key => $item)
                <button class="border rounded-1 mb-1 nav-link @if ($active_option == $key) active @endif"
                    id="{{ $key }}-tab-{{ $this->id }}" data-bs-toggle="pill"
                    data-bs-target="#tab-{{ $key }}-{{ $this->id }}" type="button" role="tab"
                    aria-controls="tab-{{ $key }}-{{ $this->id }}"
                    @if ($active_option == $key) aria-selected="true" @endif>{{ $item['title'] }}</button>
            @endforeach
        </ul>
        <div class="tab-content flex-fill" id="tab-content-{{ $this->id }}">
            @foreach ($data_option as $key => $item)
                <div class="tab-pane @if ($active_option == $key) show active @endif"
                    id="tab-{{ $key }}-{{ $this->id }}" role="tabpanel"
                    aria-labelledby="tab-{{ $key }}-{{ $this->id }}">
                    @livewire('core::common.option.index', ['option_key' => $key, 'option_data' => $item])
                </div>
            @endforeach
        </div>
    </div>
</div>
