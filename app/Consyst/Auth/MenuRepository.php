<?php namespace App\Consyst\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Consyst\Auth\Contracts\IMenuRepository as cInterface;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Models\Menu;

/**
 * Menu repository
 * @author Hardiyansyah
 * @package Consyst\Auth
 */
class MenuRepository extends BaseInterface implements cInterface
{
    protected $buffid;

    public function __construct()
    {
        parent::__construct(new Menu());
        $this->tbName = Config::get("consyst.menu.table");
    }



    /**
     * Generate menu available for user or group
     *
     * @author Hardiyansyah
     * @param $uid |int      user id
     * @param $grpid |int    group id id
     *
     * @return array|static[]
     */
    public function loadMenu($uid, $grpid)
    {

        //if(!$uid){
        $sttm1 = \DB::table('sys_ms_user')
            ->join('sys_ref_usermenu', 'sys_ms_user.id', '=', 'sys_ref_usermenu.id_user')
            ->join('sys_ms_menu', 'sys_ref_usermenu.id_menu', '=', 'sys_ms_menu.id')
            ->select('sys_ms_menu.id', 'sys_ms_menu.nama_menu', 'sys_ms_menu.url', 'sys_ms_menu.icon', 'sys_ms_menu.urutan', 'sys_ms_menu.menu_grup', 'sys_ms_menu.attribut', 'sys_ms_menu.deskripsi', 'sys_ms_menu.status', 'sys_ms_menu.menu_utama')
            ->where('sys_ref_usermenu.id_user', '=', $uid)
            ->where('sys_ms_menu.menu_utama', '=', 1)
            ->where('sys_ms_menu.status', '=', 1)->distinct();
        $sttm2 = \DB::table('ms_sys_grup')
            ->join('sys_ref_grupmenu', 'ms_sys_grup.id', '=', 'sys_ref_grupmenu.id_grup')
            ->join('sys_ms_menu', 'sys_ref_grupmenu.id_menu', '=', 'sys_ms_menu.id')
            ->select('sys_ms_menu.id', 'sys_ms_menu.nama_menu', 'sys_ms_menu.url', 'sys_ms_menu.icon', 'sys_ms_menu.urutan', 'sys_ms_menu.menu_grup', 'sys_ms_menu.attribut', 'sys_ms_menu.deskripsi', 'sys_ms_menu.status', 'sys_ms_menu.menu_utama')
            ->where('sys_ref_grupmenu.id_grup', '=', $grpid)
            ->where('sys_ms_menu.menu_utama', '=', 1)
            ->where('sys_ms_menu.status', '=', 1)->distinct();
        $result = $sttm1->union($sttm2)->get();
        return $result;

    }

    /**
     * Generate all menu available for user or group
     *
     * @author Hardiyansyah
     * @param $uid |int      user id
     * @param $grpid |int    group id id
     *
     * @return array|static[]
     */
    public function loadMenuAll($uid, $grpid)
    {

        //if(!$uid){
        $sttm1 = \DB::table(Config::get("consyst.menu.table"))
            ->join('sys_ref_usermenu', 'sys_ms_user.id', '=', 'sys_ref_usermenu.id_user')
            ->join('sys_ms_menu', 'sys_ref_usermenu.id_menu', '=', 'sys_ms_menu.id')
            ->select('sys_ms_menu.id', 'sys_ms_menu.nama_menu', 'sys_ms_menu.url', 'sys_ms_menu.icon', 'sys_ms_menu.urutan', 'sys_ms_menu.menu_grup', 'sys_ms_menu.attribut', 'sys_ms_menu.deskripsi', 'sys_ms_menu.status', 'sys_ms_menu.menu_utama')
            ->where('sys_ref_usermenu.id_user', '=', $uid)
            ->where('sys_ms_menu.menu_utama', '=', 1)
            ->distinct();
        $sttm2 = \DB::table(Config::get("consyst.grup.table"))
            ->join('sys_ref_grupmenu', 'ms_sys_grup.id', '=', 'sys_ref_grupmenu.id_grup')
            ->join('sys_ms_menu', 'sys_ref_grupmenu.id_menu', '=', 'sys_ms_menu.id')
            ->select('sys_ms_menu.id', 'sys_ms_menu.nama_menu', 'sys_ms_menu.url', 'sys_ms_menu.icon', 'sys_ms_menu.urutan', 'sys_ms_menu.menu_grup', 'sys_ms_menu.attribut', 'sys_ms_menu.deskripsi', 'sys_ms_menu.status', 'sys_ms_menu.menu_utama')
            ->where('sys_ref_grupmenu.id_grup', '=', $grpid)
            ->where('sys_ms_menu.menu_utama', '=', 1)
            ->distinct();
        $result = $sttm1->union($sttm2)
            ->orderBy('urutan', 'asc')
            ->get();
        return $result;
    }

    /**
     * Get Child menu recursively
     * @return mixed
     */
    public function getChild()
    {

        return $this->model->with('childs')
            ->where(Config::get("consyst.menu.parent"), "=", 0)
            ->get();
    }

    /**
     * Showing data with join table
     * @return mixed
     */

