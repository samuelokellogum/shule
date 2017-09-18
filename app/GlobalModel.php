<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GlobalModel extends Model
{
    //

    public function isConfigured(){
        $check = DB::table('users')->where('users.user_id', 1)->first();
        if(count($check) == 1):
            return true;
            else:
            return false;
                endif;
    }


    public function addSchData($data){
        return DB::table('school_data')->insert($data);
    }

    public function addPsData($data){
        DB::table('user_groups')->insert(array(
            'userg_name' => 'System Admin',
            'audit' => 1
        ));
        return DB::table('users')->insertGetId($data);
    }

    public function addPassword($data){
        return DB::table('auth')->insert($data);
    }

    public function eraseOnIncomp(){

    }

    public function authUser($email,$password){
        return DB::table('users')
            ->join('auth','users.user_id' ,'=', 'auth.userid')
            ->join('user_groups','users.userg','=','user_groups.ug_id')
            ->where('users.email', $email)
            ->where('auth.password', $password)
            ->first();
    }

    public static function getSubmenus($menuid){
        return DB::table('menu')
            ->join('menu_sub_links','menu.menu_id','=','menu_sub_links.menuid')
            ->where('menu.menu_id', $menuid)
            ->get();
    }

    public function getMenuForUser($usergoup){
        $fullMenu = array();
       $menus = DB::table('menu_assign')
           ->join('menu','menu_assign.menuid','=','menu.menu_id')
            ->where('menu_assign.user_g', $usergoup)
            ->get();

       foreach ($menus as $row){
           $ListsubMenus = array();
           $subMenus = $this->getSubmenus($row->menuid);
           foreach ($subMenus as $row2){
               $ListsubMenus[] = array(
                   'sname' => $row2->sub_name,
                   'slink' => $row2->sub_link
               );
           }
           $fullMenu[] = array(
               'menuname' => $row->menu_name,
               'submenus' => $ListsubMenus
           );

          unset($ListsubMenus);
       }

       return json_encode($fullMenu);

    }

    public function getMenus(){
        return DB::table('menu')->get();
    }

    public function getMenuById($menuid){
        return DB::table('menu')
            ->where('menu.menu_id', $menuid)
            ->first();
    }

    public function getUserMenus(){

        return DB::table('menu')
            ->join('menu_assign','menu.menu_id','=','menu_assign.menuid')
            ->join('user_groups','menu_assign.user_g','=','user_groups.ug_id')
            ->orderBy('user_groups.userg_name')
            ->get();

    }


    public function assignMenu($data){
        return DB::table('menu_assign')->insert($data);
    }

    public function unAssignMenu($id){
        return DB::table('menu_assign')->where('mid', '=', $id)->delete();
    }

    public function getUnAssigedMenus($usergroup){
        $sql = "SELECT menu.* FROM menu WHERE menu.menu_id NOT IN (
      SELECT menu.menu_id FROM menu LEFT OUTER JOIN menu_assign ON menu.menu_id = menu_assign.menuid WHERE menu_assign.user_g = $usergroup)";
        return DB::select($sql);
    }

    public function generateRandomString(){
        //generate password
        $alphabet = '1234567890';
        $id = array(); //remember to declare $id as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 12; $i++) {
            $p = mt_rand(0, $alphaLength);
            $id[] = $alphabet[$p];
        }
        return implode($id);
    }
}
