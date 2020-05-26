<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\MainControllers;
use Illuminate\Http\Request as httpRequest;
use App\Consyst\Auth\Contracts\IAksesRepository as currentRepo;


/**
 * Class TestControllers
 * Controller for testing only
 *
 * @package App\Http\Controllers\Admin
 */
class TestControllers extends MainControllers
{
    /**
     * constructor. do testing on this contructor
     */

    public function __construct(httpRequest $request, currentRepo $repository)
    {
        parent::__construct($request, $repository);


    }
    public static function test()
    {

    }
    public function gettest()
    {

    }


}
