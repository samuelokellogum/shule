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

    //Viewing Student Data
    public function viewStudents()
    {
        $student = new StudentModel();
        $stdata = array(
            'students'=> $student->getAllStudents()
        );
        return view('student.student');
    }

    //Creating New Student
    public function createStudent(Request $request)
    {
        if($request->student_id == null || $request->student_id =""):
            $student_id ='N/A';
            end:
            $student_id = $request->student_id;

        endif;
        $data = array(
            'student_id' => $request->student_id,
            'audit' => Session::get('userid')
        );

        return view('student.student');
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
        return view('student.student');
    }

    //Getting All Students Data
    public function getAllStudents()
    {
        return view('student.student');
    }

    //Getting Student Results
    public function getStudentResults()
    {
        return view('Student.stResults');
    }

    //Getting Student Grading
    public function getSubjectGrading()
    {
        //$grading == new GradingModel();
        return view();
    }

    //Getting Parent Details
    public function getParentDetails($data)
    {
        return view('student.stParent', $data);
    }

    //Getting Student Subjects Offered
    public function getStSubjects($data)
    {

        $subject = new SubjectModel();
        return view('student.stSubjects', $data);
    }

    //Getting Student's Teachers
    public function getStTeachers($data)
    {
        return view('student.stTeacher',$data);
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