<?php namespace App\Consyst\Models;

/**
 *
 * Preference model
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package kspsb\consyst\Models
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class Preference
 *
 * @author Hardiyansyah
 * @package App\Models
 */
class Reference extends Model
{

    //protected $appends = array('child');

    protected $table;
    protected $primaryKey = "id_ref";
    protected $fillable = ['kode_ref', 'nama', 'jenis', 'keterangan', 'status', 'created_by'];
    public $nicename    = array(
        'kode_ref'   => 'Kode Reference',
        'nama'       => 'Nama',
        'jenis'      => 'Jenis',
        'Keterangan' => 'keterangan',
        'status'     => 'Status',
    );
    public $rules = array();
    public $timestamps=false;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get("consyst.reference.table");
        $this->rules = array(
            'kode_ref'   => 'required|max:7',
            'nama'       => 'required|max:50',
            'jenis'      => 'max:2',
            'keterangan' => 'max:50',
            'status'     => 'required|numeric');
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['kode_ref'] . ' - ' . $this->attributes['nama'];
    }

    public function parent()
    {
        return $this->belongsTo(Config::get("consyst.model_namespace") . '\Reference',Config::get("consyst.reference.parent"));
    }
   
}
