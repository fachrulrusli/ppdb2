<?php namespace App\Consyst\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class Cabang
 *
 * @author Hardiyansyah
 * @package Consyst\Models
 */
class Cabang extends Model
{
	public $timestamps = false;
    protected $table;
    protected $primaryKey = "";
    protected $fillable = ['id_cabang',
            'nama_cabang',
            'regional',
            'id_kota',
            'jenis',
            'urutan',
            'bm',
            'rm',
            'tgl_berdiri',
            'alamat',
            'id_bank',
            'atas_nama_rekening',
            'no_rekening',
            'taget_pj',
            'taget_sp',
            'fl_jasa_baru',
            'status',
            'penampungan_da',
            'kode_vendor',
            'penampungan_titipan_mps', 
            'penampungan_titipan_mpp',
            'penampungan_titipan_bpa',
            'penampungan_titipan_bkt',
            'penampungan_titipan_bpp',
            'penampungan_titipan_bkpt',
            'penampungan_titipan_bkpa',
            'penampungan_titipan_mpp_ip',
            'penampungan_titipan_mpp_pp',
            'penampungan_titipan_mpp_kt',
            'penampungan_tfp_spsw',
            'norek_konfiden'
        ];

    public $nicename = array(
            'nama_cabang' => 'Nama Cabang',
            'regional' => 'Regional',
            'id_kota' => 'Kota',
            'jenis' => 'Jenis',
            'urutan' => 'Urutan',
            'bm' => 'BM',
            'rm' => 'RM',
            'tgl_berdiri' => 'Tanggal Beridiri',
            'alamat' => 'Alamat',
            'id_bank' => 'Bank',
            'atas_nama_rekening' => 'Atas Nama Rekening',
            'no_rekening' => 'No Rekening',
            'taget_pj' => 'Target PJ',
            'taget_sp' => 'Target SP',
            'fl_jasa_baru' => 'FL Jasa Baru',
            'status' => 'Status',
            'kode_vendor' => 'Kode Lama',
            'penampungan_da'      => 'Penampung DA',
            'penampungan_titipan_mps' => 'Penampungan Titipan MPS',
            'penampungan_titipan_mpp' => 'Penampungan Titipan MPP',
            'penampungan_titipan_bpa' => 'Penampungan Titipan BPA',
            'penampungan_titipan_bkt' => 'Penampungan Titipan BKT',
            'penampungan_titipan_bpp' => 'Penampungan Titipan BPP',
            'penampungan_titipan_bkpt' => 'Penampungan Titipan BKPT',
            'penampungan_titipan_bkpa' => 'Penampungan Titipan BKPA',
            'penampungan_titipan_mpp_ip' => 'Penampungan Titipan MPP IP',
            'penampungan_titipan_mpp_pp' => 'Penampungan Titipan MPP PP',
            'penampungan_titipan_mpp_kt' => 'Penampungan Titipan MPP KT',
            'penampungan_tfp_spsw'     => 'Penampungan TFP SPSW',
            'norek_konfiden'           => 'Norek Konfiden' 
        );
    public $rules = array();
    protected $casts = [
        'id_cabang' => 'string'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config("consyst.cabang.table");
        $this->primaryKey=config('consyst.cabang.primary_key');
        $this->rules = array(
            'nama_cabang' => 'required|max:50',
            'regional' => 'required|max:4',
            'id_kota' => 'required',
            'jenis' => '',
            'urutan' => '',
            'bm' => 'required|max:8',
            'rm' => 'required|max:8',
            'tgl_berdiri' => 'required',
            'alamat' => 'required|max:500',
            'id_bank' => 'required',
            'atas_nama_rekening' => 'required|max:50',
            'no_rekening' => 'required|max:50',
            'taget_pj' => 'max:20',
            'taget_sp' => 'max:20',
            'fl_jasa_baru' => '',
            'status' => '',
            'kode_vendor' => '',
            'penampungan_da'      => '',
            'penampungan_titipan_mps' => '',
            'penampungan_titipan_mpp' => '',
            'penampungan_titipan_bpa' => '',
            'penampungan_titipan_bkt' => '',
            'penampungan_titipan_bpp' => '',
            'penampungan_titipan_bkpt' => '',
            'penampungan_titipan_bkpa' => '',
            'penampungan_titipan_mpp_ip' => '',
            'penampungan_titipan_mpp_pp' => '',
            'penampungan_titipan_mpp_kt' => '',
            'penampungan_tfp_spsw'     => '',
            'norek_konfiden'           => '' 
        );
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['id_cabang'] . ' - ' . $this->attributes['nama_cabang'];
    }
    public function getFullName2Attribute()
    {
        return $this->attributes['kode_vendor'] . ' - ' . $this->attributes['nama_cabang'];
    }
    public function kota()
    {
        return $this->hasMany(Config::get("consyst.model_namespace") . "\Kota","id","id_kota");

    }

    public function bank()
    {
        return $this->hasMany(Config::get("consyst.model_namespace") . "\Bank","id_bank","id_bank");

    }

}
