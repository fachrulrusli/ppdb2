<?php

namespace App\Consyst\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Config;


/**
 * Class User
 * Model for master user.
 *
 * @author Hardiyansyah
 */
class User extends Model implements AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;
    public $timestamps = false;

    protected $table;
    protected $primaryKey = "";
    protected $fillable = ['username', 'password', 'password_otorisasi', 'nama_user', 'status', 'kode_cabang', 'created_by','kode_vendor','nik','hp','email','lat','lon'];
    protected $hidden = [
        'password', 'remember_token', 'password_otorisasi',
    ];
    public $nicename = array(

    );
    public $rules = array();
    public $guarded = ['password', 'password_otorisasi'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('consyst.user.table');
        $this->primaryKey=config('consyst.user.primary_key');
        $this->rules = array(
            'username' => 'required|max:20|unique:' . $this->table,
            'password' => 'max:12',
            'password_otorisasi' => 'max:12',
            'nama_user' => 'required|max:100'
        );
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();

        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

    /**
     * Define Many to many relation to table akses.
     *
     * @author Hardiyansyah
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function akses()
    {
        return $this->belongsToMany(Config::get('consyst.model_namespace') . '\Akses', Config::get('consyst.user_akses.table'), Config::get('consyst.user_akses.primary_key'), Config::get('consyst.user_akses.foreign_key'));
    }

    /**
     * Define Many to many relation to table Menu.
     *
     * @author Hardiyansyah
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Config::get('consyst.model_namespace') . '\Menu', Config::get('consyst.user_menu.table'), Config::get('consyst.user_menu.primary_key'), Config::get('consyst.user_menu.foreign_key'));
    }

    /**
     * Define Many to many relation to table grup.
     *
     * @author Hardiyansyah
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grups()
    {
        return $this->belongsToMany(Config::get('consyst.model_namespace') . '\Grup', Config::get('consyst.user_grup.table'), Config::get('consyst.user_grup.primary_key'), Config::get('consyst.user_grup.foreign_key'));
    }

    public function hasPermission($slug)
    {

        return $this->akses->contains('slug', $slug);

    }
    public function cabang()
    {
        return $this->belongsTo(Config::get('consyst.model_namespace') . '\Cabang', 'kode_cabang' ,Config::get('consyst.cabang.primary_key'));
    }

}
