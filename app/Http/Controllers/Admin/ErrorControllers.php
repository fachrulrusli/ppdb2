<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Auth\Contracts\IGrupRepository as currentRepo; //dummy



class ErrorControllers extends MainControllers
{
    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);

    }

    public function view404()
    {

        $html = \view('errors.404')->render();
        return \Response::json(['html' => $html]);


    }

    public function viewUnAuthorize()
    {

        $html = \view('errors.401')->render();
        return \Response::json(['html' => $html]);


    }




}