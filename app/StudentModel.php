<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentModel extends Model
{
    public $table = 'student';
    public $timestamps = 'false';
    public $primaryKey = 'user_id';
    public $fillable = ['fname', 'lname', 'dob', 'adminYear', 'image' ];
   
    public function getStudents(){
        return DB::table('student')->get();
    }

    public function getImportedData()
    {
        return DB::table('student')->get();
    }

    public static function addStudent($data)
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
        return DB::table('student')::find(student_id)
            ->where('student_id', $id)
            ->first();
    }

   

}
