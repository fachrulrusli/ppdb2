<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Contracts\ICabangRepository as currentRepo;
use App\Consyst\Misc\ConsystHelper;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Redirect;

class CabangControllers extends MainControllers
{
    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);
        $this->param = array(
            'view_cabang'   =>"master.branch.view",
            'view_man'      =>"master.branch.man",
        );
    }

    public function viewBranch()
    {
        if ($this->request->ajax()) {
            $toolbar = ConsystHelper::generateToolbarButton(true);
            $pages = (object) array(
                'title'      => trans('view.branch.title'),
                'breadcrumb' => \Breadcrumbs::render('branch'),
                'content'    => '',
                'subtitle'   => '',
                'toolbar'    => $toolbar,
            );

            $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_cabang'], array('pages' => $pages))->render();
            return \Response::json(['html' => $html]);
        } else {
            return \Response::view('errors.401');
        }
    }

    public function dataBranch()
    {
        if ($this->request->ajax()) {
            $buffer = $this->repository->all(['id_cabang','nama_cabang','kode_vendor','bm','regional','status']);
            return $buffer;
        }
        else {
            return \Response::view('errors.401');
        }

    }


    public function formBranch($act, $id)
    {
        $ref = $this->repository->getReference();
        if (isset($act)) 
        {
            if ($act == 1)  {
                $pages = (object)array(
                    'title'         => trans('view.branch.title'),
                    'breadcrumb'    => \Breadcrumbs::render('new_branch'),
                    'box_title'     => trans('view.branch.box_title'),
                    'subtitle'      => trans('view.branch.subtitle'),
                    'action'        => trans('view.branch.add')
                );
                $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'], 
                    array('pages' => $pages, 'ref'=>$ref))->render();
                return \Response::json(['html' => $html]);
            } 
            else { 
                if (isset($id)) {
                    $pages = (object)array(
                        'title'         => trans('view.branch.title'),
                        'breadcrumb'    => \Breadcrumbs::render('edit_branch'),
                        'box_title'     => trans('view.branch.box_title'),
                        'subtitle'      => trans('view.branch.subtitle'),
                        'action'        => trans('view.branch.edit')
                    );
                    $data = $this->repository->find($id);
                    $var = array(
                        'data' => $data,
                        'action' => 2
                    );
                    $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_man'], array('pages' => $pages, 'ref'=>$ref),$var)->render();
                    return \Response::json(['html' => $html]);
                }
            }
        }
    }
    
    public function postBranch()
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
                    "nama_cabang"           => $this->request->nama_cabang,     
                    "regional"              => $this->request->regional,            
                    "id_kota"               => $this->request->id_kota,          
                    "jenis"                 => $this->request->jenis,            
                    "urutan"                => $this->request->urutan,           
                    "bm"                    => $this->request->bm,               
                    "rm"                    => $this->request->rm,               
                    "tgl_berdiri"           => $this->request->tgl_berdiri,      
                    "alamat"                => $this->request->alamat,           
                    "id_bank"               => $this->request->id_bank,          
                    "atas_nama_rekening"    => $this->request->atas_nama_rekening,
                    "no_rekening"           => $this->request->no_rekening,      
                    "taget_pj"              => $this->request->taget_pj,         
                    "taget_smp"             => $this->request->taget_smp,        
                    "fl_jasa_baru"          => $this->request->fl_jasa_baru,     
                    "status"                => $this->request->status,
                    "kode_vendor"           => $this->request->kode_vendor,
                    "penampungan_da"            => $this->request->penampungan_da,
                    "penampungan_titipan_mps"   => $this->request->penampungan_titipan_mps,
                    "penampungan_titipan_mpp"   => $this->request->penampungan_titipan_mpp,
                    "penampungan_titipan_bpa"   => $this->request->penampungan_titipan_bpa,
                    "penampungan_titipan_bkt"   => $this->request->penampungan_titipan_bkt,
                    "penampungan_titipan_bpp"   => $this->request->penampungan_titipan_bpp,
                    "penampungan_titipan_bkpt"  => $this->request->penampungan_titipan_bkpt,
                    "penampungan_titipan_bkpa"  => $this->request->penampungan_titipan_bkpa,
                    "penampungan_titipan_mpp_ip"=> $this->request->penampungan_titipan_mpp_ip,
                    "penampungan_titipan_mpp_pp"=> $this->request->penampungan_titipan_mpp_pp,
                    "penampungan_titipan_mpp_kt"=> $this->request->penampungan_titipan_mpp_kt,
                    "penampungan_tfp_spsw"      => $this->request->penampungan_tfp_spsw,
                    "norek_konfiden"            => $this->request->norek_konfiden 
                );

                $id_cabang = $this->request->id_cabang;
                $nama_cabang = $this->request->nama_cabang;
                $regional = $this->request->regional;
                $id_kota = $this->request->id_kota;
                $jenis = $this->request->jenis;
                $urutan = $this->request->urutan;
                $bm = $this->request->bm;
                $rm = $this->request->rm;
                $tgl_berdiri = date("Y-m-d", strtotime($this->request->tgl_berdiri));
                $alamat = $this->request->alamat;
                $id_bank = $this->request->id_bank;
                $anrek = $this->request->atas_nama_rekening;
                $norek = $this->request->no_rekening;
                $status = $this->request->status;
                $kode_lama = $this->request->kode_vendor;

                if ($this->request->action == 1) {
                    $this->data['id_cabang'] = $this->request->id_cabang;

                    try {
                        if ($this->repository->create($this->data)) {
                            $this->repository->SaveCabangAll($kode_lama,$id_cabang,$nama_cabang,$regional,$urutan,$bm,$rm,$tgl_berdiri,$alamat,$anrek,$norek,$jenis,$status,$id_kota,$id_bank);
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

                            if ($this->repository->delete($this->request->id_cabang)) {
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
                            $this->repository->SaveCabangAll($kode_lama,$id_cabang,$nama_cabang,$regional,$urutan,$bm,$rm,$tgl_berdiri,$alamat,$anrek,$norek,$jenis,$status,$id_kota,$id_bank);
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

    public function getBranch()
    {
        if ($this->request->ajax()) {
            return $this->repository->getData();
        } else {
            return \Response::view('errors.401');
        }

    }

    public function dataBranchNew()
    {
        if ($this->request->ajax()) {
            $buffer = $this->repository->getDatabaru();
            // var_dump($buffer);
            // die();
            return $buffer;
        }
        else {
            return \Response::view('errors.401');
        }

    }

    public function postBranchbaru(){

    
        if (!empty($this->request->id_cabang)) {
                $this->data = array(
                    "id_cabang"            => $this->request->id_cabang,     
                    "nama_cabang"          => $this->request->nama,            
                    "alamat"               => $this->request->alamat,          
                );

            try {
                if ($this->repository->create($this->data)) {
                    return redirect(route('branch2'));
                } else {
                    $rtn = ConsystHelper::generateJsonAction(trans('message.save_failed'), 0);
                    return \response($rtn);
                }
            } catch (PDOException $e) {
                $rtn = ConsystHelper::generateJsonAction($e->getMessage(), 0);
                return \response($rtn);
            }
        }else{
              return \Response::json(trans('message.direct_access_notice'), 403);
        }

    }



}