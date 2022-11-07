<div class="dropdown">
    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $lang_current }}
    </button>
    <ul class="dropdown-menu">
        @foreach ($langs as $item)
            <li wire:click='DoSelector("{{$item}}")'><a class="dropdown-item" href="#">{{ $item }}</a></li>
        @endforeach
    </ul>
</div>
