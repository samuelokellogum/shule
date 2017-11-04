<?php

namespace App\Http\Controllers;

use App\GlobalModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminC extends Controller
{

    public function menuView(){
        $global = new GlobalModel();
        $users = new User();
        $data = array(
            'usergroups' => $users->getUserGroups(),
            'tabledata' => $global->getUserMenus()
        );
        return view('otherviews.menus', $data);
    }

    public function populateMenu(Request $request){
        $global = new GlobalModel();
        $menu = $global->getUnAssigedMenus($request->usergroup);
        $html = '<option value="">Select menu</option>';
        foreach ($menu as $row){
            $html .= '<option value="'.$row->menu_id.'">'.$row->menu_name.'</option>';
        }
        return json_encode($html);
    }

    public function assignMenu(Request $request){
        $global = new GlobalModel();
        $data = array(
            'menuid' => $request->menu,
            'user_g' => $request->usergroup
        );

        if($global->assignMenu($data)){
            return $this->popMenusTable();
        }
    }

    public function unassignMenu(Request $request){
        $global = new GlobalModel();
        if($global->unAssignMenu($request->id)){
            return $this->popMenusTable();
        }
    }

    public function popMenusTable(){
        $global = new GlobalModel();
        $tabledata = $global->getUserMenus();
        $tbody = '';
        $count = 1;
        foreach ($tabledata as $row){
            $tbody .= '<tr>
                            <td>'.$count.'</td>
                            <td>'.$row->userg_name.'</td>
                            <td>'.$row->menu_name.'</td>
                            <td><a href="#" onclick="unAssing('.$row->mid.')"><i class="fa fa-trash-o fa-fw"></i></a></td>
                       </tr>';
            $count++;
        }

        return json_encode($tbody);
    }



    public function viewUserGroup(){
        $users = new User();
        $data = array(
            'usergroups' => $users->getUserGroups()
        );

        return view('admin.view_userg',$data);
    }

    public function addUserGroup(Request $request){
        $users = new User();
        $data = array(
            'userg_name' => $request->usergroup,
            'audit' => Session::get('userid')
        );
        if($users->addUserGroup($data)){
            return $this->popUserGTable();
        }
    }

    public function fetchForEdit(Request $request){
        $users = new User();
        return json_encode($users->getUserGById($request->id));
    }

    public function upDateUserGroup(Request $request){
        $users = new User();
        $data = array(
            'userg_name' => $request->usergroup
        );

        if($users->updateUserGroup($data, $request->id)){
            return $this->popUserGTable();
        }else{
            return $this->popUserGTable();
        }
    }

    public function deleteUserGroup(Request $request){
        $users = new User();
        if($users->deleteUserGroup($request->id)){
            return $this->popUserGTable();
        }
    }

    public function popUserGTable(){
        $tbody = '';
        $count = 1;

        $users = new User();
        $res = $users->getUserGroups();

        foreach ($res as $row){
            $tbody .= '<tr>
                        <td>'.$count.'</td>
                        <td>'.$row->userg_name.'</td>
                        <td>
                       
                         
                         <div class="btn-group">
                                <button type="button" class="btn btn-success">Action</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                 <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                     <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="showModal('.$row->ug_id.')"><i class="fa fa-edit"></i> Edit</a>
                                         </li>
                                         <li><a href="#" onclick="deleteUgrp('.$row->ug_id.')"><i class="fa fa-trash"></i> Delete</a>
                                         </li>
                                     </ul>
                             </div>
                         
                        </td>
                       </tr>';
            $count++;
        }

        return json_encode($tbody);
    }

    public function viewUsers(){
        $users = new User();
        $data = array(
          'users' =>  $users->fetchUsers()
        );
        return view('admin.view_users', $data);
    }


    public function viewAddUser(){
        $users = new User();
        $data = array(
            'usergroups' => $users->getUserGroups(),
            'task' => 'add'
        );
        return view('admin.add_user', $data);
    }

    public function addUser(Request $request){
        $global = new GlobalModel();
        $users = new User();
        if($request->task == 'add'){
            if($request->hasFile('personimg')){
                $file = $request->file('personimg');
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
                'userg' => $request->usergroup,
                'image' => $image,
                'audit' => Session::get('userid')
            );

            $userid = $users->regUser($data);
            if($userid != null){
                $data2 = array(
                    'userid' => $userid,
                    'password' => '12345'
                );
                $users->addUserPwd($data2);

                return redirect()->route('viewUsers');
            }

        }elseif ($request->task == 'update'){
            $data = array(
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'contact' => $request->contact,
                'dob' => $request->dob,
                'userg' => $request->usergroup,
                'audit' => Session::get('userid')
            );

            if($users->updateUser($data, $request->userid)){
                return redirect()->route('viewUsers');
            }else{
                return redirect()->route('viewUsers');
            }
        }
    }

    public function getUserById($userId){
        $users = new User();
        $data = array(
            'usergroups' => $users->getUserGroups(),
            'userdata' => $users->fetchUserById($userId),
            'task' => 'update',
            'userid' => $userId
        );
        return view('admin.add_user', $data);
    }
}