    public function showData() {
          return $this->model->select('id_menu', 'nama_menu','deskripsi','menu_grup','menu_utama','icon','url','urutan','status')->get();
        }
    public function getData() {
        return $this->model->select('id_menu', 'nama_menu')->get();
    }

    /**
     * Change status
     * @param  integer $id id
     * @param  integer $value beetween 0 to 1, 1 for aktive and 0 for non active
     * @return mixed
     */
    public function changeStatus($id, $value)
    {
        return \DB::table($this->tbName)
            ->where('id_menu', $id)
            ->update(['status' => $value]);
    }

    public function loadMenuX($gid)
    {

        $buffMenu = $this->loadMenu(Auth::User()->id, $gid);
        $buffid = array_pluck($buffMenu, 'id');
        $this->buffid = $buffid;
        $buff = Menu::with(['childs' => function ($q) use ($buffid) {
            $q->whereIn('id', $buffid);
        }])->where('menu_grup', 0)
            ->whereIn('id', $buffid)
            ->orderBy('urutan')
            ->get();
        $rtn = $this->walk_recursive_remove($buff->toArray(), array($this, 'doFilter'));
        return $rtn;
    }

    /**
     * Iterate recursive in array and remove it
     * @method  walk_recursive_remove
     * @author  Hardiyansyah
     * @param   array $array
     * @param   callable $callback
     * @return  array
     */
    public function walk_recursive_remove(array $array, callable $callback)
    {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $array[$k] = $this->walk_recursive_remove($v, $callback);
            } else {
                if ($callback($v, $k)) {
                    unset($array);


                }
            }
        }
        return $array;
    }

    public function doFilter($value, $key)
    {

        if ($value) {
            if ($key == 'id') {
                return !array_search($value, $this->buffid);
            }
        }

    }

    /**
     * Load all menu related to current user+group
     * @method loadMenuMultiGroup
     * @author Hardiyansyah
     * @param  integer $uid userID
     * @param  array $grpid array of group users
     * @return object                     union result query
     */
    public function loadMenuMultiGroup($uid, $grpid)
    {

        //if(!$uid){
        $sttm1 = \DB::table('sys_ms_user')
            ->join('sys_ref_usermenu', 'sys_ms_user.id_user', '=', 'sys_ref_usermenu.id_user')
            ->join('sys_ms_menu', 'sys_ref_usermenu.id_menu', '=', 'sys_ms_menu.id_menu')
            ->select('sys_ms_menu.id_menu', 'sys_ms_menu.nama_menu', 'sys_ms_menu.url', 'sys_ms_menu.icon', 'sys_ms_menu.urutan', 'sys_ms_menu.menu_grup', 'sys_ms_menu.attribut', 'sys_ms_menu.deskripsi', 'sys_ms_menu.status', 'sys_ms_menu.menu_utama')
            ->where('sys_ref_usermenu.id_user', '=', $uid)
            ->where('sys_ms_menu.menu_utama', '=', 1)
            ->where('sys_ms_menu.status', '=', 1);
        if (count($grpid)>0)
        {
            foreach ($grpid as $gid) {
                $sttm = \DB::table('sys_ms_grup')
                    ->join('sys_ref_grupmenu', 'sys_ms_grup.id_grup', '=', 'sys_ref_grupmenu.id_grup')
                    ->join('sys_ms_menu', 'sys_ref_grupmenu.id_menu', '=', 'sys_ms_menu.id_menu')
                    ->select('sys_ms_menu.id_menu', 'sys_ms_menu.nama_menu', 'sys_ms_menu.url', 'sys_ms_menu.icon', 'sys_ms_menu.urutan', 'sys_ms_menu.menu_grup', 'sys_ms_menu.attribut', 'sys_ms_menu.deskripsi', 'sys_ms_menu.status', 'sys_ms_menu.menu_utama')
                    ->where('sys_ref_grupmenu.id_grup', '=', $gid)
                    ->where('sys_ms_menu.menu_utama', '=', 1)
                    ->where('sys_ms_menu.status', '=', 1);
                $result = $sttm1->union($sttm);
            }

            return $result->orderBy('urutan', 'asc')->get();
        }else{
            return $sttm1->orderBy('urutan', 'asc')->get();
        }
    }

    /**
     * get menu for current user
     * @method getMenu
     * @author Hardiyansyah
     * @return array  Array of menus
     */
    public function getMenu()
    {

        $mn = new MenuRepository();
        $gid = Auth::user()->grups()->get()->pluck('id_grup')->toArray();
        $buffMenu = $mn->loadMenuMultiGroup(Auth::User()->id_user, $gid);
        $buffidunique = array_unique(array_pluck($buffMenu, 'id_menu'));
        session()->put('secret.menus', $buffidunique);
        $modelmenu = new Menu();
        $buff = $modelmenu->with(['childs' => function ($q) use ($buffidunique) {
            $q->whereIn('id_menu', $buffidunique);
        }])->where('menu_grup', 0)
            ->whereIn('id_menu', $buffidunique)
            ->orderBy('urutan')
            ->get();

        session()->forget('secret.menus');
        return $buff->toArray();

    }



}
