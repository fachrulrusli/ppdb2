<?php namespace App\Consyst\Models;

/**
 *
 * Grup Model
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package Consyst\Models
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class Group
 *
 * @author Hardiyansyah
 * @package Consyst\Models
 */
class Grup extends Model
{

    //protected $appends = array('child');

    public $timestamps = false;
    protected $primaryKey = "";
    protected $table;
    protected $fillable = ['nama_grup', 'status', 'keterangan'];
    public $nicename    = array(
        'nama_grup' => 'Nama grup',
        'status'     => 'Status',
        'keterangan' => 'Keterangan',
    );
    public $rules = array();
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config("consyst.grup.table");
        $this->primaryKey=config('consyst.grup.primary_key');
        $this->rules = array(
            'nama_grup' => 'required|max:50|unique:' . $this->table,
            'status'     => 'required|integer|between:0,1',
            'keterangan' => 'max:100',
        );
    }
    /**
     * Define Many to many relation to table user
     *
     * @author Hardiyansyah
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get("consyst.model_namespace") . '\User', Config::get("consyst.user_group.table"), Config::get("consyst.user.primary_key"), Config::get("consyst.grup.primary_key"));
    }

    /**
     * Define Many to many relation to table Menu
     *
     * @author Hardiyansyah
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Config::get('consyst.model_namespace') . '\Menu', Config::get('consyst.group_menu.table'), Config::get('consyst.group_menu.primary_key'), Config::get('consyst.group_menu.foreign_key'));
    }

    /**
     * Define Many to many relation to table permission
     *
     * @author Hardiyansyah
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function akses() {
        return $this->belongsToMany(Config::get('consyst.model_namespace') . '\Akses', Config::get('consyst.group_akses.table'), Config::get('consyst.group_akses.primary_key'), Config::get('consyst.group_akses.foreign_key'));
    }


    public function getFullNameAttribute()
    {
        return $this->attributes['id_grup'] . ' - ' . $this->attributes['nama_grup'];
    }

    public function hasAkses($slug) {
  		//dd($this->permission->contains('slug', $slug));
  		return $this->akses->contains('slug', $slug);
    }
    /**
     * Define Many to many relation to table Report
     *
     * @author Hardiyansyah
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reports()
    {
        return $this->belongsToMany(Config::get('consyst.model_namespace') . '\Report', Config::get('consyst.group_report.table'), Config::get('consyst.group_report.primary_key'), Config::get('consyst.group_report.foreign_key'));
    }
}
