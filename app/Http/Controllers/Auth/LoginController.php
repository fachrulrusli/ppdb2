<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\MainControllers;
use Auth;
use Crypt;
use Illuminate\Http\Request;
use App\Consyst\Auth\Contracts\IUserRepository;
use App\Consyst\Auth\MenuRepository;
use App\Consyst\Repository\Hrd\DataKaryawanRepository;
use App\Consyst\Repository\Karyawan\DataPribadiRepository;
use App\Consyst\Repository\Karyawan\PlafonPengobatanRepository;
use App\Consyst\Repository\Master\JamKerjaRepository;
class LoginController extends MainControllers
{
    public function __construct(Request $request, IUserRepository $repository)
    {
        parent::__construct($request, $repository);
    }
    public function show()
    {

        return response()->view(config('consyst.view_base').'login');
    }
    /**
     * Check function
     * This function check whatever user has been loged in or not
     * @return view show login view if dont have authentication yet, and show dashboard if user has been logged in
     */
    public function check()
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Auth::check()) {
            //$usr = Auth::user();
            
            
            $buffer     = new MenuRepository();
            $menus      = $buffer->getMenu();
        
            // var_dump($sisacuti);die();

            $modul      = $this->repository->getMainMenu(Auth::user()->id_user);
            $pages      = (object) array(
                'title'      => trans('auth.session_notfound'),
                'breadcrumb' => \Breadcrumbs::render('dashboard'),
                'box_title'  => '',
                'content'    => '',
                'subtitle'   => '',
                'menus'      => $modul[0]['menus']
            );
            return response()->view(config('consyst.view_base').'dashboard', array('menus' => $menus, 'pages' => $pages));
        } else {

            return response()->view(config('consyst.view_base').'login');
        }
    }
    public function showDashboard()
    {
        return $this->check();
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);
        $username = $request->username;
        $pass = $request->password;

        if (Auth::attempt(['username' => $username, 'password' => $pass])) {
            //$usr = new UserRepository();

            $buffer = Auth::user();
            $g = $this->repository->getGroups(Auth::user()->id_user);
            // var_dump($g);die();

            if($buffer->status==1){

                if($buffer->exp_session_date >= date('Y-m-d')){
                    $this->repository->doLogin($request);
                    $hdn = array(
                        'id' => Crypt::encrypt(Auth::user()->id_user),
                        'kode_cabang' => Crypt::encrypt(Auth::user()->kode_cabang),
                        'name'=>Auth::user()->nama_user,
                        'jenis' => Crypt::encrypt(Auth::user()->jenis),
                        'kode_vendor'=>Crypt::encrypt(Auth::user()->kode_vendor),
                        'nik'=>Crypt::encrypt(Auth::user()->nik),
                        'grup' =>$g['0']->id_grup
                    );
                    \Config::set(['consyst.loged_user' => $hdn]);
                    $request->session()->put('secret', $hdn);

                    echo json_encode(array('status' => 1, 'info' => trans('auth.success')));
                }else{
                    echo json_encode(array('status' => 0, 'info' => 'Your Password is Expired and Must be Changed, Click Forgot Password to Change Your Password'));
                }    
            }else{
                echo json_encode(array('status' => 0, 'info' => trans('auth.user_allready_login')));
                Auth::logout();
                \Session::flush();
            }


        } else {
            echo json_encode(array('status' => 0, 'info' => trans('auth.failed')));
        }
    }

    /**
     * Handle logout process, this function will erase all session and set login field in db with 0.
     *
     * @author Hardiyansyah
     *
     * @return mixed
     */
    public function getLogout()
    {
        Auth::logout();
        $this->repository->doLogout();
        \Session::flush();

        return redirect('/signin');
    }
    /**
     * Check if user have session
     * 
     * @author Hardiyansyah
     * 
     * @return void
     */
    public function checkSession()
    {
        return response()->json(['guest' => Auth::guest()]);
    }
}