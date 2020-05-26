<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Auth\Contracts\IGrupRepository as currentRepo;
use App\Consyst\Misc\ConsystHelper;
use Yajra\Datatables\Facades\Datatables;
use Gate;


class GroupControllers extends MainControllers
{
    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);
        $this->param = array(
            'view_menu' =>"master.group.view",
            'view_man'  =>"master.group.man",
            'view_group_akses'   => 'master.group.akses',
            'view_group_menu'   => 'master.group.menu',
            'view_group_report'   => 'master.group.report'
        );
    }

    public function viewGroup()
    {
        if ($this->request->ajax()) {
            $toolbar = ConsystHelper::generateToolbarButton(true);
            $pages = (object) array(
                'title'      => trans('view.group.title'),
                'breadcrumb' => \Breadcrumbs::render('group'),
                'box_title'  => trans('view.group.box_title'),
                'content'    => '',
                'toolbar'    => $toolbar,
                'subtitle'   => '',
            );

            $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_menu'], array('pages' => $pages))->render();
            return \Response::json(['html' => $html]);
        } else {
            return \Response::view('errors.401');
        }
    }

    public function dataGroup()
    {
        $buffer = $this->repository->all();

        return Datatables::of($buffer)
            ->addColumn('action', function ($data) {
                $edit = route('group-man', ['act' => 2, 'id_grup' => $data->id_grup]);
                $editbutton= array(
                    'id' => $data->id_grup,
                    'id_prefix' => 're',
                    'url' => $edit,
                    'icon' => 'glyphicon glyphicon-edit',
                    'button_class' => 'btnPerm',
                    'button_type' => 'btn-primary',
                    'on_click' => 'ajaxEdit',
                    'title' => trans('button.global.edit')
                );
                $deletebutton = array(
                    'id' => $data->id_grup,
                    'id_prefix' => 'rd',
                    'url' =>  '#',
                    'icon' => 'glyphicon glyphicon-trash',
                    'button_class' => 'btnPerm',
                    'button_type' => '',
                    'on_click' => 'showConfirm',
                    'title' => trans('button.global.delete')
                );
                $bufferButton1 = array(
                    'id' => $data->id_grup,
                    'id_prefix' => 'rf',
                    'url' => route('form-group-akses',['id_grup' => $data->id_grup]),
                    'icon' => 'glyphicon glyphicon-wrench',
                    'button_class' => 'btnAkses',
                    'button_type' => '',
                    'on_click' => 'ajaxEdit',
                    'title' => trans('button.user.akses')
                );
                $bufferButton2 = array(
                    'id' => $data->id_grup,
                    'id_prefix' => 'rm',
                    'url' => route('form-group-menu',['id_grup' => $data->id_grup]),
                    'icon' => 'glyphicon glyphicon-list-alt',
                    'button_class' => 'btnPerm',
                    'button_type' => '',
                    'on_click' => 'ajaxEdit',
                    'title' => trans('button.user.menu')
                );
                $bufferButton3 = array(
                    'id' => $data->id_grup,
                    'id_prefix' => 'rr',
                    'url' => route('form-group-report',['id_grup' => $data->id_grup]),
                    'icon' => 'glyphicon glyphicon-list-alt',
                    'button_class' => 'btnReport',
                    'button_type' => '',
                    'on_click' => 'ajaxEdit',
                    'title' => trans('button.global.report')
                );
                $bufferbutton= array();
                array_push($bufferbutton,$editbutton,$bufferButton1,$bufferButton2,$bufferButton3,$deletebutton);
                $bt = ConsystHelper::generateActionButtonExAction($bufferbutton);
                return $bt;
            })
            ->editColumn('nama_grup',function ($data){
                $edit = route('group-man', ['act' => 2, 'id_grup' => $data->id_grup]);
                $act  = array(
                    'id' => $data->id_grup,
                    'id_prefix' => 'ru',
                    'url' => $edit,
                    'icon' => 'glyphicon glyphicon-edit',
                    'title' => $data->nama_grup
                );
                return ConsystHelper::generateUrlAction($act);
            })
            ->make(true);
    }
    public function formGroup($act, $id)
    {

        if (isset($act))
        {
            if ($act == 1)
            {
                $pages = (object)array(
                    'title'         => trans('view.group.title'),
                    'breadcrumb'    => \Breadcrumbs::render('new_group'),
                    'action'        => trans('view.group.add')
                );
                $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'],
                    array('pages' => $pages))->render();
                return \Response::json(['html' => $html]);
            }
            else {

                if ( isset($id) )  {
                    $pages = (object)array(
                        'title'         => trans('view.group.title'),
                        'breadcrumb'    => \Breadcrumbs::render('edit_group'),
                        'action'        => trans('view.group.edit')
                    );
                    $data = $this->repository->find($id);
                    $var = array(
                        'data' => $data,
                        'action' => 2
                    );
                    $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'],
                        array('pages' => $pages),$var)->render();
                    return \Response::json(['html' => $html]);
                }
            }
        }
    }
    public function postGroup()
    {
        if($this->request->ajax())
        {
            if ($this->request->action != 3) {
                $validator = $this->repository->validate($this->request);
                if ($validator->fails()) {
                    $html = \view(\Config::get('consyst.view_parials') . 'error-box', array('errors' => $validator->errors()->toArray()))->render();
                    return \response(['status'=>201,'msg' => $html], 201);
                }
            }

            if (!empty($this->request->action)) {
                $this->data = array(
                    "nama_grup"         => $this->request->nama_grup,
                    "keterangan"        => $this->request->keterangan,
                    "status"            => $this->request->status,
                );

                if ($this->request->action == 1) {
                    try {
                        if ($this->repository->create($this->data)) {
                            $rtn = ConsystHelper::generateJsonAction(trans('message.save_success'), 99);
                            return \response($rtn);
                        } else {
                            $rtn = ConsystHelper::generateJsonAction(trans('message.save_failed'), 0);
                            return \response($rtn);
                        }
                    } catch (PDOException $e) {
                        $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                        return \response($rtn);
                    }
                } else
                    if ($this->request->action == 3) {

                        try{

                            if ($this->repository->delete($this->request->id_grup)) {
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

                    } else {
                        try {
                            if ($this->repository->update($this->data, $this->request->id)) {
                                $rtn = ConsystHelper::generateJsonAction(trans('message.update_success'), 99);
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
            return \Response::json('error', 403);
        }

    }
    public function changeStatus($id)
    {
//        if (!Gate::allows('grup-post-edit')) {
//
//            return \Response::json(trans('message.unauthorize'), 403);
//        }
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
    public function formGroupAkses($id)
    {
        $perm = $this->repository->getPerm();
        $data = $this->repository->getPermById($id);
        $sel = $this->repository->find($id);
        $pages = (object)array(
            'title' => trans('view.group.akses.title'),
            'breadcrumb' => \Breadcrumbs::render('akses_group'),
        );

        $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_group_akses'], array('pages' => $pages, 'akses' => $perm, 'data' => $data, 'grup' => $sel))->render();
        return \Response::json(['html' => $html]);
    }
    public function formGroupMenu($id)
    {
        $buffer = $this->repository->getMenu();
        $data = $this->repository->getMenuById($id);
        $sel = $this->repository->find($id);
        $pages = (object)array(
            'title' => trans('view.group.menu.title'),
            'breadcrumb' => \Breadcrumbs::render('menu_group'),
        );

        $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_group_menu'], array('pages' => $pages, 'menu' => $buffer, 'data' => $data, 'grup' => $sel))->render();
        return \Response::json(['html' => $html]);

    }
    public function formGroupReport($id)
    {
        $buffer = $this->repository->getReport();

        $data = $this->repository->getReportById($id);
        $sel = $this->repository->find($id);
        $pages = (object)array(
            'title' => trans('view.group.report'),
            'breadcrumb' => \Breadcrumbs::render('menu_group'),
        );

        $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_group_report'], array('pages' => $pages, 'report' => $buffer, 'data' => $data, 'grup' => $sel))->render();
        return \Response::json(['html' => $html]);

    }
    public function groupAksesPost()
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
    public function groupMenuPost()
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
    public function groupReportPost()
    {
        if ($this->request->ajax()) {
            if (!empty($this->request->action)) {
                try {
                    //if ($this->repository->create($this->data)) {
                    if ($this->repository->storeReports($this->request->id, $this->request->report)) {
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
}