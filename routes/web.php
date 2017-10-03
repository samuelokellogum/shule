<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/',[
        'uses' => 'GlobalC@startUp',
        'as' => 'startup'
    ]);

    Route::post('/addSchData',[
        'uses' => 'GlobalC@addSchdata',
        'as' => 'addSchData'
    ]);

    Route::post('/addPrsnData',[
        'uses' => 'GlobalC@addPsData',
        'as' => 'addPrsnData'
    ]);

    Route::post('/addPassword',[
        'uses' => 'GlobalC@addPassword',
        'as' => 'addPassword'
    ]);

    Route::post('/authUser',[
        'uses' => 'GlobalC@loginUser',
        'as' => 'authUser'
    ]);

    //all route go under this middleware
    Route::group(['middleware' => ['isLoggedIn']], function () {
        Route::get('/home',[
            'uses' => 'GlobalC@home',
            'as' => 'home'
        ]);

        Route::get('/logout',[
            'uses' => 'GlobalC@logoutUser',
            'as' => 'logout'
        ]);


        /*
        |-------------
        |Developer routes
        |---------------------------
        */

        Route::get('/developerView',[
            'uses' => 'DeveloperC@index',
            'as' => 'devView'
        ]);

        Route::post('/addMenu',[
            'uses' => 'DeveloperC@addMenu',
            'as' => 'addMenu'
        ]);

        Route::post('/addSubMenu',[
            'uses' => 'DeveloperC@addSubMenu',
            'as' => 'addSubMenu'
        ]);

        /*
        |-------------
        |End Developer routes
        |---------------------------
        */

        /* populate menu according to usergroup */
        Route::post('/populateMenu',[
            'uses' => 'AdminC@populateMenu',
            'as' => 'popMenuByUG'
        ]);



        Route::get('/menuView',[
            'uses' => 'AdminC@menuView',
            'as' => 'menuView'
        ]);

        /*
       |-------------
       |Users routes
       |---------------------------
       */

        Route::get('/viewUsers',[
            'uses' => 'AdminC@viewUsers',
            'as' => 'viewUsers'
        ]);

        Route::post('/assignUserMenus',[
            'uses' => 'AdminC@assignMenu',
            'as' => 'aUmenus'
        ]);

        Route::post('/unAssign',[
            'uses' => 'AdminC@unassignMenu',
            'as' => 'unAssign'
        ]);

        Route::get('viewUserGroups',[
            'uses' => 'AdminC@viewUserGroup',
            'as'=> 'viewUserGroups'
        ]);

        Route::post('/addUserGroup',[
            'uses' => 'AdminC@addUserGroup',
            'as' => 'addUserGroup'
        ]);

        Route::post('/showForEdit',[
            'uses' => 'AdminC@fetchForEdit',
            'as' => 'showForEdit'
        ]);

        Route::post('/updateUserGroup',[
            'uses' => 'AdminC@upDateUserGroup',
            'as' => 'updateUserGroup'
        ]);

        Route::post('/deleteUserGroup',[
            'uses' => 'AdminC@deleteUserGroup',
            'as' => 'deleteUserGroup'
        ]);

        Route::get('/viewAddUser',[
            'uses' => 'AdminC@viewAddUser',
            'as' => 'viewAddUser'
        ]);

        Route::post('/addUser',[
            'uses' => 'AdminC@addUser',
            'as' => 'addUser'
        ]);

        Route::get('/getUserById/{userid}',[
            'uses' => 'AdminC@getUserById',
            'as' => 'viewUserById'
        ]);

        Route::get('/userImage/{filename}',[
            'uses' => 'GlobalC@getUserImage',
            'as' => 'userImage'
        ]);


        /*
       |-------------
       |End Users routes
       |---------------------------
       */

        /*
       |-------------
       |Classes routes
       |---------------------------
       */

        Route::get('/viewClasses',[
            'uses' => 'ClassC@viewClass',
            'as' => 'viewClasses'
        ]);

        Route::get('updateClassList',[
            'uses' => 'ClassC@popClassList',
            'as' => 'updateClassList'
        ]);

        Route::post('/addClass',[
            'uses' => 'ClassC@addClass',
            'as' => 'addClass'
        ]);

        Route::post('/getClassForEdit',[
            'uses' => 'ClassC@getCForEdit',
            'as' => 'getCForEdit'
        ]);

        Route::post('/updateClass',[
            'uses' => 'ClassC@updateClass',
            'as' => 'updateClass'
        ]);

        Route::post('/deleteClass',[
            'uses' => 'ClassC@deleteClass',
            'as' => 'deleteClass'
        ]);

        Route::post('/popClassSecTable',[
            'uses' => 'ClassC@popClassSecTable',
            'as' => 'popCSecTale'
        ]);

        //get users for teacher selection
        Route::post('/getUsersAsTeachers',[
            'uses' => 'ClassC@getUsers',
            'as' => 'gUserT'
        ]);

        Route::post('/addClassSec',[
            'uses' => 'ClassC@addClassSection',
            'as' => 'addClassSec'
        ]);

        Route::post('/getClassSecFEdit',[
            'uses' => 'ClassC@fetchClassSecForEdit',
            'as' => 'gCesFEdit'
        ]);

        Route::post('/updateClassSec',[
            'uses' => 'ClassC@updateClassSec',
            'as' => 'updateCsec'
        ]);

        Route::post('/deleteClassSec',[
            'uses' => 'ClassC@deleteClassSec',
            'as' => 'deleteClassSec'
        ]);


        /*
       |-------------
       |End class routes
       |---------------------------
       */

        /*
      |-------------
      |Subject routes
      |---------------------------
      */

        Route::get('/viewSubject',[
            'uses' => 'SubjectC@viewSubjects',
            'as' => 'viewSubject'
        ]);

        Route::post('/addSubject',[
            'uses' => 'SubjectC@addSubject',
            'as' => 'addSubject'
        ]);

        Route::post('/getSubForEdit',[
            'uses' => 'SubjectC@getSubForEdit',
            'as' => 'gSubFEdit'
        ]);

        Route::post('/updateSubject',[
            'uses' => 'SubjectC@upDateSubject',
            'as' => 'updateSub'
        ]);

        Route::post('/deletSubject',[
            'uses' => 'SubjectC@deleteSubject',
            'as' => 'deleteSub'
        ]);

        Route::get('/viewAssignSub',[
            'uses' => 'SubjectC@viewAssignSub',
            'as' => 'viewAssigSub'
        ]);

        Route::post('/assignSubject',[
            'uses' => 'SubjectC@assignSubject',
            'as' => 'assignSub'
        ]);

        Route::get('/viewSubjectTeachers/{subject_id}/{class_id}/{class_name}',[
            'uses' => 'SubjectC@viewSubjectTeachers',
            'as' => 'viewSubTeachers'
        ]);

        Route::post('/removeTeacher',[
            'uses' => 'SubjectC@removeTeacher',
            'as' => 'removeTeacher'
        ]);

        /*
       |-------------
       |End subject routes
       |---------------------------
       */



        /*
       |-------------
       |Grading routes
       |---------------------------
       */

        Route::get('/viewGrading',[
            'uses' => 'GradingC@viewGrading',
            'as' => 'viewGrading'
        ]);

        Route::post('/addGrading',[
            'uses' => 'GradingC@addGrading',
            'as' => 'addGrading'
        ]);



        /*
       |-------------
       |End grading routes
       |---------------------------
       */



        /*
       |-------------
       |Testing route
       |---------------------------
       */

        Route::get('/test',[
            'uses' => 'TestC@testC',
            'as'=> 'test'
        ]);

        Route::get('/popTmenu',[
            'uses' => 'AdminC@popMenusTable',
            'as' => 'popTmenu'
        ]);

        /*
       |-------------
       |End Users routes
       |---------------------------
       */
    });
});








