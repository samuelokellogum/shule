<?php

namespace App\Http\Controllers;

use App\ClassModel;
use App\SubjectModel;
use App\StudentModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentC extends Controllers
{

    public function viewStudents()
    {
        $student = new StudentModel();
        $stdata = array(
            'students'=> $student->getAllStudents()
        );
        return view();
    }

    public function createStudent(Request $request)
    {
        if($request->student_id == null || $request->student_id =""):
            $student_id ='N/A';
            end:
            $student_id = $request->student_id;

        endif;
        $data = array(
            'student_id' => $request->student_id,
            'fname' => $fname,
            'audit' => Session::get('userid')
        );
    }

    public function deleteStudent(Request $request, $id)
    {
            $student = new StudentModel();
            
            return view();
    }

    public function editStudent(Request $request)
    {
        $student = new StudentModel();
        return view();
    }

    public function getAllStudents()
    {
        
    }

}