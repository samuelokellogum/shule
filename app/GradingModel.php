<?php

namespace App;

use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GradingModel extends Model
{


    public function addGradingCat($data){
        return DB::table('gradingCategory')->insert($data);
    }

    public function updateGradingCat($data, $id){
        return DB::table('gradingCategory')
            ->where('gradCat_id', $id)
            ->update($data);
    }

    public function deleteGradingCat($id){
        return DB::table('gradingCategory')
            ->where('gradCat_id', $id)
            ->update(['status' => 0]);
    }

    public function getGradingCats(){
        return DB::table('gradingCategory')
            ->where('status', 1)
            ->get();
    }

    public function getGradingByid($id){
        return DB::table('gradingCategory')
            ->where('gradCat_id', $id)
            ->first();
    }

    public function addGrading($data){
        return DB::table('grading')->insert($data);
    }

    public function updateGrading($data , $id){
        return DB::table('grading')
            ->where('grading_id',$id)
            ->update($data);
    }

    public  function deleteGrade($id){
        return DB::table('grading')
            ->where('grading_id',$id)
            ->update(['status' => 0]);
    }

    public function getGrading($gradeCat){
        return DB::table('grading')
            ->where('status', 1)
            ->where('grading_cat', $gradeCat)
            ->get();
    }

    public function getGradeById($id){
        return DB::table('grading')
            ->where('grading_id', $id)
            ->first();
    }

    public function assignGradeToClass($data){
       return DB::table('gradingtoclass')->insert($data);
    }

    public function updateGradeToClass($data, $id){
        return DB::table('gradingtoclass')
            ->where('gtl_id', $id)
            ->update($data);
    }

    public function deleteGradeFromClass($id){
        return DB::table('gradingtoclass')->where('gtl_id', $id)->delete();
    }

    public function getGradingByClass(){
        return DB::table('gradingtoclass')
            ->join('class','gradingtoclass.class','=','class.class_id')
            ->join('gradingcategory','gradingtoclass.grading_cat','=','gradingcategory.gradCat_id')
            ->get();
    }

    public function getGradingByClassById($id){
        return DB::table('gradingtoclass')
            ->join('class','gradingtoclass.class','=','class.class_id')
            ->join('gradingcategory','gradingtoclass.grading_cat','=','gradingcategory.gradCat_id')
            ->where('gtl_id',$id)
            ->first();
    }

    public function getClassNotAssigned(){
        $sql = "SELECT class.* FROM class LEFT OUTER JOIN gradingtoclass ON class.class_id = gradingtoclass.class WHERE class.status = 1 AND class.class_id NOT IN (SELECT gradingtoclass.class FROM gradingtoclass)";
        return DB::select( DB::raw($sql));
    }

    public function checkIfAssigned($classid){
        return DB::table('gradingtoclass')
            ->where('class_id', $classid)
            ->count();
    }

    public function test(){
        return Helper::hello();
    }
}
