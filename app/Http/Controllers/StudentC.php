<?php

namespace App\Http\Controllers;

use App\StudentModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StudentC extends Controller
{
    //
    //Viewing Student Data
    public function viewStudents()
    {
        $student = new StudentModel();
        $data = array(
            'student'=> $student->getStudents()
        );
        return view('student.viewStudents', $data);
    }

    public function viewStudentById()
    {
    $student = new StudentModel();
    $data = array(
        'student'=>$student->getStudentsById()
    );
     return view('student.viewStudents', $data);
    }

    //Creating New Student
    public function addStudent(Request $request)
    {
        $student = new StudentModel();        
        $stdno = $student->generateStudentNo();
            $data = array(                
                'fname'=> $request->fname,
                'lname'=> $request->lname,
                'studentNo' => $stdno,
                'dob' => $request->dob,
                'image'=> $request->image,
                'adminYear'=>$request->adminYear,
                'status'=> 1,
                'audit' => 1
            );           
            return view('student.addStudent',$data);
        }     
    

    //Deleting Student Data
    public function deleteStudent(Request $request, $id)
    {
        $student = new StudentModel();

        return view('student.student');
    }

    //Editing Student Data
    public function editStudent(Request $request)
    {
        $student = new StudentModel();
        return view('student.viewStudents');
    }

    //Getting Imported Data
    public function getDataImport(Request $request)
    {
        $file = $request->file('import_file');
        if($file){
            $path = $file->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['fname' => $value->fname, 'lname' => $value->lname,
                     'dob' => $value->dob, 'adminYear' => $value->adminYear, 
                     'image' => $value->image];
                }
                if(!empty($insert)){
                    DB::table('student')->insert($insert);                    
                    //  dd('Insert Record successfully.');
                }
            }
        }

        //Get excel sheets and merge data into Database
        return view('student.viewStudents', $data);
    }

    //Getting Student's class
    public function getStClass($data)
    {
        return view('student.stClass', $data);
    }

}
