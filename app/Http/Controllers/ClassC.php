<?php

namespace App\Http\Controllers;

use App\ClassModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassC extends Controller
{

    public function viewClass(){
        $users = new User();
        $class = new ClassModel();
        $data = array(
            'usergroups' => $users->getUGNotAdmin(),
            'levels' => $class->getLevels()->school_classes,
            'classes' => $class->getClasses()
        );
        return view('admin.view_classes', $data);
    }

    public function addClass(Request $request){
        $class = new ClassModel();
        $data = array(
            'class_name' => $request->classname,
            'level' => $request->level,
            'audit' => Session::get('userid')
        );

        if($class->addClass($data)){
           return $this->popClassTable();
        }
    }

    public function getCForEdit(Request $request){
        $class = new ClassModel();
        return json_encode($class->getClassById($request->id));
    }

    public function updateClass(Request $request){
        $class = new ClassModel();
        $data = array(
            'class_name' => $request->classname,
            'level' => $request->level,
            'audit' => Session::get('userid')
        );


       if($class->updateClass($data, $request->id)){
            return $this->popClassTable();
        }else{
            return $this->popClassTable();
        }
    }

    public function deleteClass(Request $request){
        $class = new ClassModel();
       if($class->deleteClass($request->id)){
            return $this->popClassTable();
        }
    }

    public function popClassTable(){
        $class = new ClassModel();
        $tbody = '';
        $count = 1;

        $res = $class->getClasses();

        foreach ($res as $row){

            $tbody .= '<tr>
                        <td>'.$count.'</td>
                        <td>'.$row->class_name.'</td>
                        <td>Level '.$row->level.'</td>
                        <td>
                         
                          <div class="btn-group">
                                <button type="button" class="btn btn-success">Action</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                 <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                     <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="editClass('.$row->class_id.')"><i class="fa fa-edit"></i> Edit</a>
                                         </li>
                                         <li><a href="#" onclick="deleteClass('.$row->class_id.')"><i class="fa fa-trash"></i> Delete</a>
                                         </li>
                                     </ul>
                             </div>
                        </td>
                       </tr>';

            $count++;
        }

        return json_encode($tbody);
    }

    public function popClassList(){
        $class = new ClassModel();
        $html = '<option value="">Choose class</option>';
        $res = $class->getClasses();

        foreach ($res as $row){
            $html .= '<option value="'.$row->class_id.'">'.$row->class_name.'</option>';
        }

        return json_encode($html);

    }

    public function popClassSecTable(Request $request){
        $class = new ClassModel();
        return $this->loadClassSecTable($request->class);
    }

    public function getUsers(Request $request){
        $users = new User();
        $res = $users->fecthUsersByGroup($request->usergroup);
        $html = '<option value="">Choose class teacher</option>';

        foreach ($res as $row){
            $html .= '<option value="'.$row->user_id.'">'.$row->fname.' '.$row->lname.'</option>';
        }

        return json_encode($html);
    }

    public function addClassSection(Request $request){
        $class = new ClassModel();
        $data = array(
            'classid' => $request->classid,
            'section_name' => $request->classec,
            'class_teacher' => $request->teacher,
            'audit' => Session::get('userid')
        );

        if($class->addClassSection($data)){
            return $this->loadClassSecTable($request->classid);
        }

    }

    public function fetchClassSecForEdit(Request $request){
        $class = new ClassModel();
        return json_encode($class->getClassSecById($request->classid));
    }

    public function updateClassSec(Request $request){
        $class = new ClassModel();
        $data = array(
            'section_name' => $request->classec,
            'class_teacher' => $request->teacher,
            'audit' => Session::get('userid')
        );

        if($class->updateClassSection($data, $request->classid)){
            return $this->loadClassSecTable($request->classid);
        }else{
            return $this->loadClassSecTable($request->classid);
        }
    }

    public function deleteClassSec(Request $request){
        $class = new ClassModel();
        if($class->deleteClassSection($request->id)){
            return $this->loadClassSecTable($request->classid);
        }

    }

    public function loadClassSecTable($classId){
        $class = new ClassModel();
        $tbody = '';
        $count = 1;

        $res = $class->getClassSections($classId);

        foreach ($res as $row){
            $tbody .= '<tr>
                        <td>'.$count.'</td>
                        <td>'.$row->section_name.'</td>
                        <td>'.$row->fname.' '.$row->lname.'</td>
                        <td>
                            <a href="#" onclick="editClassSec('.$row->cs_id.')"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="deleteClassSec('.$row->cs_id.')"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>';
            $count++;
        }

        return json_encode($tbody);
    }

    //populate class setion select tag by class id
    public function popClassSections(Request $request){
        $class = new ClassModel();
        $res = $class->getClassSections($request->id);
        if(count($res) <= 0){
            $html = '<option value="">No Class section</option>';
            return json_encode($html);
        }
        $html = '<option value="">Class section</option>';
        foreach ($res as $row){
            $html .= '<option value="'.$row->cs_id.'">'.$row->section_name.'</option>';
        }

        return json_encode($html);
    }


}
