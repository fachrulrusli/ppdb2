<?php namespace App\Consyst\Repository\Master;
use Illuminate\Support\Facades\Config;
use App\Consyst\Contracts\ICoaPenggajianRepository as cInterface;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Models\MasterData\CoaPenggajian;
Use Carbon\Carbon;
use DB;
use App\Consyst\Misc\ConsystHelper;
/**
 * JamKerja repository
 * @author Hardiyansyah
 * @package Consyst\Repository
 */
class CoaPenggajianRepository extends BaseInterface implements cInterface
{
    protected $vname;

    public function __construct()
    {
        parent::__construct(new CoaPenggajian());
        $this->tbName = Config::get("consyst.kodetransaksi.table");
    }


    public function showData() {
        return $this->model->select('*')->get();
    }
   

}
