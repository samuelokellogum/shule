<?php

namespace App\Http\Controllers;

use App\StudentModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
        return view('student.view_students', $data);
    }

    public function viewStudentById()
    {
    $student = new StudentModel();
    $data = array(
        'student'=>$student->getStudentsById()
    );
     return view('student.view_students', $data);
    }

    //Creating New Student
    public function addStudent(Request $request)
    {
        $student = new StudentModel();

            $data = array(
                'student_id' => $request->student_id,
                'fname'=> $request->fname,
                'lname'=> $request->lname,
                'image'=> $request->image,
                'adminYear'=>$request->adminYear,
                'status'=>$request->status,
                'audit' => Session::get('userid')
            );

        if($student->addStudent($data)){
            return view('student.add_student',$data);
        }
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
        return view('student.view_students');
    }

    //Getting Imported Data
    public function getImportedData(Request $request)
    {
        $file = $request->file('import_file');
        if($file){
            $path = $file->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['title' => $value->title, 'description' => $value->description];
                }
                if(!empty($insert)){
                    DB::table('items')->insert($insert);
                    //  dd('Insert Record successfully.');
                }
            }
        }

        //Get excel sheets and merge data into Database
        return view('student.stDataSheet', $data);
    }

    //Getting Student's class
    public function getStClass($data)
    {
        return view('student.stClass', $data);
    }

}
