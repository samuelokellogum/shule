<?php

namespace App\Http\Controllers;

use App\GradingModel;
use App\SubjectModel;
use Illuminate\Http\Request;

class GradingC extends Controller
{

    public function viewGradingCat(){
        $grade = new GradingModel();
        $data = array(
            'gradingCat' => $grade->getGradingCats()
        );
        return view('admin.view_gradingCat', $data);
    }

    public function processGradingCat(Request $request){
        $grade = new GradingModel();
        $data = array(
            'gradCat_name' => $request->grade_cat
        );
        $task = $request->task;
        if($task == 'add'):
            $grade->addGradingCat($data);
        elseif ($task == 'update'):
            $grade->updateGradingCat($data, $request->id);
        elseif ($task == 'delete'):
            $grade->deleteGradingCat($request->id);
        endif;

        return $this->loadGradingCatTable();

    }

    public function updateGradCat(Request $request){
        $grade = new GradingModel();
        return json_encode($grade->getGradingByid($request->id));
    }

    public function loadGradingCatTable(){
        $grade = new GradingModel();
        $tbody = '';
        $count = 1;

        $res = $grade->getGradingCats();

        foreach ($res as $row){
            $tbody .= '<tr>
                        <td>'.$count.'</td>
                        <td>'.$row->gradCat_name.'</td>
                        <td>
                        
                          <div class="btn-group">
                                <button type="button" class="btn btn-success">Action</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                 <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                     <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="editGradCat('.$row->gradCat_id.')"><i class="fa fa-edit"></i> Edit</a>
                                         </li>
                                         <li><a href="#" onclick="deleteGradCat('.$row->gradCat_id.')"><i class="fa fa-trash"></i> Delete</a>
                                         </li>
                                     </ul>
                             </div>
                        
                        </td>
                        </tr>';
            $count++;
        }
        return json_encode($tbody);

    }

    public function viewGrading(){
        $grading = new GradingModel();
        $data = array(
            'gradeCats' => $grading->getGradingCats()
        );
        return view('admin.view_grading', $data);
    }

    public function processGrading(Request $request){
        $grade = new GradingModel();
        $data = array(
            'grading_cat' => $request->gradecat,
            'grade_name' => $request->grade_name,
            'range_from' => $request->range_from,
            'range_to' => $request->range_to,
            'grade_comment' => $request->comment,
            'consist_of' => $request->consist_of

        );
        $task = $request->task;
        if($task == 'add'){
            $grade->addGrading($data);
        }elseif ($task == 'update'){
            $grade->updateGrading($data, $request->id);
        }elseif ($task == 'delete'){
            $grade->deleteGrade($request->id);
        }

        return $this->loadGradingTable($request->gradecat);
    }

    public function updateGrading(Request $request){
        $grade = new GradingModel();
        return json_encode($grade->getGradeById($request->id));
    }

    public function popGrading(Request $request){
        return $this->loadGradingTable($request->id);
    }

    public function loadGradingTable($gradeCat){
        $grading = new GradingModel();
        $res = $grading->getGrading($gradeCat);

        $tbody = '';
        $count = 1;

        foreach ($res as $row){
            $tbody .= '<tr>
                          
                                <td> '.$count.'</td>
                                <td> '.$row->grade_name.'</td>
                                <td>'.$row->range_from.' -- '.$row->range_to.'</td>
                                <td>'.$row->grade_comment.'</td>
                                <td>'. $row->consist_of .'</td>
                                <td>
                                
                                 <div class="btn-group">
                                <button type="button" class="btn btn-success">Action</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                 <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                     <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="editGrade('.$row->grading_id.')"><i class="fa fa-edit"></i> Edit</a>
                                         </li>
                                         <li><a href="#" onclick="deleteGrade('.$row->grading_id.')"><i class="fa fa-trash"></i> Delete</a>
                                         </li>
                                     </ul>
                             </div>
                                
                                </td>
                            </tr>';

            $count++;
        }

        return json_encode($tbody);
    }

    public function viewGradingToClass(){
        $grade = new GradingModel();
        $data = array(
            'gradeCats' => $grade->getGradingCats(),
            'class' => $grade->getClassNotAssigned(),
            'grades' => $grade->getGradingByClass()
        );
        return view('admin.view_grade_to_class', $data);
    }

    public function processGradeAssign(Request $request){
        $grade = new GradingModel();
        $data = array(
            'class' => $request->class,
            'grading_cat' => $request->gradecat
        );

        $task = $request->task;
        if($task == 'add'){
            $grade->assignGradeToClass($data);
        }elseif ($task == 'update'){
            $grade->updateGradeToClass($data, $request->id);
        }elseif ($task == 'delete'){
            $grade->deleteGradeFromClass($request->id);
        }

        return $this->loadAssigntable();
    }

    public function updateGradeAssign(Request $request){
        $grading = new GradingModel();
        return json_encode($grading->getGradingByClassById($request->id));
    }

    public function loadAssigntable(){
        $grading = new GradingModel();
        $res = $grading->getGradingByClass();

        $tbody = '';
        $count = 1;

        foreach ($res as $row){
            $tbody .= '<tr>
                          
                                <td> '.$count.'</td>
                                <td> '.$row->class_name.'</td>
                                <td>'.$row->gradCat_name.'</td>
                                <td>
                                
                                 <div class="btn-group">
                                <button type="button" class="btn btn-success">Action</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                 <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                     <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="editAssgnGrade('.$row->gtl_id.')"><i class="fa fa-edit"></i> Edit</a>
                                         </li>
                                         <li><a href="#" onclick="deleteGradeAssign('.$row->gtl_id.')"><i class="fa fa-trash"></i> Delete</a>
                                         </li>
                                     </ul>
                             </div>
                                
                                </td>
                            </tr>';

            $count++;
        }

        return json_encode($tbody);
    }


}
