<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    //

    public function regUser($data){
        return DB::table('users')->insertGetId($data);
    }

    public function addUserPwd($data){
        return DB::table('auth')->insert($data);
    }

    //update and delete
    public function updateUser($data, $userid){
        return DB::table('users')
            ->where('user_id', $userid)
            ->update($data);
    }

    public function deleteUser($userid){
        return DB::table('users')
            ->where('user_id', $userid)
            ->update(['status' => 0]);
    }

    public function fetchUsers(){
        return DB::table('users')
            ->join('user_groups','users.userg','=','user_groups.ug_id')
            ->where('users.status', 1)
            ->get();
    }

    public function fetchUserById($userId){
        return DB::table('users')
            ->join('user_groups','users.userg','=','user_groups.ug_id')
            ->where('users.user_id', $userId)
            ->first();
    }

    public function fecthUsersByGroup($role){
        return DB::table('users')
            ->join('user_groups','users.userg','=','user_groups.ug_id')
            ->where('users.status',1)
            ->where('users.userg', $role)
            ->get();
    }

    public function addUserGroup($data){
        return DB::table('user_groups')->insert($data);
    }

    public function updateUserGroup($data, $id){
        return DB::table('user_groups')
            ->where('ug_id', $id)
            ->update($data);
    }

    public function deleteUserGroup($id){
        return DB::table('user_groups')
            ->where('ug_id', $id)
            ->update(['status' => 0]);
    }

    public function getUserGroups(){
        return DB::table('user_groups')
            ->where('status', 1)
            ->get();

    }

    public function getUserGById($id){
        return DB::table('user_groups')
            ->where('ug_id', $id)
            ->first();
    }

    public function getUGNotAdmin(){
        return DB::table('user_groups')
            ->where('status', 1)
            ->where('ug_id','!=',1)
            ->get();
    }



}
