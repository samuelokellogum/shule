<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeveloperModel extends Model
{
    //

    public function addMenu($data){
        return DB::table('menu')->insert($data);
    }

    public function addSubMenu($data){
        return DB::table('menu_sub_links')->insert($data);
    }
}
