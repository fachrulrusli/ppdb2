<?php
namespace App\Consyst\Auth;
use App\Consyst\Models\Cabang;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Consyst\Auth\Contracts\IUserRepository as UserInterface;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Models\Grup;
use App\Consyst\Models\Menu;
use App\Consyst\Models\User;
use App\Consyst\Models\Akses;

use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * user repository.
 *
 * @author Hardiyansyah
 */
class UserRepository extends BaseInterface implements UserInterface {
	public function __construct() {
		parent::__construct(new User());
		$this->tbName = Config::get('consyst.user.table');
	}

	#region Consyst\Auth\IUserRepository Members

	/**
	 * Get the password for the user.
	 *
	 * @author Hardiyansyah
	 *
	 * @return mixed
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Login logic.
	 *
	 * @author Hardiyansyah
	 */
	public function doLogin() {
		if (Auth::check()) {
			$usr = Auth::user();
			$usr->login_terakhir = Carbon::now();
			$usr->login_ip = request()->ip();
			$usr->save();
		}
	}

	/**
	 * Logout Logic.
	 *
	 * @author Hardiyansyah
	 */
	public function doLogout() {
		if (Auth::check()) {
			// set login field to 0
			$usr = $this->find(Auth::user()->id_user);
			$usr->login = 0;
			$usr->save();
		}
	}
	public function getGroupId() {
		if (Auth::check()) {
			// set login field to 0
			return Auth::user()->find(Auth::id())->grups()->first();
		}
	}
	public function getPermissions() {
		return $this->model->akses();
	}

	/**
	 * Change status.
	 *
	 * @param int $id    preference id
	 * @param int $value beetween 0 to 1, 1 for aktive and 0 for non active
	 *
	 * @return mixed
	 */
	public function changeStatus($id, $value) {
		return \DB::table($this->tbName)
			->where('id_user', $id)
			->update(['status' => $value]);
	}
	/**
	 * Showing data with join table.
	 *
	 * @return mixed
	 */
	public function showData() {
	    return $this->model->with('cabang');

	}
	/**
	 * Get refrence table for combobox.
	 *
	 * @return object array of object
	 */
	public function getReference() {
		return (object) array(
			'grup' => Grup::all()->pluck('FullName', 'id_grup')
		);
	}
	/**
	 * Get Group of specifict user.
	 *
	 * @param string @id user id to find
	 *
	 * @return mixed
	 */
	public function getGroups($id) {

		return $this->model->find($id)
			->grups()->get();
	}
	/**
	 * save into database.
	 *
	 * @method Store
	 *
	 * @author Hardiyansyah
	 *
	 * @param string $data  array of string attribute
	 * @param string $group array of string group
	 *
	 * @return mixed 1 if succed and null if error occurred
	 */
	public function Store($data, $group) {
		try {
			$model = $this->model->newInstance();
			$model->fill($data);

			\DB::transaction(function () use ($model, $group) {
				$model->save();
				$model->grups()->sync($group);
			});
			$this->resetModel();

			return 1;
		} catch (Exception $e) {
			$this->resetModel();

			return 0;
		}
	}
	/**
	 * Update record.
	 *
	 * @method Update
	 *
	 * @author Hardiyansyah
	 *
	 * @param string $data  array of string attribute
	 * @param string $group array of string group
	 * @param string $id    id user
	 *
	 * @return mixed 1 if succed and null if error
	 */
	public function UpdateX($data, $group, $id) {
		$model = $this->model->newInstance();
		$model = $model->findOrFail($id);

		$model->fill($data);

        try {
			\DB::transaction(function () use ($model, $group) {
				$model->save();
				$model->grups()->sync($group);
			});
			$this->resetModel();
            DB::commit();
			return 1;
		} catch (Exception $e) {

            DB::rollBack();
			$this->resetModel();
			return 0;
		}
	}

	/**
	 * Delete a entity in repository by id overide base repo.
	 *
	 * @param  $id
	 *
	 * @return int
	 */
	public function delete($id) {
		try {
			$model = $this->find($id);
			$originalModel = clone $model;
			$this->resetModel();
			$deleted = $model->delete();
			$originalModel->grups()->detach();

			return $deleted;
		} catch (Exception $e) {
			$this->resetModel();

			return;
		}
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
		$model = new User();

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
		return Menu::all()->pluck('nama_menu', 'id_menu')->all();
	}
	/**
	 * Get list Menu by id user
	 * @method getMenuById
	 * @author Hardiyansyah
	 * @param  integer      $id user id
	 * @return array        menu list of curent user
	 */
	public function getMenuById($id) {
		$model = new User();
		return $model->find($id)->menus()->get()->pluck('id_menu')->all();
	}
	/**
	 * Store menu
	 * @method storeMenus
	 * @author Hardiyansyah
	 * @param  inte	ger     $id    user id
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

	public function checkPassAuthor($pass) {
		//$model = User::whereRaw('password_otorisasi = ? and id= ?', array(Hash::make($pass), Auth::id()))->first();
		if (Hash::check($pass,Auth::User()->password_otorisasi))
		{
			return true;

		}else{
			return false;
		}
	}
	public function checkPass($pass) {
		//$model = User::whereRaw('password_otorisasi = ? and id= ?', array(Hash::make($pass), Auth::id()))->first();
		if (Hash::check($pass,Auth::User()->password))
		{
			return true;

		}else{
			return false;
		}
	}

	public function getMainMenu($id)
    {
        return $this->model->where('id_user',$id)->with(['menus' => function ($query) {
            $query->where('status',1)->where('menu_grup',0)->orderBy('urutan', 'ASC');
        }])->get()->toArray();
    }

    public function getChildMenu($id,$gid)
    {
        return $this->model->where('id_user',$id)->with(['menus' => function ($query) use($gid) {
            $query->where('status',1)->where('menu_grup',$gid)->orderBy('urutan', 'ASC');
        }])->get()->toArray();
    }
	
	public function getUser() {
	    $grup = Session::get('secret')['grup'];
       	$username = Auth::user()->username;
		return $this->model->select('id_user', 'username','nama_user','kode_cabang','status','nik')
                    ->get();
 
    }

	public function getCabang($type) {
		return (object) array(
            'cabang' => Cabang::where('jenis', $type)->pluck('nama_cabang', 'id_cabang'),
		);
	}

	public function getBranchType($branch) {
		if( !empty($branch) ) {
			return  Cabang::select('jenis')->where('id_cabang', $branch)->first();
		}
	}
}
