<?php namespace App\Consyst\Auth;
use App\Consyst\Models\Grup;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Auth\Contracts\IGrupRepository as cInterface;
use App\Consyst\Models\Report;
use Exception;
use Illuminate\Support\Facades\Config;
use App\Consyst\Models\Menu;
use App\Consyst\Models\Akses;
use Illuminate\Support\Facades\DB;

/**
 * GroupRepository
 * @author Hardiyansyah
 * @package Consyst\Auth
 */
class GrupRepository extends BaseInterface implements cInterface
{

    public function __construct()
    {
        parent::__construct(new Grup());
        $this->tbName = Config::get("consyst.grup.table");
    }
    public function changeStatus($id,$value)
    {
        return \DB::table($this->tbName)
            ->where('id_grup', $id)
            ->update(['status' => $value]);

    }
    public function getPermissions() {
        return $this->model->akses();
    }
    /**
     * get akses for combobox.
     *
     * @return array  all akses
     */
    public function getPerm() {
        return Akses::all()->pluck('nama', 'id_akses')->all();
    }
    /**
     * Get list akses by id user
     * @method getPermById
     * @author Hardiyansyah
     * @param  integer      $id user id
     * @return array        permission list of curent user
     */
    public function getPermById($id) {
        $model = new Grup();

        return $model->find($id)->akses()->get()->pluck('id_akses')->all();
    }
    /**
     * store akses.
     *
     * @param int   $id   user id
     * @param array $perm array of user permission
     *
     * @return int 1 if succeed and 0 for error
     */
    public function storePerm($id, $perm) {
        try {
            if (!isset($perm)) {
                $perm = array();
            }

            $model = $this->find($id);

            \DB::transaction(function () use ($model, $perm) {
                $model->akses()->sync($perm);
            });
            DB::commit();
            return 1;
        } catch (Exception $e) {

            $this->resetModel();
            DB::rollback();
            return 0;
        }
    }
    /**
     * [getMenu description]
     * @method getMenu
     * @author Hardiyansyah
     * @return array   all menu
     */
    public function getMenu() {
        return Menu::all()->pluck('name_for_user', 'id_menu')->all();
    }
    /**
     * Get list Menu by id user
     * @method getMenuById
     * @author Hardiyansyah
     * @param  integer      $id user id
     * @return array        menu list of curent user
     */
    public function getMenuById($id) {
        $model = new Grup();
        return $model->find($id)->menus()->get()->pluck('id_menu')->all();
    }


    /**
     * Store menu
     * @method storeMenus
     * @author Hardiyansyah
     * @param  integer     $id    user id
     * @param  array     $menus array list of menus
     * @return integer 1 if succeed and 0 for error
     */
    public function storeMenus($id, $menus) {
        try {
            if (!isset($menus)) {
                $menus = array();
            }

            $model = $this->find($id);

            \DB::transaction(function () use ($model, $menus) {
                $model->menus()->sync($menus);
            });
            DB::commit();
            return 1;
        } catch (Exception $e) {
            $this->resetModel();
            DB::roolback();
            return 0;
        }
    }
    /**
     * Store Reports
     * @method storeReports
     * @author Hardiyansyah
     * @param  integer     $id    user id
     * @param  array     $menus array list of menus
     * @return integer 1 if succeed and 0 for error
     */
    public function storeReports($id, $report) {
        try {
            if (!isset($report)) {
                $report = array();
            }

            $model = $this->find($id);

            \DB::transaction(function () use ($model, $report) {
                $model->reports()->sync($report);
            });
            DB::commit();
            return 1;
        } catch (Exception $e) {
            $this->resetModel();
            DB::roolback();
            return 0;
        }
    }

    /**
     * [getReport description]
     * @method getReport
     * @author Hardiyansyah
     * @return array   all menu
     */
    public function getReport() {
        return Report::all()->pluck('nama', 'id')->all();
    }
    /**
     * Get list report by id group
     * @method getReportById
     * @author Hardiyansyah
     * @param  integer      $id user id
     * @return array        report list of curent user
     */
    public function getReportById($id) {
        $model = new Grup();
        return $model->find($id)->reports()->get()->pluck('id')->all();
    }

}
