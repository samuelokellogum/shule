<?php

namespace App\Http\Controllers;

use App\ClassModel;
use App\SubjectModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubjectC extends Controller
{
    //

    public function viewSubjects(){
        $subject = new SubjectModel();
        $data = array(
            'subjects' => $subject->getSubjects()
        );
        return view('admin.view_subject', $data);
    }

    public function addSubject(Request $request){
        $subject = new SubjectModel();
        if($request->subjectcode == null || $request->subjectcode == ""):
            $subCode = 'N/A';
        else:
            $subCode = $request->subjectcode;
        endif;
        $data = array(
            'subject_name' => $request->subjectname,
            'subject_code' => $subCode,
            'audit' => Session::get('userid')
        );

        if($subject->addSubject($data)){
            return $this->popSubTable();
        }
    }

    public function getSubForEdit(Request $request){
        $subject = new SubjectModel();
        return json_encode($subject->getSubjectById($request->id));

    }

    public function upDateSubject(Request $request){
        $subject = new SubjectModel();
        if($request->subjectcode == null || $request->subjectcode == ""):
            $subCode = 'N/A';
        else:
            $subCode = $request->subjectcode;
        endif;
        $data = array(
            'subject_name' => $request->subjectname,
            'subject_code' => $subCode,
            'audit' => Session::get('userid')
        );

        if($subject->upDateSubject($data, $request->id)){
            return $this->popSubTable();
        }else{
            return $this->popSubTable();
        }
    }

    public function deleteSubject(Request $request){
        $subject = new SubjectModel();
        if($subject->deleteSubject($request->id)){
            return $this->popSubTable();
        }
    }

    public function popSubTable(){
        $subject = new SubjectModel();
        $tbody = '';
        $count = 1;

        $res = $subject->getSubjects();

        foreach ($res as $row){
            $tbody .= '<tr>
                            <td>'.$count.'</td>
                            <td>'.$row->subject_name.'</td>
                            <td>'.$row->subject_code.'</td>
                            <td>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-success">Action</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                 <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                     <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="editSubject('.$row->subject_id.')"><i class="fa fa-edit"></i> Edit</a>
                                         </li>
                                         <li><a href="#" onclick="deleteSubject('.$row->subject_id.')"><i class="fa fa-trash"></i> Delete</a>
                                         </li>
                                     </ul>
                             </div>
                            
                            
                            </td>
                       </tr>';

            $count++;
        }

        return json_encode($tbody);

    }

    public function viewAssignSub(){
        $subject = new SubjectModel();
        $class = new ClassModel();
        $users = new User();
        $data = array(
            'subjects' => $subject->getSubjects(),
            'classes' => $class->getClasses(),
            'teachers' => $users->fetchUsers()
        );
        return view('admin.view_assign_subject', $data);
    }

    public function assignSubject(Request $request){
        $subject = new SubjectModel();
        $data = array(
            'subjectid' => $request->subject,
            'classid' => $request->class,
            'audit' => Session::get('userid')
        );

        $id = $subject->assignSubToClass($data);
        if($id ){
            $vars = json_decode(stripslashes($request->teachers));
            $length = count($vars);
            for($i = 0; $i < $length; $i++) {
                $data2 = array(
                    'sa_id' => $id,
                    'teacherid' => $vars[$i],
                    'audit' => Session::get('userid')
                );
                $subject->assignSubToUser($data2);
            }
        }

        return json_encode(['success' => 'Done']);
    }
}
