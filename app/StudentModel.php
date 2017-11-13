<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentModel extends Model
{
    public function getStudents(){
        return DB::table('student')->get();
    }

    public function getImportedData()
    {
        return DB::table('student')->get();
    }

    public function addStudent($data)
    {
        return DB::table('student')->insert($data);
    }

    public function updateStudent($data, $id)
    {
        return DB::table('student')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteStudent($id)
    {
        return DB::table('student')
            ->where('id',$id)
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
            ->where('id', $id)
            ->first();
    }

    public function generateStudentNo(){
        //generate password
        $num = '1234567890';
        $id = array(); //remember to declare $id as an array
        $length = strlen($num) - 1; //put the length -1 in cache
        for ($i = 0; $i < 12; $i++) {
            $p = mt_rand(0, $length);
            $id[] = $num[$p];
        }
        return implode($id);
    }

}
