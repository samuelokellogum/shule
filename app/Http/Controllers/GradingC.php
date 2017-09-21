<?php

namespace App\Http\Controllers;

use App\GradingModel;
use App\SubjectModel;
use Illuminate\Http\Request;

class GradingC extends Controller
{

    public function viewGrading(){
        $subject = new SubjectModel();
        $grading = new GradingModel();
        $data = array(
            'subjects' => $subject->getSubjects()
        );
        return view('admin.view_grading', $data);
    }

    public function addGrading(Request $request){
        $grade = new GradingModel();
        $data = array(
            'subjectid' => $request->id,
            'range_from' => $request->range_from,
            'range_to' => $request->range_to,
            'label' => $request->label,
            'consist_of' => $request->consist_of

        );
       if($grade->addGrading($data)){
            return $this->loadGradingTable($request->id);
        }
    }

    public function updateGrading(Request $request){
        $input = filter_input_array(INPUT_POST);
       /* $data = array(
            'subjectid' => $request->id,
            'range_from' => $request->range_from,
            'range_to' => $request->range_to,
            'label' => $request->label,
            'consist_of' => $request->consist_of

        );*/
        if ($input['action'] == 'edit') {
            return json_encode(['message' => 'edit']);
        }
        if ($input['action'] == 'delete') {
            return json_encode(['message' => 'delete']);
        }

    }

    public function loadGradingTable($subjectid){
        $grading = new GradingModel();
        $res = $grading->getGrading($subjectid);

        $tbody = '';
        $count = 1;

        foreach ($res as $row){
            $tbody .= '<tr>
                              <td> '.$row->grading_id.'</td>
                                <td> '.$count.'</td>
                                <td> '.$row->range_from.'</td>
                                <td>'.$row->range_to.'</td>
                                <td>'.$row->label.'</td>
                                <td>'. $row->consist_of .'</td>
                             
                            </tr>';

            $count++;
        }

        return json_encode($tbody);
    }
}
