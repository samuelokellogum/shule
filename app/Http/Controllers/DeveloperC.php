<?php

namespace App\Http\Controllers;

use App\DeveloperModel;
use App\GlobalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeveloperC extends Controller
{
    //

    public function index(){
        $global = new GlobalModel();
        $menus = $global->getMenus();
        return view('developer.developer', ['menus' => $menus]);
    }

    public function addMenu(Request $request){
        $dev = new DeveloperModel();
        if($dev->addMenu(['menu_name' => $request->menuname])):
              return $this->getMenus();
                endif;
    }

    public function addSubMenu(Request $request){
        $dev = new DeveloperModel();
        $data = array(
            'menuid' => $request->menu,
            'sub_link' => $request->slink,
            'sub_name' => $request->sname
        );
        if($dev->addSubMenu($data)){
            return $this->getMenus();
        }
    }

    public function getMenus(){
        $global = new GlobalModel();
        $menus = $global->getMenus();
        $html = '<option value="">Choose Menu</option>';
        foreach($menus as $row){
            $html .= '<option value ="'.$row->menu_id.'">'.$row->menu_name.'</option>';
        }
        return json_encode($html);
    }
}
