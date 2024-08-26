<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        if ($menus->isEmpty()) {
            abort(404, 'No menus found.');
        }

        $menus = $menus->map(function ($menu) {
            return [
                'pdf_url' => $menu->pdf_path ? url('storage/' . $menu->pdf_path) : null,

                'image_path' => $menu->image_path ? url('storage/' . $menu->image_path) : null,
            ];
        });
        //dd($menus->pluck('pdf_url'));
        return view('menu', compact('menus'));
    }
}
