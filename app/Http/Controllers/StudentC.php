<?php

namespace App\Http\Controllers;

use App\StudentModel;
use App\User;
use Carbon\Carbon;
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


    public function create()
    {
        return view('student.addStudent');
    }

    public function viewStudentById(Request $request)
    {
        $student = new StudentModel();
        $data = array(
        'student'=>$student->getStudentsById($request->student_id)
        );
        return view('student.viewStudents', $data);
    }

    //Creating New Student
    public function addStudent(Request $request)
    {

        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //Handle File Uploading
        if ($request->hasFile('image')) {
            //Get filename with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            //Get just filename
            $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload Image
            $path = $request->file('image')->storeAs('public/cover-images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        /*$student = new StudentModel;
        $student->fname = $request->fname;
        $student->lname = $request->lname;
        $student->studentNo = $this->generateStudentNo();
        $student->dob = $request->dob;
        $student->image = $fileNameToStore;
        $student->adminYear = $request->adminYear;
        $student->audit = 1;
        $student->save();*/

        $data = array(
            'student_id' => $this->generateStudentNo(),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'image' => $fileNameToStore,
            'adminYear' => $request->adminyear,
            'audit' => 1

        );

        if (StudentModel::addStudent($data)) {
            return redirect('/viewStudents')->with('success', 'Student Created');
        }
                 print_r($data);
    }
    
    public function generateStudentNo()
    {
        do {
            $rand = $this->generateRandomString(6);
        } while (!empty(StudentModel::where('student_id', $rand)->first()));
        return $rand;
    }
   
    public function generateRandomString($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $yearFormat = Carbon::now()->toDateString();
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $yearFormat + $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function show($id)
    {
        $student = StudentModel::find($id);
        return view('student.show')->with('students', $student);
    }

    //Deleting Student Data
    public function destroy($id)
    {
        $student = StudentModel::find($id);
        $student->delete();
        return redirect('/student')->with('Success', 'Student Deleted' );
    }

    //Editing Student Data
    public function edit($id)
    {
        $student = StudentModel::find($id);
        return view('student.viewStudents')->with('students', $student);
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validating Form
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //Handle File Uploading
        if ($request->hasFile('image')) {
            //Get filename with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            //Get just filename
            $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload Image
            $path = $request->file('image')->storeAs('public/cover_images', $fileNameToStore);
        }
       
        //Create Post
        $student = StudentModel::find($id);
        $student->fname = $request->input('fname');
        $student->lname = $request->input('lname');
        $student->adminYear = $request->input('adminYear');
        $student->dob = $request->input('dob');
        if ($request->hasFile('cover_image')) {
            $student->image = $fileNameToStore;
        }
        $student->save();

        return redirect('/students')->with('success', 'Student Info Updated');
    }

    /**
     * File Export Code
     *
     * @var array
     */
    public function downloadExcel(Request $request, $type)
    {
        $data = StudentModel::get()->toArray();
        return Excel::create('student_information', function ($excel) use ($data) {
            $excel->sheet('StudentSheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /**
     * Import file into database Code
     *
     * @var array
     */
    public function importExcel(Request $request)
    {

        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($data) && $data->count()) {
                foreach ($data->toArray() as $key => $value) {
                    if (!empty($value)) {
                        foreach ($value as $v) {
                            $insert[] = ['fname' => $value->fname, 'lname' => $value->lname,
                            'dob' => $value->dob, 'adminYear' => $value->adminYear,
                            'image' => $value->image];
                        }
                    }
                }
                
                if (!empty($insert)) {
                    student::insert($insert);
                    return back()->with('success', 'Insert Record successfully.');
                }
            }
        }
        return back()->with('error', 'Please Check your file, Something is wrong there.');
    }
}
