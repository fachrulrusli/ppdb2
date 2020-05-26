<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Auth\Contracts\IUserRepository as currentRepo;
use Illuminate\Support\Facades\Session;
use PDOException;
use Yajra\Datatables\Facades\Datatables;
use Gate;
use App\Consyst\Misc\ConsystHelper;
use Auth;
use Crypt;
use Hash;
/**
 * Class UserControllers
 * Controller for handling User function
 *
 * @package App\Http\Controllers\Admin
 */
class UserController extends MainControllers
{

    /**
     * UserControllers constructor.
     */

    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);
        $this->param = array(
            'gate_edit'         => 'user-ajaxman',
            'gate_delete'       => 'user-delete',
            'gate_user_menu'    => 'user-menu',
            'view_base'         => 'admin.user.view',
            'view_man'          => 'admin.user.man',
            'view_menu'         => 'admin.menu',
            'view_user_akses'   => 'admin.user.akses',
            'view_user_menu'   => 'admin.user.menu'

        );

    }
    /**
     * handling tabledata data supply ( ajax )
     *
     * @author Hardiyansyah
     * @return mixed
     */
    public function viewUser()
    {

        if ($this->request->ajax()) {
       

            $toolbar = ConsystHelper::generateToolbarButton(1);
      
            $pages = (object)array(
                'title' => trans('view.user.title'),
                'breadcrumb' => \Breadcrumbs::render('user'),
                'box_title' => trans('view.user.box_title'),
                'toolbar' => $toolbar
            );
            $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_base'], array('pages' => $pages))->render();
            return \Response::json(['html' => $html]);
        } else {
            return \Response::view('errors.401');
        }

    }
    public function ajaxData()
    {
              $buffer = $this->repository->getUser();
                return Datatables::of($buffer)
                    ->addColumn('action', function ($data) {
                        $edit = route('form-user', ['act' => 2, 'id_user' => $data->id_user]);
                        $editbutton = array(
                            'id' => $data->id_user,
                            'id_prefix' => 're',
                            'url' => $edit,
                            'icon' => 'glyphicon glyphicon-edit',
                            'button_class' => 'btnPerm',
                            'button_type' => 'btn-primary',
                            'on_click' => 'ajaxEdit',
                            'title' => trans('button.global.edit')
                        );
                        $deletebutton = array(
                            'id' => $data->id_user,
                            'id_prefix' => 'rd',
                            'url' => '#',
                            'icon' => 'glyphicon glyphicon-trash',
                            'button_class' => 'btnPerm',
                            'button_type' => '',
                            'on_click' => 'showConfirm',
                            'title' => trans('button.global.delete')
                        );

                        $bufferButton1 = array(
                            'id' => $data->id_user,
                            'id_prefix' => 'rf',
                            'url' => route('form-user-akses', ['id_user' => $data->id_user]),
                            'icon' => 'glyphicon glyphicon-wrench',
                            'button_class' => 'btnAkses',
                            'button_type' => '',
                            'on_click' => 'ajaxEdit',
                            'title' => trans('button.user.akses')
                        );

                        $bufferButton2 = array(
                            'id' => $data->id_user,
                            'id_prefix' => 'rm',
                            'url' => route('form-user-menu', ['id_user' => $data->id_user]),
                            'icon' => 'glyphicon glyphicon-list-alt',
                            'button_class' => 'btnPerm',
                            'button_type' => '',
                            'on_click' => 'ajaxEdit',
                            'title' => trans('button.user.menu')
                        );
                        $bufferbutton = array();
                        array_push($bufferbutton, $editbutton, $bufferButton1, $bufferButton2, $deletebutton);
                        $bt = ConsystHelper::generateActionButtonExAction($bufferbutton);
                        return $bt;
                    })
                    ->editColumn('username', function ($data) {
                        $edit = route('form-user', ['act' => 2, 'id_user' => $data->id_user]);
                        $act = array(
                            'id' => $data->id_user,
                            'id_prefix' => 'ru',
                            'url' => $edit,
                            'icon' => 'glyphicon glyphicon-edit',
                            'title' => $data->username
                        );
                        return ConsystHelper::generateUrlAction($act);
                    })
                    ->make(true);

    }
    public function formUser($act, $id)
    {
            // var_dump($act);die();
       
            $display = "";
            $readonly = "";
    
            $ref = $this->repository->getReference();
            if ($act == 1) // new
            {
                $pages = (object)array(
                    'title'         => trans('view.user.title'),
                    'breadcrumb'    => \Breadcrumbs::render('new_user'),
                    'box_title'     => trans('view.user.box_title'),
                    'subtitle'      => trans('view.user.subtitle'),
                    'action'        => trans('view.user.add'),
                    'display'       => $display,
                    'readonly'      => $readonly
                );
                $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'], array('pages' => $pages,'ref'=>$ref))->render();
                return \Response::json(['html' => $html]);
            } else { //edit
                if (Session::get('secret')['grup'] == '11') {
                    $display = "none";
                } else {
                      $display = "";
                }
                if (isset($id)) {
                    $pages = (object)array(
                        'title'         => trans('view.user.title'),
                        'breadcrumb'    => \Breadcrumbs::render('edit_user'),
                        'box_title'     => trans('view.user.box_title'),
                        'subtitle'      => trans('view.user.subtitle'),
                        'action'        => trans('view.user.edit'),
                        'display'       => $display,
                        'readonly'      => $readonly
                    );
                    $data = $this->repository->find($id);
                   
                    $grp = $this->repository->getGroups($id)->pluck('id_grup')->all();
                    
                    $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'], array('pages' => $pages,'ref'=>$ref,'data'=>$data,'grup'=>$grp,'act'=>2))->render();
                    return \Response::json(['html' => $html]);
                }
            }
    }

    public function formUserAkses($id)
    {
        $perm = $this->repository->getPerm();

        $data = $this->repository->getPermById($id);
        $selUser = $this->repository->find($id);

        $pages = (object)array(
            'title' => trans('view.user.akses.title'),
            'breadcrumb' => \Breadcrumbs::render('akses_user'),
            'box_title'     => trans('view.user.box_title'),
            'subtitle'      => trans('view.user.subtitle'),
            'action'        => trans('view.user.edit')
        );

        $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_user_akses'], array('pages' => $pages, 'akses' => $perm, 'data' => $data, 'user' => $selUser))->render();
        return \Response::json(['html' => $html]);
    }
    public function formUserMenu($id)
    {
        $buffer = $this->repository->getMenu();
        $data = $this->repository->getMenuById($id);
        $selUser = $this->repository->find($id);

        $pages = (object)array(
            'title' => trans('view.user.menu.title'),
            'breadcrumb' => \Breadcrumbs::render('menu_user'),
            'box_title'     => trans('view.user.box_title'),
            'subtitle'      => trans('view.user.subtitle'),
            'action'        => trans('view.user.edit')
        );

        $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_user_menu'], array('pages' => $pages, 'menu' => $buffer, 'data' => $data, 'user' => $selUser))->render();
        return \Response::json(['html' => $html]);

    }
    public function userPost()
    {

        if ($this->request->ajax()) {
            if ($this->request->action == 3) {

                try{

                    if ($this->repository->delete($this->request->id_user)) {
                        $rtn = ConsystHelper::generateJsonAction(trans('message.delete_success'), 99);
                        return \response($rtn);
                    } else {
                        $rtn = ConsystHelper::generateJsonAction(trans('message.update_failed'), 0);
                        return \response($rtn);
                    }

                } catch (PDOException $e) {
                    $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                    return \response($rtn);
                }

            }
            $validator = $this->repository->validate($this->request);
            if ($validator->fails()) {
                $html = \view(\Config::get('consyst.view_parials') . 'error-box', array('errors' => $validator->errors()->toArray()))->render();
                return \response(['html' => $html, 'raw' => trans("message.validation_notice")], 201);
            }
            if (!empty($this->request->action)) {
                $this->data = array(
                    "username" => $this->request->username,
                    "nama_user" => $this->request->nama_user,
                    "status" => $this->request->status
                );

                if (!empty($this->request->password)) {

                    $this->data = array_add($this->data, "password", Hash::make($this->request->password));

                }
                if (!empty($this->request->password_otorisasi)) {
                    $this->data = array_add($this->data, "password_otorisasi", Hash::make($this->request->password_otorisasi));
                }

                if ($this->request->action == 1) {

                    // new
                    $this->data = array_add($this->data, 'created_by', strtoupper($this->request->session()->get('secret.name')));
                    $rule = array(
                        'password' => 'required|max:12'
                    );
                    $validator = $this->repository->validate($this->request, $rule);
                    if ($validator->fails()) {
                        $html = \view(\Config::get('consyst.view_parials') . 'error-box', array('errors' => $validator->errors()->toArray()))->render();
                        return \response(['html' => $html, 'raw' => trans("message.validation_notice")], 201);
                    }

                    try {
                        //if ($this->repository->create($this->data)) {

                        if ($this->repository->store($this->data, $this->request->grup)) {
                            //return success response
                            $rtn = ConsystHelper::generateJsonAction(trans('message.save_success'), 1);
                            return \response($rtn);
                        } else {
                            $rtn = ConsystHelper::generateJsonAction(trans('message.save_failed'), 0);
                            return \response($rtn);
                        }
                    } catch (PDOException $e) {
                        $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                        return \response($rtn);
                    }
                } else {
                    // edit

                    try {
                        if ($this->repository->UpdateX($this->data, $this->request->grup, $this->request->id)) {

                            $rtn = ConsystHelper::generateJsonAction(trans('message.update_success'), 1);
                            return \response($rtn);
                        } else {

                            $rtn = ConsystHelper::generateJsonAction(trans('message.update_failed'), 0);
                            return \response($rtn);
                        }
                    } catch (PDOException $e) {
                        $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                        return \response($rtn);
                    }
                }
            } else {
               return \Response::json(trans('message.direct_access_notice'), 403);

            }
        } else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }

    public function userAksesPost()
    {


        if ($this->request->ajax()) {
            if (!empty($this->request->action)) {

                try {
                    //if ($this->repository->create($this->data)) {
                    if ($this->repository->storePerm($this->request->id, $this->request->akses)) {
                        //return success response
                        $rtn = ConsystHelper::generateJsonAction(trans('message.save_success'), 1);
                        return \response($rtn);
                    } else {
                        $rtn = ConsystHelper::generateJsonAction(trans('message.save_failed'), 0);
                        return \response($rtn);
                    }
                } catch (PDOException $e) {
                    $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                    return \response($rtn);
                }

            } else {
                return \Response::json(trans('message.direct_access_notice'), 403);
            }
        } else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }
    public function userMenuPost()
    {
        if ($this->request->ajax()) {
            if (!empty($this->request->action)) {
                try {
                    //if ($this->repository->create($this->data)) {
                    if ($this->repository->storeMenus($this->request->id, $this->request->menu)) {
                        //return success response
                        $rtn = ConsystHelper::generateJsonAction(trans('message.save_success'), 1);
                        return \response($rtn);
                    } else {
                        $rtn = ConsystHelper::generateJsonAction(trans('message.save_failed'), 0);
                        return \response($rtn);
                    }
                } catch (PDOException $e) {
                    $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                    return \response($rtn);
                }

            } else {
                return \Response::json(trans('message.direct_access_notice'), 403);
            }
        } else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }
    public function userGetcabang()
    {
        if ($this->request->ajax()) {
            $ref = $this->repository->getCabang($this->request->branch_type);
            return \Response::json($ref);
        }
        else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }
    public function changeStatus($id)
    {
        if ($this->request->ajax()) {
            if (!empty($id)) {
                try {
                    //check existing permission
                    $data = $this->repository->find($this->request->id);
                    if ($data->count() > 0) {
                        $st = ($data->status == 1 ? '0' : '1');
                        if ($this->repository->changeStatus($this->request->id, $st)) {
                            //return success response
                            $rtn = ConsystHelper::generateJsonAction(trans('message.update_success'), 1);
                            return \response($rtn);
                        } else {
                            // error during saving record
                            $rtn = ConsystHelper::generateJsonAction(trans('message.update_failed'), 0);
                            return \response($rtn);
                        }
                    } else {
                        $rtn = ConsystHelper::generateJsonAction(trans('message.record_not_found'), 0);
                        // throw permission allready exist
                        return \response($rtn);
                    }
                } catch (PDOException $e) {
                    $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                    return \response($rtn);
                }

            } else {
                return \Response::json(trans('message.direct_access_notice'), 403);
            }
        } else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }

}