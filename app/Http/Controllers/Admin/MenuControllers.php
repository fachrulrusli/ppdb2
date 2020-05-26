<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Auth\Contracts\IMenuRepository as currentRepo;
use App\Consyst\Misc\ConsystHelper;

class MenuControllers extends MainControllers
{
    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);
        $this->param = array(
            'view_menu' =>"master.menu.view",
        );
    }
    public function viewMenu()
    {
        if ($this->request->ajax()) {
            $pages = (object) array(
                'title'      => trans('view.menu.title'),
                'breadcrumb' => \Breadcrumbs::render('menu'),
                'box_title'  => trans('view.menu.box_title'),
                'content'    => '',
                'subtitle'   => '',
            );

            $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_menu'], array('pages' => $pages))->render();
            return \Response::json(['html' => $html]);
        } else {
            return \Response::view('errors.401');
        }
    }


    public function dataMenu()
    {
        if ($this->request->ajax()) {
            $buffer = $this->repository->showData();
        return $buffer;

        }
        else {
            return \Response::view('errors.401');
        }

    }
    public function getMenu()
    {
        if ($this->request->ajax()) {
            $buffer = $this->repository->getData();
            return \Response::json($buffer);

        }
        else {
            return \Response::view('errors.401');
        }

    }
    public function MenuUtama($id)
    {
        if ($this->request->ajax()) {
            $this->data = array(
                "menu_grup"  => 0
            );
            try {
                if ($this->repository->update($this->data,$id)) {
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
    public function MenuInsert()
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
    public function MenuEdit($id)
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
    public function MenuDelete($id)
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
