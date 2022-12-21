<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li><a onclick="switchSidebar()"> <i class="bi bi-justify fs-4"></i></a></li>
        </ul>
        <ul class="nav-right">
            <li>
                <widget:core::now :isServer="false" />
            </li>
            <li class="">
                @livewire(apply_filters('filter_theme_language_selector', 'core::common.language-selector'))
            </li>
            <li> @livewire(apply_filters('filter_theme_language_selector', 'core::common.profile'))</li>
        </ul>
    </div>
</div>
