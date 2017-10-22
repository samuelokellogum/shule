<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectModel extends Model
{
    public function addSubject($data){
        return DB::table('subject')->insert($data);
    }

    public function upDateSubject($data, $id){
        return DB::table('subject')
            ->where('subject_id',$id)
            ->update($data);
    }

    public function deleteSubject($id){
        return DB::table('subject')
            ->where('subject_id',$id)
            ->update(['status' => 0]);
    }

    public function getSubjects(){
        return DB::table('subject')
            ->where('status',1)
            ->get();
    }

    public function getSubjectById($id){
        return DB::table('subject')
            ->where('subject_id',$id)
            ->first();
    }

    public function getAllSubData(){
        return DB::table('subject')
            ->join('subject_assign','subject.subject_id','=','subject_assign.subjectid')
            ->join('class','subject_assign.classid' ,'=','class.class_id')
            ->where('subject.status', 1)
            ->orderBy('class.level')
            ->get();
    }

    public function getAllSubDataById($id){
            return DB::table('subject')
                ->join('subject_assign','subject.subject_id','=','subject_assign.subjectid')
                ->join('class','subject_assign.classid' ,'=','class.class_id')
                ->where('subject.subject_id', $id)
                ->get();
    }

    public function getSubjectTeacher($subject, $class){
        return DB::table('subject_assign')
            ->join('subject','subject_assign.subjectid','=','subject.subject_id')
            ->join('subject_teachers','subject_assign.sa_id','=','subject_teachers.sa_id')
            ->join('users','subject_teachers.teacherid','=','users.user_id')
            ->where('subject_assign.subjectid',$subject)
            ->where('subject_assign.classid',$class)
            ->get();
    }

    public function assignSubToClass($classData){
      return  DB::table('subject_assign')->insertGetId($classData);
    }

    public function unAssignSubFromClass($id){
        DB::table('subject_assign')
            ->where('sa_id', $id)
            ->update(['status' => 0]);

        return DB::table('subject_teachers')
            ->where('sa_id',$id)
            ->update(['status' => 0]);
    }

    public function getClassSubjects($classId){
        return DB::table('subject_assign')
            ->join('class','subject_assign.classid','=','class.class_id')
            ->join('subject','subject_assign.subjectid','=','subject.subject_id')
            ->where('subject_assign.classid', $classId)
            ->where('subject_assign.status', 1)
            ->get();
    }

    public function assignSubToUser($teacherData){
        return DB::table('subject_teachers')->insert($teacherData);
    }

    public function unAssignSubFromUser($id){
        return DB::table('subject_teachers')
            ->where('st_id', $id)
            ->update(['status' => 0]);
    }
}
