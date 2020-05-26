<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Contracts\IReferenceRepository as currentRepo;
use App\Consyst\Misc\ConsystHelper;
use Yajra\Datatables\Facades\Datatables;

class ReferenceControllers extends MainControllers
{
    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);
        $this->param = array(
            'view_data' =>"master.reference.view",
            'view_man'  =>"master.reference.man"
        );
    }

    public function viewReference()
    {
        if ($this->request->ajax()) {
            $toolbar = ConsystHelper::generateToolbarButton(true);
            $pages = (object) array(
                'title'      => trans('view.ref.title'),
                'breadcrumb' => \Breadcrumbs::render('ref'),
                'box_title'  => trans('view.ref.box_title'),
                'content'    => '',
                'toolbar'    => $toolbar ,
                'subtitle'   => '',
            );
            $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_data'], array('pages' => $pages))->render();
            return \Response::json(['html' => $html]);
        } else {
            return \Response::view('errors.401');
        }
    }

    public function formReference($act, $id)
    {
        if (isset($act))
        {
             $ref = $this->repository->getReference('nama', 'id');
            if ($act == 1)  {
                $pages = (object)array(
                    'title'         => trans('view.ref.add'),
                    'breadcrumb'    => \Breadcrumbs::render('ref_add'),
                    'box_title'     => "",
                    'subtitle'      => "",
                );
                $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'],
                    array('pages' => $pages, 'ref'=> $ref ))->render();
                return \Response::json(['html' => $html]);
            }
            else {
                if (isset($id)) {
                    $pages = (object)array(
                        'title'         => trans('view.ref.edit'),
                        'breadcrumb'    => \Breadcrumbs::render('ref_edit'),
                        'box_title'     => "",
                        'subtitle'      => "",
                    );
                    $data = $this->repository->find($id);
                    $var = array(
                        'data'      => $data,
                        'action'    => 2
                    );
                    $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'],
                        array('pages' => $pages, 'ref'=> $ref ), $var)->render();
                    return \Response::json(['html' => $html]);
                }
            }
        }
    }


    // public function dataReference()
    //   {
    //     if ($this->request->ajax()) {
    //       $buffer = $this->repository->showData();
    //       return $buffer;
    //             }
    //             else {
    //                 return \Response::view('errors.401');
    //             }
    //         }

    //function lama
    public function dataReference()
    {
        $buffer = $this->repository->showData();
        return Datatables::of($buffer)
            ->addColumn('action', function ($data) {
                $edit = route('form-reference', ['act' => 2, 'id_ref' => $data->id_ref]);
                $editbutton= array(
                    'id' => $data->id_ref,
                    'id_prefix' => 're',
                    'url' => $edit,
                    'icon' => 'glyphicon glyphicon-edit',
                    'button_class' => 'btnPerm',
                    'button_type' => 'btn-primary',
                    'on_click' => 'editRef',
                    'title' => trans('button.global.edit')
                );

                $deletebutton= array(
                    'id' => $data->id_ref,
                    'id_prefix' => 're',
                    'url' => $edit,
                    'icon' => 'glyphicon glyphicon-remove',
                    'button_class' => 'btnPerm',
                    'button_type' => 'btn-primary',
                    'on_click' => 'rmvRef',
                    'title' => trans('button.global.delete')
                );
                $bufferbutton= array();
                array_push($bufferbutton,$editbutton,$deletebutton);
                $bt = ConsystHelper::generateActionButtonExAction($bufferbutton);
                return $bt;
            })
            ->editColumn('nama',function ($data){
                $edit = route('form-reference', ['act' => 2, 'id_ref' => $data->id_ref]);
                $act  = array(
                    'id' => $data->id_ref,
                    'id_prefix' => 'ru',
                    'url' => $edit,
                    'icon' => 'glyphicon glyphicon-edit',
                    'title' => $data->nama
                );
                return ConsystHelper::generateUrlAction($act);
            })
            ->make(true);
    }

    public function postReference()
    {
         if($this->request->ajax())
        {
            if ($this->request->action == 1 && $this->request->action == 2) {
                $validator = $this->repository->validate($this->request);
                if ($validator->fails()) {
                    $html = \view(\Config::get('consyst.view_parials') . 'error-box', array('errors' => $validator->errors()->toArray()))->render();
                    return \response(['status'=>201,'msg' => $html], 201);
                }
            }


            if (!empty($this->request->action)) {
                $this->data = array(
                    "kode_ref"      => $this->request->kode_ref,
                    "nama"          => $this->request->nama,
                    "jenis"         => $this->request->jenis,
                    "keterangan"    => $this->request->keterangan,
                    "status"        => $this->request->status
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
                    if ($this->request->action == 4) {
                        if ($this->request->status == 0) $status = 1; else $status = 0;
                        $this->data_update['status'] = $status;
                        try{

                            if ($this->repository->update($this->data_update, $this->request->id_ref)) {
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
                } else
                    if ($this->request->action == 3) {

                        try{

                            if ($this->repository->delete($this->request->id_ref)) {
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


                } else  {

                    try {
                        if ($this->repository->update($this->data, $this->request->id_ref)) {
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
}
