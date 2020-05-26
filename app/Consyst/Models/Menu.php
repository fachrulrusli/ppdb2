<?php namespace App\Consyst\Models;

/**
 * Menu Model
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package kspsb\consyst\Models
 */

use App\Consyst\Misc\ConsystHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class Menu
 *
 * @author Hardiyansyah
 * @package Consyst\Models
 */
class Menu extends Model
{
    public $timestamps = false;
    protected $primaryKey = "";
    protected $table;
    protected $fillable = ['id', 'nama_menu', 'url', 'menu_grup', 'attribut', 'deskripsi', 'menu_utama', 'status', 'urutan', 'icon'];
    public $nicename = array(
        'nama_menu' => 'Nama Menu',
        'url' => 'Url',
        'menu_grup' => 'Menu Group',
        'attribut' => 'Attribut',
        'deskripsi' => 'Deskripsi',
        'menu_utama' => 'Menu Utama',
        'status' => 'Status',
        'urutan' => 'Urutan',
    );
    public $rules = array();

    public $buffmenu = array();

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config("consyst.menu.table");
        $this->primaryKey=config('consyst.menu.primary_key');
        $this->rules = array(
            
            'url' => 'required',
            'menu_grup' => 'integer',
            'attribut' => 'max:50',
            'deskripsi' => 'max:50',
            'menu_utama' => 'required|integer|between:0,1',
            'status' => 'required|integer|between:0,1',
            'urutan' => 'integer',
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
        return $this->belongsToMany(Config::get("consyst.model_namespace") . "\User", Config::get("consyst.user_menu.table"), Config::get("consyst.user.primary_key"), Config::get("consyst.menu.primary_key"));
    }

    /**
     * Define Many to many relation to table grup
     *
     * @author Hardiyansyah
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grups()
    {
        return $this->belongsToMany(Config::get("consyst.model_namespace") . "\Grup", Config::get("consyst.grup_menu.table"), Config::get("consyst.menu.primary_key"), Config::get("consyst.grup.primary_key"));
    }

    /**
     * Menu self relation with menu_grup field
     *
     * @author Hardiyansyah
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function child()
    {

        $filter = array();
        $filter = session()->get('secret.menus');
        if ($filter) {
            return $this->hasMany(Config::get("consyst.model_namespace") . "\Menu", Config::get("consyst.menu.parent"))
                ->orderBy('urutan')
                ->whereIn('id_menu', $filter)
                ->where('status', '1');
        } else {
            return $this->hasMany(Config::get("consyst.model_namespace") . "\Menu", Config::get("consyst.menu.parent"))
                ->orderBy('urutan')
                ->where('status', '1');
        }

    }

    /**
     * Gel child Recursively
     * @return mixed
     */
    public function childs()
    {

        return $this->child()->with('childs');
    }

    public function scopeFiltered($query)
    {

        return $query->wherein('id_menu', $this->buffMenu)->orderBy('urutan');

    }
    public function parent()
    {
        return $this->belongsTo(Config::get("consyst.model_namespace") . "\Menu",Config::get("consyst.menu.parent"));
    }

    public function getNameForUserAttribute($value)
    {
        if(ConsystHelper::IsNothing($this->attributes['deskripsi']))
        {
            return $this->attributes['nama_menu'];
        }else{

            return $this->attributes['nama_menu'].' -- '.$this->attributes['deskripsi'];
        }

    }


}
