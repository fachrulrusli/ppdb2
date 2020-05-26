<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\MainControllers;
use Auth;
use Crypt;
use App\Consyst\Auth\Contracts\IUserRepository;
use App\Consyst\Auth\MenuRepository;
use App\Consyst\Repository\Hrd\DataKaryawanRepository;
use App\Consyst\Misc\ConsystHelper;
use Session;
use DB;
Use Carbon\Carbon;


class ForgotPasswordController extends MainControllers
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, IUserRepository $repository)
    {
        parent::__construct($request, $repository);
    }
    public function showResetForm(Request $request, $token = null)
    {
        return response()->view(config('consyst.view_base').'reset');
    }


    public function getNik($nohp) {
        DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $stmt2 = "SELECT nik FROM sys_ms_user WHERE hp = '".$nohp."'";
        return DB::select(DB::raw($stmt2));
    }
    public function getToken($token) {
        DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $stmt2 = "SELECT kode_otp FROM sys_ms_user WHERE kode_otp = '".$token."'";
        return DB::select(DB::raw($stmt2));
    }

    public function forgot(){
        $r_wa = $this->request->nowa;
        if(!empty($r_wa)){
            $nowa = str_replace(' ', '', $r_wa);
            if(substr($nowa, 0,1) == 0){
                $nowanya = str_replace('0', '62',substr($nowa,0,1));
                $nomor = $nowanya.substr($nowa, 1,12);
            }else{
                $nowanya = 62;
                $nomor = $nowanya.$nowa;
            }


            $length = 6;
            $str = "";
            $characters = array_merge(range('A','Z'), range('0','9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $new_otp = $str;
            $getNIK = $this->getNIK($nomor);
            if(empty($getNIK)){
                $getNIK2 = $this->getNIK($nowa);
                if(empty($getNIK2)){
                    $rtn = ConsystHelper::generateJsonAction('Nomor WA Tidak Terdaftar', 50);
                    return \response($rtn);
                }else{
                    $nik = $getNIK2[0]->nik;
                }
            }else{
                $nik = $getNIK[0]->nik;
            }
         
            DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
            $stmt2 = "UPDATE sys_ms_user SET kode_otp = '".$new_otp."' WHERE nik = '".$nik."'";
            $update = DB::update($stmt2);
            $token = md5($new_otp);

            // var_dump($nomor);die();
            $wa = config('consyst.SendWA.WA');
            $token = config('consyst.SendWA.TOKEN');
            $message = '<#> Kode Verifikasi Humanys : *'.$new_otp.'* ';
            $data = [
            'phone' => $nomor, // Receivers phone
            'body' => $message// Message
            ];
            
            $json = json_encode($data); // Encode data to JSON
            $url = 'https://api.chat-api.com/'.$wa.'/sendMessage?token='.$token.'';
            
            $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json,
                'timeout'=>60
            ]
            ]);
        
      
            $result = file_get_contents($url, false, $options);
            if($result){
                $rtn = ConsystHelper::generateJsonAction(trans('message.save_success'), 99);
                return \response($rtn);
            }else{
                $rtn = ConsystHelper::generateJsonAction(trans('message.save_failed'), 0);
                return \response($rtn);
            }
        }
    }

    public function showformwithtoken(){
        return response()->view(config('consyst.view_base').'resetform');
    }
    public function reset(){
        // var_dump($this->request->all());die();
        $token = strtoupper($this->request->kode1.$this->request->kode2.$this->request->kode3.$this->request->kode4.$this->request->kode5.$this->request->kode6);
        // var_dump($token);die();
        $pass = $this->request->password;
        $conpass = $this->request->password_confirmation;
        $getToken = $this->getToken($token);
        if(!empty($getToken)){
            $token2 = $getToken[0]->kode_otp;
        }else{
            $token2= 0;
        }
        // var_dump($token);die();
        try {
            if($pass === $conpass){
                if($token === $token2){
                    DB::Table('sys_ms_user')
                    ->where('kode_otp',$token2)
                    ->update(array('password' => bcrypt($pass), 'updated_at' => Carbon::now(),'kode_otp' => null, 'exp_session_date' => Carbon::now()->addMonth(1)));

                    return 99;
                }else{
                    return 50;
                }
            }else{
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
       
    }

}
