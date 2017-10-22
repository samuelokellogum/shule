<?php
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Created by IntelliJ IDEA.
 * User: CHARLES
 * Date: 13/10/2017
 * Time: 14:37
 */
class Helper
{

    public static function hello(){
        return 'Message from helper';
    }

    public static function MyRawQuery($query, $array){
        $someVariable = '';
        if(count($array) > 0){

        }
        $results = DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = :somevariable"), array(
            'somevariable' => $someVariable,
        ));
    }

    public static function importExcelFile($file){
        if(Input::hasFile($file)){
         $path = Input::file($file)->getRealPath();
         $content = Excel::load($path, function($reader) {})->get()[0];
         $headers = array();
         $data = array();
         $fulldata = array();
         foreach ($content[0] as $key => $value){
             $headers[] = $key;
         }

         foreach ($content->toArray() as $array ){

             if(count($array) > 0){
                 foreach ($array as $key => $value){
                     $data[$key] = $value;
                 }
                 $fulldata[] = $data;

             }

         }

         return [ 'headers' => $headers, 'data' => $fulldata];
     }
    }

    public static function exportExcelFile($list, $filename){
        $data = json_decode( json_encode($list), true);
        return Excel::create($filename, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->export('xls');
    }

}