<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $menus = Menu::where("parent_id",0)->get();
        foreach($menus as $menu){
            $menu['child_menu'] = Menu::where('parent_id', $menu->id)->get();
        }
        return view('home.index',['menus' => $menus]);
    }

    public function show($id){
        $menus = Menu::where("parent_id",0)->get();
        foreach($menus as $menu){
            $menu['child_menu'] = Menu::where('parent_id', $menu->id)->get();
        }
        $menuShowing = Menu::find($id);

        if(!$menuShowing) return redirect()->route('home.index');
        return view('home.content',['menus' => $menus, 'menuShowing' => $menuShowing]);
    }
}
