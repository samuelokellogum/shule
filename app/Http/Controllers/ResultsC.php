<?php

namespace App\Http\Controllers;

use App\ClassModel;
use App\SubjectModel;
use Illuminate\Http\Request;

class ResultsC extends Controller
{
    public function viewResults(){
        return view('results.view_results');
    }

    public function addResults(){
        return view('results.view_add_results');
    }

    public function addResultsBulk(){
        $class = new ClassModel();
        $data = array(
            'classes' => $class->getClasses()
        );
        return view('results.view_addResults_bulk', $data);
    }

    public function updateResults(){

    }

    public function requestResultsChange(){

    }
}
