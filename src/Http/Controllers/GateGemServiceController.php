<?php

namespace GateGem\Core\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use Livewire\Livewire;

class GateGemServiceController extends BaseController
{
    public function loadComponent($slug)
    {
        $param = isset(Request::all()['param']) ? preg_replace('/[\x00-\x1F\x80-\xFF]/', '', stripslashes(Request::all()['param'])) : '{}';
        if (is_array($param)) {
            $param = $param[0];
        }
        $param = str_replace("'", "\"", $param);
        $param = json_decode($param, true) ?? [];
        return [
            'html' => Livewire::mount($slug, $param)->html(),
            'slug' => $slug,
            'param' => $param,
        ];
    }
    public function switchSidebar()
    {
        if (session('admin_sidebar_mini')) {
            session(['admin_sidebar_mini' => false]);
        } else {
            session(['admin_sidebar_mini' => true]);
        }
        return session('admin_sidebar_mini') ? 'min' : 'none';
    }
}
