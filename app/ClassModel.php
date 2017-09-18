<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassModel extends Model
{


    public function addClass($data){
        return DB::table('class')->insert($data);
    }

    public function updateClass($data, $id){
        return DB::table('class')
            ->where('class_id', $id)
            ->update($data);
    }

    public function deleteClass($id){

       if(count($this->getClassSections($id)) > 0){
           DB::table('class_section')
               ->where('classid', $id)
               ->delete();
       }
        return  DB::table('class')
            ->where('class_id', $id)
            ->update(['status' => 0]);
    }

    public function getClasses(){
        return DB::table('class')
            ->where('status', 1)
            ->get();
    }

    public function getClassById($id){
        return DB::table('class')
            ->where('class_id', $id)
            ->first();
    }

    public function addClassSection($data){
        return DB::table('class_section')->insert($data);
    }

    public function updateClassSection($data, $id){
        return DB::table('class_section')
            ->where('cs_id', $id)
            ->update($data);
    }

    public function deleteClassSection($id){
        return DB::table('class_section')
            ->where('cs_id', $id)
            ->delete();
    }

    public function getClassSecById($id){
        return DB::table('class')
            ->join('class_section','class.class_id','=','class_section.classid')
            ->join('users','class_section.class_teacher','=','users.user_id')
            ->where('class_section.cs_id', $id)
            ->first();
    }

    public function getClassSections($class){
        return DB::table('class')
            ->join('class_section','class.class_id','=','class_section.classid')
            ->join('users','class_section.class_teacher','=','users.user_id')
            ->where('class.class_id', $class)
            ->get();
    }

    public function getLevels(){
        return DB::table('school_data')
            ->select('school_data.school_classes')
            ->first();
    }
}
