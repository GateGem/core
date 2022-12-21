<div @if ($poll) wire:poll{{ $poll }} @endif>
    Current time: {{ now() }}
    <canvas wire:ignore data-wire-id="{{ $this->id }}" id="chartjs-{{ $this->id }}" class="el-chartjs"
        data-config='option'></canvas>
</div>
