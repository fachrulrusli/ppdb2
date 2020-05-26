<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// FRONTEND


Route::get('/', function () {
    return view('index');
});
Route::get('/berita', function () {
    return view('berita/view');
});
Route::get('/jenispendaftar', function () {
    return view('jenispendaftar/view');
});
Route::get('/alurpendaftar', function () {
    return view('alurpendaftar/view');
});
Route::get('/progress', function () {
    return view('progress/view');
});
Route::get('/bantuan', function () {
    return view('bantuan/view');
});




// BACKEND

Route::group(['middleware' => ['web', 'guest']], function () {
    Route::get('/signin',
        ['as' => 'signin',
            'uses' => 'Auth\LoginController@check',
        ]);
    Route::post('/login',
        ['as' => 'login',
            'uses' => 'Auth\AuthController@postLogin',]);

    Route::get('/adminppdb',
        ['uses' => 'Auth\LoginController@check']);
    
    Route::get('/forgot',
        ['as' => 'forgot',
            'uses' => 'Auth\ForgotPasswordController@showResetForm',]);
    Route::post('/forgot/token',
        ['as' => 'forgot-link',
            'uses' => 'Auth\ForgotPasswordController@forgot',]);
    Route::get('/forgot/token/{token?}',
        ['as' => 'forgot-token',
            'uses' => 'Auth\ForgotPasswordController@showformwithtoken',]);
    Route::POST('/forgot/reset',
        ['as' => 'reset',
            'uses' => 'Auth\ForgotPasswordController@reset',]);
   
});





