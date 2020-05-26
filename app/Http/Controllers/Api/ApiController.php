<?php
namespace App\Http\Controllers\Api;

use App\Http\ApiHelper;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    public function showdata()    {

        $data = 'tes api';

        if (!$data==null)
        {
            return ApiHelper::respond($data, 200);
        }else{
            return ApiHelper::respondWithError('Data Angsuran Kosong...!', 200);
        }
    }

}
