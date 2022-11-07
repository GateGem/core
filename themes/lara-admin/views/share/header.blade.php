<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li><a onclick="switchSidebar()"> <i class="bi bi-justify fs-4"></i></a></li>
        </ul>
        <ul class="nav-right">
            <li class="">
                @livewire('core::common.language-selector')
            </li>
            <li>{{ auth()->user()->name }}</li>
        </ul>
    </div>
</div>
