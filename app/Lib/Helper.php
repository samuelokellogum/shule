<?php

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

}