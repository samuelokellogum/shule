<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    public function getAllStudents()
    {
        return DB::table('students')->get();
    }     

    public function createStudent()
    {
        return DB::table('students')->update();
    }

    public function updateStudent($data, $id)
    {
        return DB::table('students')
        ->where('student_id', $id)
        ->update($data);
    }

    public function deleteStudent($id)
    {
        return DB::table('students')
        ->where('student_id',$id)
        ->update([status > 0]);
    }  

    public function getStudents()
    {
        return DB::table('students')
        ->where('status',1)
        ->get();
    }

    public function getStudentsById($id)
    {
        return DB::table('students')
        ->where('student_id', $id)
        ->first();
    }
    
}