Route::group(['middleware' => ['web', 'auth', 'permissions.required']], function () {

    Route::get('/404',
        ['as' => 'ajax404',
            'uses' => 'Admin\ErrorControllers@view404',]);

    Route::get('check-session', 'Auth\LoginController@checkSession');

    Route::get('/adminppdb',
        ['uses' => 'Auth\LoginController@check']);

    Route::post('/login',
        ['as' => 'login',
            'uses' => 'Auth\LoginController@postLogin',]);


    Route::get('/logout',
        ['as' => 'logout',
            'uses' => 'Auth\LoginController@getLogout',]);
    //modul/admin/user
    Route::get('/root/user',
        ['as' => 'user',
            'uses' => 'Admin\UserController@viewUser',]);

    Route::get('user-ajaxdata',
        ['as' => 'user-ajaxdata',
            'uses' => 'Admin\UserController@ajaxData',]);

    Route::post('/root/user/post',
        ['as' => 'post-user',
            'uses' => 'Admin\UserController@userPost',]);

    Route::get('/root/user/del/{id}',
        ['as' => 'user-delete',
            'permissions' => 'user-delete',
            'uses' => 'Admin\UserController@ajaxDel',]);

    Route::get('root/user/form/{act}/{id}',
        ['as' => 'form-user',
            'uses' => 'Admin\UserController@formUser',]);

    Route::get('root/user/akses/{id}',
        ['as' => 'form-user-akses',
            'uses' => 'Admin\UserController@formUserAkses',]);

    Route::get('root/user/menu/{id}',
        ['as' => 'form-user-menu',
            'uses' => 'Admin\UserController@formUserMenu',]);

    Route::get('root/user/form/akses/',
        ['as' => 'post-user-akses',
            'uses' => 'Admin\UserController@userAksesPost',]);

    Route::get('root/user/form/menu/',
        ['as' => 'post-user-menu',
            'uses' => 'Admin\UserController@userMenuPost',]);

    Route::get('user-ajaxstatus/{id}',
        ['as' => 'user-ajaxstatus',
            'permissions' => 'user-post-edit',
            'uses' => 'Admin\UserController@ajaxStatus',]);
    Route::get('user-change-status/{id}',
        ['as' => 'user-change-status',
            'uses' => 'Admin\UserController@changeStatus',]);
    Route::post('/root/user/getcabang',
        ['as' => 'post-getcabang',
            'uses' => 'Admin\UserController@userGetcabang',]);



    //menu
    Route::get('root/menu',
        ['as' => 'menu',
            'uses' => 'Admin\MenuControllers@viewMenu',]);
    Route::post('root/menu/data',
        ['as' => 'data-menu',
            'uses' => 'Admin\MenuControllers@dataMenu',]);
    Route::get('root/menu/get/data',
        ['as' => 'get-menu',
            'uses' => 'Admin\MenuControllers@getMenu',]);
    Route::post('root/menu/update/utama/{id?}',
        ['as' => 'update-menu-utama',
            'uses' => 'Admin\MenuControllers@MenuUtama',]);
    Route::post('root/menu/insert',
        ['as' => 'menu-insert',
            'uses' => 'Admin\MenuControllers@MenuInsert',]);
    Route::post('root/menu/edit/{id?}',
        ['as' => 'menu-edit',
            'uses' => 'Admin\MenuControllers@MenuEdit',]);
    Route::post('root/menu/delete/{id?}',
        ['as' => 'menu-delete',
            'uses' => 'Admin\MenuControllers@MenuDelete',]);


    // Master Group
    Route::get('root/group',
        ['as' => 'group',
            'uses' => 'Admin\GroupControllers@viewGroup',]);
    Route::get('root/group/data',
        ['as' => 'data-group',
            'uses' => 'Admin\GroupControllers@dataGroup',]);
    
    // Master Akses
    Route::get('admin/access',
        ['as' => 'akses',
            'uses' => 'Admin\AksesControllers@viewAkses',]);
    Route::post('admin/access/data',
        ['as' => 'data-akses',
            'uses' => 'Admin\AksesControllers@dataAkses',]);
    Route::post('admin/access/insert',
        ['as' => 'akses-insert',
            'uses' => 'Admin\AksesControllers@AksesInsert',]);
    Route::post('admin/access/edit/{id?}',
        ['as' => 'akses-edit',
            'uses' => 'Admin\AksesControllers@AksesEdit',]);
    Route::post('admin/access/delete/{id?}',
        ['as' => 'akses-delete',
            'uses' => 'Admin\AksesControllers@AksesDelete',]);
    //Master Branch

    Route::get('admin/branch/form/{act}/{id}',
        ['as' => 'form-branch',
            'uses' => 'Admin\CabangControllers@formBranch',]);
    Route::post('admin/branch/submit',
        ['as' => 'post-branch',
        'uses' => 'Admin\CabangControllers@postBranch',]);

    Route::get('admin/branchnew/submit',
        ['as' => 'post-branch-baru',
        'uses' => 'Admin\CabangControllers@postBranchbaru',]);


    Route::get('data/group/new/{act}/{id}',
        ['as' => 'group-man',
            'uses' => 'Admin\GroupControllers@formGroup',]);
    Route::post('root/group/submit',
        ['as' => 'post-group',
            'uses' => 'Admin\GroupControllers@postGroup',]);

    Route::get('grup-change-status/{id}',
        ['as' => 'grup-change-status',
            'uses' => 'Admin\GroupControllers@changeStatus',]);

    Route::get('admin/access/form/{act}/{id}',
        ['as' => 'form-akses',
            'uses' => 'Admin\AksesControllers@formAkses',]);
    Route::post('admin/access/submit',
        ['as' => 'post-akses',
            'uses' => 'Admin\AksesControllers@postAkses',]);

    //akses grup
    Route::get('root/group/akses/{id}',
        ['as' => 'form-group-akses',
            'uses' => 'Admin\GroupControllers@formGroupAkses',]);

    Route::get('root/group/menu/{id}',
        ['as' => 'form-group-menu',
            'uses' => 'Admin\GroupControllers@formGroupMenu',]);

    Route::get('root/group/report/{id}',
        ['as' => 'form-group-report',
            'uses' => 'Admin\GroupControllers@formGroupReport',]);

    Route::get('root/group/form/akses/',
        ['as' => 'post-group-akses',
            'uses' => 'Admin\GroupControllers@groupAksesPost',]);

    Route::get('root/group/form/menu/',
        ['as' => 'post-group-menu',
            'uses' => 'Admin\GroupControllers@groupMenuPost',]);

    Route::get('root/group/form/report/',
        ['as' => 'post-group-report',
            'uses' => 'Admin\GroupControllers@groupReportPost',]);




    Route::get('menu-change-status/{id}',
        ['as' => 'menu-change-status',
            'uses' => 'Admin\MenuControllers@changeStatus',]);
    Route::get('branch-change-status/{id}',
        ['as' => 'branch-change-status',
            'uses' => 'Admin\CabangControllers@changeStatus',]);

     //Master Reference
    Route::get('root/reference',
        ['as' => 'reference',
            'uses' => 'Admin\ReferenceControllers@viewReference',]);
    Route::get('root/reference/data',
        ['as' => 'data-reference',
            'uses' => 'Admin\ReferenceControllers@dataReference',]);
    Route::get('root/reference/form/{act}/{id}',
        ['as' => 'form-reference',
            'uses' => 'Admin\ReferenceControllers@formReference',]);
    Route::post('root/reference/submit',
        ['as' => 'post-reference',
            'uses' => 'Admin\ReferenceControllers@postReference',]);

    // MASTER BERITA
    
    Route::get('master/berita',
        ['as' => 'berita',
            'uses' => 'Master\BeritaControllers@view',]);
    Route::post('master/berita/data',
        ['as' => 'data-berita',
            'uses' => 'Master\BeritaControllers@data',]);

});

