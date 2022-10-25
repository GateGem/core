<?php

namespace LaraPlatform\Core\Livewire;

use LaraPlatform\Core\Livewire\Contracts\ModalContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use LaraPlatform\Core\Facades\Theme;

abstract class Modal extends Component implements ModalContract
{
    public const Small = "modal-sm";
    public const Default = "";
    public const Large = "modal-lg";
    public const ExtraLarge = "modal-xl";
    public const Fullscreen = "modal-fullscreen";
    public const FullscreenSm = "modal-fullscreen-sm-down modal-lg";
    public const FullscreenMd = "modal-fullscreen-md-down modal-lg";
    public const FullscreenXL = "modal-fullscreen-xl-down modal-xl";

    public $hideHeader = false;
    public $hideFooter = true;
    public $viewInclude = [];
    public $modal_title = "";
    public $modal_isPage = false;
    public $modal_size = Modal::Large;
    public $modal_permission = "";

    public function boot()
    {
        $this->modal_isPage = Request::method() == 'GET';
    }
    public function setTitle($modal_title)
    {
        $this->modal_title = $modal_title;
    }
    public function viewModal($content = null, $params = [], $footer = null, $header = null)
    {
        if (isset($this->modal_permission) && $this->modal_permission != '') {
            if (!Gate::check($this->modal_permission, [auth()]))
                return abort(403);
        }
        $this->viewInclude['content'] = $content;
        $this->viewInclude['footer'] = $footer;
        $this->viewInclude['header'] = $header;
        if ($this->modal_isPage && $content) {
            Theme::setTitle($this->modal_title);
            return view($content, $params);
        }
        return view('core::common.modal.index', $params);
    }
    public function hideModal()
    {
        $this->dispatchBrowserEvent('closemodal', ['id' => $this->id]);
    }
}