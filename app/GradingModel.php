<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GradingModel extends Model
{
    //

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

    public function getGrading($subject){
        return DB::table('grading')
            ->where('subjectid', $subject)
            ->get();
    }
}
