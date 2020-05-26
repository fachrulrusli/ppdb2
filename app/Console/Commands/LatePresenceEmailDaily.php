<?php

namespace App\Console\Commands;
use Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class LatePresenceEmailDaily extends Command
{
    /**
     *  Author  : Hendra Abuhafiz
     *  Created : 2020-02-13
     *  Last Update : 2020-02-14
     */

    protected $signature = 'latepresence:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim email harian info daftar karyawan terlambat ke milist sbuilding';
    private $subjectdesc = "Daftar Karyawan Terlambat";
    private $tanggal;
    private $mailto = 'sbbuilding@kspsb.id'; // 'hendra@kspsb.id';
     
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
     
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   

        $mail = $this->mailto;
        $this->tanggal = $this->fmt_tglindo(date('Y-m-d'));
       
        $sql = "SELECT * FROM `fingerspot`.`mst_info` where InfoId=6";
        $flaginfo = DB::connection('mysql-fingerspot')->select(DB::raw($sql)); // Get Flag Info
        
        if ($flaginfo[0]->InfoText == 1) {
            
            $stmt1 = "CALL `ShowLatePresenceException` (1)";
            $data1 = DB::connection('mysql-fingerspot')->select(DB::raw($stmt1)); 
            $stmt2 = "CALL `ShowLatePresenceException` (2)";
            $data2 = DB::connection('mysql-fingerspot')->select(DB::raw($stmt2)); 
            $stmt3 = "CALL `ShowLatePresenceException` (3)";
            $data3 = DB::connection('mysql-fingerspot')->select(DB::raw($stmt3)); 
            
            Mail::send('latepresencemail',["tgl"=>$this->tanggal, "datafinger1"=>$data1, "datafinger2"=>$data2, "datafinger3"=>$data3], function ($message) use ($mail){
                $message->from('personalia@kspsb.id');
                $message->subject("[Sbbuilding] ".$this->subjectdesc." (".$this->tanggal.")");
                $message->to($mail);
            });
            
            $this->info(date('Y-m-d, H:i:s')."->Email ".$this->subjectdesc.", Sukses Terkirim !");  

            DB::connection('mysql-fingerspot')
                ->select(DB::raw('update `fingerspot`.`mst_info` set `InfoText` = 0 where `InfoId`=6')); // Set Flag Info
                
        }
    
    }


    
    function fmt_tglindo($date) {
        $date = date('Y-m-d',strtotime($date));
        if($date == '0000-00-00')
            return 'Tanggal Kosong';
     
        $tgl = substr($date, 8, 2);
        $bln = substr($date, 5, 2);
        $thn = substr($date, 0, 4);
     
        switch ($bln) {
            case 1 : {
                    $bln = 'Januari';
                }break;
            case 2 : {
                    $bln = 'Februari';
                }break;
            case 3 : {
                    $bln = 'Maret';
                }break;
            case 4 : {
                    $bln = 'April';
                }break;
            case 5 : {
                    $bln = 'Mei';
                }break;
            case 6 : {
                    $bln = "Juni";
                }break;
            case 7 : {
                    $bln = 'Juli';
                }break;
            case 8 : {
                    $bln = 'Agustus';
                }break;
            case 9 : {
                    $bln = 'September';
                }break;
            case 10 : {
                    $bln = 'Oktober';
                }break;
            case 11 : {
                    $bln = 'November';
                }break;
            case 12 : {
                    $bln = 'Desember';
                }break;
            default: {
                    $bln = 'UnKnown';
                }break;
        }
     
        $hari = date('N', strtotime($date));
        switch ($hari) {
            case 0 : {
                    $hari = 'Minggu';
                }break;
            case 1 : {
                    $hari = 'Senin';
                }break;
            case 2 : {
                    $hari = 'Selasa';
                }break;
            case 3 : {
                    $hari = 'Rabu';
                }break;
            case 4 : {
                    $hari = 'Kamis';
                }break;
            case 5 : {
                    $hari = "Jum'at";
                }break;
            case 6 : {
                    $hari = 'Sabtu';
                }break;
            default: {
                    $hari = 'UnKnown';
                }break;
        }
     
        $tglindo = $hari.", ".$tgl . " " . $bln . " " . $thn;
        return $tglindo;
    }

}

