<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Auth\Contracts\IAksesRepository as currentRepo;
use App\Consyst\Misc\ConsystHelper;

class AksesControllers extends MainControllers
{
    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);
        $this->param = array(
            'view_menu'=>"master.access.view"
        );
    }

    public function viewAkses()
    {
        if ($this->request->ajax()) {
            $toolbar = ConsystHelper::generateToolbarButton(true);
            $pages = (object) array(
                'title'      => trans('view.akses.title'),
                'breadcrumb' => \Breadcrumbs::render('akses'),
                'box_title'  => trans('view.akses.box_title'),
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
    public function dataAkses()
    {
        if ($this->request->ajax()) {
            $buffer = $this->repository->showData();
        return $buffer;
        }
        else {
            return \Response::view('errors.401');
        }
    }
    public function AksesInsert()
    {
        if ($this->request->ajax()) {
            try {
                if ($this->repository->create($this->request->json()->all())) {
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
        } else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }
    public function AksesEdit($id)
    {
        if ($this->request->ajax()) {
            try {
                if ($this->repository->update($this->request->json()->all(),$id)) {
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
        } else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }
    public function AksesDelete($id)
    {
        if ($this->request->ajax()) {
            try {
                if ($this->repository->delete($id)) {
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
        } else {
            return \Response::json(trans('message.direct_access_notice'), 403);
        }
    }
}
