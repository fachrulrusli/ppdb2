<?php namespace App\Consyst\Repository\Master;
use Illuminate\Support\Facades\Config;
use App\Consyst\Contracts\IBeritaRepository as cInterface;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Models\MasterData\Berita;
Use Carbon\Carbon;
use DB;
use App\Consyst\Misc\ConsystHelper;
/**
 * JamKerja repository
 * @author Hardiyansyah
 * @package Consyst\Repository
 */
class BeritaRepository extends BaseInterface implements cInterface
{
    protected $vname;

    public function __construct()
    {
        parent::__construct(new Berita());
        $this->tbName = Config::get("consyst.berita.table");
    }


    public function showData() {
        return $this->model->select('*')->get();
    }
   

}
