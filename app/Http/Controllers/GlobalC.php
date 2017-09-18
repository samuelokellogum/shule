<?php

namespace App\Http\Controllers;

use App\GlobalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class GlobalC extends Controller
{
    //

    public function startUp(){
        $global = new GlobalModel();
        if($global->isConfigured()):
            return view('global.login');
           else:
            return view('global.configpage');
               endif;
    }

    public function addSchdata(Request $request){
        $global = new GlobalModel();
        $file = $request->file('logo');
       $logo = $request->schoolname.'-'.$global->generateRandomString().'.jpg';
        $filename = 'school_logos/'.$logo;
        $data = array(
            'school_name' => $request->schoolname,
            'school_address' => $request->schooladdress,
            'school_contact' => $request->schoolcontact,
            'school_moto' => $request->schoolmoto,
            'school_logo' => $logo,
            'school_website' => $request->schoolweb,
            'school_classes' => $request->schoolclass
        );
        if($request->hasFile('logo')){
            Storage::disk('local')->put($filename, File::get($file));
            $global->addSchData($data);
            return json_encode(['success' => 1]);
        }else{
            return json_encode(['success' => 0]);
        }


    }

    public function addPsData(Request $request){
        $global = new GlobalModel();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $request->fname.'-'.$global->generateRandomString().'.jpg';
            $filename = 'users/'.$image;
            Storage::disk('local')->put($filename, File::get($file));
        }else{
            $image = "none";
        }

        $data = array(
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
            'dob' => $request->dob,
            'userg' => 1,
            'image' => $image,
            'audit' => 1
        );

        $id = $global->addPsData($data);
        if($id){
            return json_encode(['success' => 1, 'userid' => $id]);
        }else{
            return json_encode(['success' => 0]);
        }
    }

    public function addPassword(Request $request){
        $global = new GlobalModel();
        $data = array(
            'userid' => $request->userid,
            'password' => $request->password
        );

        if($global->addPassword($data)){
            return json_encode(['success' => 1]);
        }else{
            return json_encode(['success' => 0]);
        }

    }

    public function loginUser(Request $request){
        $global = new GlobalModel();
        $res = $global->authUser($request->email, $request->password);
       if(count($res) == 1){
            Session::put('username', $res->fname.' '.$res->lname);
            Session::put('userid', $res->userid);
            Session::put('userimage',$res->image);
            Session::put('usergoup',$res->userg_name);
            Session::put('usergroupid', $res->userg);
            return redirect()->route('home');
        }else{
            return view('global.login',['error' => 'Wrong email or password']);
        }
    }

    public function getUserImage($image){

        $file = 'users/'.$image;
        if(Storage::disk('local')->has($file)){
          $img = Storage::disk('local')->get($file);
        }else{
            $img = Storage::disk('local')->get('users/user.jpg');
        }
        return $img;
    }

    public function logoutUser(){
        Session::forget('username');
        Session::forget('userid');
        Session::forget('userimage');
        Session::forget('usergoup');
       return view('global.login');
    }

    public function home(){
        return view('otherviews.dashboard');
    }

}
