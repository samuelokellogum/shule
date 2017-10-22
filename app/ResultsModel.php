<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ResultsModel extends Model
{

    public function addMarks($data){
       return DB::table('marks')->insert($data);
    }

    public function updateMarks($data, $id){
        return DB::table('marks')
            ->where('mark_id', $id)
            ->update($data);
    }

    public function keepMarksLogs($data){
        return DB::table('marks_logs')->insert($data);
    }



    /**
     *  Import
     * @Marks getting the data from excel file
     */

    public function addMarksTmp($data){
        return DB::table('import_marks')->insert($data);
    }

    public function getMarksTmp(){
        return DB::table('import_marks')
            ->join('student','import_marks.subject_id','=','student.student_id')
            ->get();
    }

    public function getWrongStudentIds($classid){
        $sql = "SELECT import_marks.* FROM import_marks  WHERE student.student_id = 1  NOT IN (SELECT student.student_id FROM student LEFT  OUTER JOIN  class_assign ON student.student_id = class_assign.student_id WHERE class_assign.class_id = $classid AND class.status = 1)";
        return DB::select( DB::raw($sql));
    }





}
