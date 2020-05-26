<?php namespace App\Consyst\Auth;

use App\Consyst\Models\Akses;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Auth\Contracts\IAksesRepository as cInterface;
use Illuminate\Support\Facades\Config;

/**
 * PermissionRepository
 * @author Hardiyansyah
 * @package Consyst\Auth
 */
class AksesRepository extends BaseInterface implements cInterface
{

    public function __construct()
    {
        parent::__construct(new Akses());
        $this->tbName = Config::get("consyst.akses.table");
    }

    public function showData() {
    return $this->model->select('id_akses', 'nama','slug','keterangan')->get();

  }

}
