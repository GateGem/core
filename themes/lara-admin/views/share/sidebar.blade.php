<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo fs-4">
            @includeIf(apply_filters("filter_theme_logo","theme::share.logo"), [])
        </div>
        <div class="sidebar-menu scrollable pos-r ps ps--active-y">
            {{ do_menu_render() }}
        </div>
    </div>
</div>
