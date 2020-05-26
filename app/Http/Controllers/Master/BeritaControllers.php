<?php
namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Contracts\IBeritaRepository as currentRepo;
use App\Consyst\Misc\ConsystHelper;
class BeritaControllers extends MainControllers
{
    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);
        $this->param = array(
            'view'     =>"master.berita.view",
        );
    }

    public function view()
    {
        if ($this->request->ajax()) {
            $pages = (object) array(
                'title'      => 'Berita',
                'breadcrumb' => 'Berita'
            );

            $html = \view(\Config::get('consyst.view_moduls') . $this->param['view'], array('pages' => $pages))->render();
            return \Response::json(['html' => $html]);
        } else {
            return \Response::view('errors.401');
        }
    }

    public function data()
    {
        if ($this->request->ajax()) {
            $buffer = $this->repository->showData();
        return $buffer;
        }
        else {
            return \Response::view('errors.401');
        }
    }

    public function insert()
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

    public function edit($id)
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

    public function delete($id)
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
