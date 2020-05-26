<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as httpRequest;
use Auth; // to test auth system
use Request;
use PDOException;
use Validator;
use Gate;
use App\Consyst\Misc\ConsystHelper;
use App\Consyst\EloquentRepository as BaseRepository;
use Yajra\Datatables\Facades\Datatables;
/**
 * Class MainControllers
 * Main Controller of system, in here all logic route will be processed.
 */

class MainControllers extends ConsystControllers
{

    protected $request;
    protected $repository;
    protected $data=[];
    protected $param=[];
    protected $key;


    /**
     * MainControllers constructor.
     */
    public function __construct(httpRequest $request, BaseRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * view data handling for permission ( ajax )
     *
     * @author Hardiyansyah
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function viewData()
    {

        if ($this->request->ajax()) {
            $toolbar = ConsystHelper::generateToolbarButton(Gate::allows($this->param['gate_add']));
            $pages = (object)array(
                'title' => $this->param['view_title'],
                'breadcrumb' => \Breadcrumbs::render($this->param['breadcrumbs']),
                'box_title' => $this->param['view_box_title'],
                'content' => '',
                'toolbar' => $toolbar,
                'subtitle' => 'Data'
            );
            $html = \view(\Config::get('consyst.view_moduls') . $this->param['view_base'], array('pages' => $pages))->render();
            return \Response::json(['html' => $html]);
        } else {
            return \Response::view('errors.401');
        }

    }
    /**
     * Handling modal manipulation
     * @param integer $act action beetween 1 for new record and 2 fro edit
     * @param integer $id record id
     * @return mixed
     */
    public function ajaxModal($act, $id)
    {

        if (isset($act)) {
            if ($act == 1) // new
            {

                return \Response::view(\Config::get('consyst.view_moduls') . $this->param['view_man']);
            } else { //edit
                if (isset($id)) {
                    $data = $this->repository->find($id);

                    $var = array(
                        'data' => $data,
                        'action' => 2
                    );
                    return \Response::view(\Config::get('consyst.view_moduls') . $this->param['view_man'], $var);
                }
            }
        }
    }

    /**
     * handling tabledata data supply ( ajax )
     *
     * @author Hardiyansyah
     * @return mixed
     */
    public function ajaxData()
    {

        $buffer = $this->repository->all();
        return Datatables::of($buffer)
            ->addColumn('action', function ($data) {
                $edit = "";
                $delete = "";
                if (Gate::allows($this->param['gate_edit'])) {
                    $edit = route($this->param['gate_modal'], ['act' => 2, 'id' => $data->id]);
                }
                if (Gate::allows($this->param['gate_delete'])) {
                    $delete = route($this->param['gate_delete'], ['id' => $data->id]);
                }
                return ConsystHelper::generateActionButton($data->id, $edit, $delete);
            })
            ->make(true);

        //return Datatables::collection(Menu::all())->make(true);
    }

    /**
     * Handling delete operation via ajax
     *
     * @author Hardiyansyah
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function ajaxDel( $id)
    {
        // check if request is ajax
        if ($this->request->ajax()) {
            if (!empty ($id)) {
                try {
                    //check existing permission
                    $data = $this->repository->find($this->request->id);
                    if ($data->count() > 0) {

                        if ($this->repository->delete($this->request->id)) {
                            //return success response
                            $rtn = ConsystHelper::generateJsonAction(trans('message.delete_success'), 1);
                            return \response($rtn);
                        } else {
                            // error during saving record
                            $rtn = ConsystHelper::generateJsonAction(trans('message.delete_failed'), 0);
                            return \response($rtn);
                        }
                    } else {
                        $rtn = ConsystHelper::generateJsonAction(trans('message.record_not_found'), 2);
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
