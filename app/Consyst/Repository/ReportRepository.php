<?php namespace App\Consyst\Repository;

use App\Consyst\Models\Grup;
use App\Consyst\Models\Report;
use Illuminate\Support\Facades\Config;
use App\Consyst\Contracts\IReportRepository as cInterface;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Models\Cabang;

/**
 * Report repository
 * @author Hardiyansyah
 * @package Consyst\Repository
 */
class ReportRepository extends BaseInterface implements cInterface
{
    protected $parent;
    public function __construct()
    {
        parent::__construct(new Report());
        $this->parent = Config::get("consyst.report.parent");
        $this->tbName = Config::get("consyst.report.table");
    }
    public function showData()
    {
        return $this->model->select(['id','nama','url','jenis','status','keterangan'])->orderBy('nama','ASC');
    }
    public function showDataAdminHrd()
    {
        return $this->model->select(['id','nama','url','parameter','keterangan'])->where('jenis',1)->where('status',1)->orderBy('nama','ASC')->get();
    }
     public function showDataPsdm()
    {
        return $this->model->select(['id','nama','url','parameter','keterangan'])->where('jenis',2)->where('status',1)->orderBy('nama','ASC')->get();
    }
    public function showDataPersonalia()
    {
        return $this->model->select(['id','nama','url','parameter','keterangan'])->where('jenis',3)->where('status',1)->orderBy('nama','ASC')->get();
    }
    public function showDataKaryawan()
    {
        return $this->model->select(['id','nama','url','parameter','keterangan'])->where('jenis',4)->where('status',1)->orderBy('nama','ASC')->get();
    }

    public function showDataUmum()
    {
        return $this->model->select(['id','nama','url','parameter','keterangan'])->where('jenis',0)->where('status',1)->orderBy('nama','ASC')->get();
    }
    public function getCabang()
    {
        return Cabang::select('id_cabang','nama_cabang')->whereNotIn('id_cabang',['000','999'])->orderBy('id_cabang', 'asc')->get();
    }
    public function getCabangByKode($kode)
    {
        return Cabang::select('id_cabang','nama_cabang')->where('id_cabang',$kode)->first();

    }
    public function showGroupReport()
    {
        $data=Grup::with('reports')->whereIn('id_grup',\Auth::user()->grups()->get()->pluck('id_grup')->all())->get()->toArray();
        $finalreports = collect([]);

        foreach ($data as $rpt) {


            if($rpt['reports'] )
            {
                foreach ($rpt['reports'] as $itm) {


                    if($itm['id'] )
                    {
                        $finalreports->push($itm['id']);
                    }

                }

            }
        }

        return $this->model->select(['id','nama','url','parameter','keterangan'])->whereIn('id',$finalreports)->where('status',1)->orderBy('nama','ASC')->get();
    }
    public function loadReportMultiGroup($uid, $grpid)
    {

    }

    public function changeStatus($id, $value) {
        return \DB::table($this->tbName)
            ->where('id', $id)
            ->update(['status' => $value]);
    }
}
