<?php namespace App\Consyst\Repository;
use Illuminate\Support\Facades\Config;
use App\Consyst\Contracts\IReferenceRepository as cInterface;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Models\Reference;
/**
 * Bank repository
 * @author Hardiyansyah
 * @package Consyst\Repository
 */
class ReferenceRepository extends BaseInterface implements cInterface
{
    protected $vname;

    public function __construct()
    {
        parent::__construct(new Reference());
        $this->tbName = Config::get("consyst.reference.table");
        $this->vname = "v_ms_ref";
    }

    /**
     * Change status
     * @param  integer $id    preference id
     * @param  integer $value beetween 0 to 1, 1 for aktive and 0 for non active
     * @return mixed
     */
    public function changeStatus($id, $value)
    {
        return \DB::table($this->tbName)
            ->where('id', $id)
            ->update(['status' => $value]);

    }
    /**
     * Showing data with join table
     * @return mixed
     */
    public function showData()
    {

        return $this->model->with('parent');
    }

     /**
     * Get refrence table for combobox
     * @return object array of object
     */
    public function getReference()
    {


      return  (object) array(
        'reference'=>$this->model
                    ->where("jenis",0)
                    ->orWhere("jenis",999)
                    ->orderBy("kode_ref","asc")
                    ->get()->pluck("FullName","id_ref"),

        );

    }

    /*
        * migrate function getReference from CifRepository to ReferenceRepository
     */

    public function getParameterRef($jenis)
    {
        $selectquery = \DB::raw('id_ref,kode_ref,fullname');
        $query = \DB::table($this->vname)
            ->select($selectquery)
            ->where('nama_jenis', strtoupper($jenis))
            ->orderBy('kode_ref', 'asc');
        return $query->pluck('fullname', 'kode_ref');
    }

     public function getParameterValName($jenis)
    {
        $selectquery    =   \DB::raw('id_ref,kode_ref,fullname, nama');
        $query          =   \DB::table($this->vname)
                            ->select($selectquery)
                            ->where('nama_jenis', strtoupper($jenis))
                            ->orderBy('kode_ref', 'asc');

        return $query->pluck('fullname', 'nama')->prepend("--- Pilih Jabatan ---","");
    }
}
