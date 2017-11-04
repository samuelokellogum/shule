<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentModel extends Model
{
    public function getStudents(){
        return DB::table('student')
            ->where('student.status',1)
            ->get();
    }

    public function addStudent($data)
    {
        return DB::table('student')->insert($data);
    }

    public function updateStudent($data, $id)
    {
        return DB::table('student')
            ->where('student_id', $id)
            ->update($data);
    }

    public function deleteStudent($id)
    {
        return DB::table('student')
            ->where('student_id',$id)
            ->update([status > 0]);
    }

    public function getActiveStudents()
    {
        return DB::table('student')
            ->where('status',1)
            ->get();
    }

    public function getStudentsById($id)
    {
        return DB::table('student')
            ->where('student_id', $id)
            ->first();
    }
}
