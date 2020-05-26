<?php

namespace App\Console\Commands;
use Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class SchdoaEmailDaily extends Command
{
    protected $signature = 'schdoa:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim email harian Pembacaan Doa utk semua Karyawan';
    private $subjectdesc = "Pemberitahuan Pembaca Do'a";
    private $tanggal;
    private $mailto = 'sbbuilding@kspsb.id';
     
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
        
        DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $mail = $this->mailto;
        //$sql = "SELECT * FROM `fingerspot`.`ShowDateMotivation`";
        //$trxDate = DB::connection('mysql-fingerspot')->select(DB::raw($sql));
        $sql ="SELECT DISTINCT TOP 2 TrxDate FROM dbo.tr_motivation WHERE TrxDate > GETDATE()
ORDER BY TrxDate";
        $trxDate = DB::select(DB::raw($sql));
        //$stmt1 = "CALL ShowMotivationOnDay ('".$trxDate[0]->TrxDate."')";
        //$data1 = DB::connection('mysql-fingerspot')->select(DB::raw($stmt1)); 
        $stmt1 = "EXEC sp_showmotivationonday '".$trxDate[0]->TrxDate."'";
        $data1 = DB::select(DB::raw($stmt1)); 
        $stmt2 = "EXEC sp_showmotivationonday '".$trxDate[1]->TrxDate."'";
        $data2 = DB::select(DB::raw($stmt2));
        
        $data3 = 
        [(object) [
            "ADate" => $this->fmt_tglindo(date('Y-m-d', strtotime($trxDate[0]->TrxDate))),
            "ANextDate" => $this->fmt_tglindo(date('Y-m-d', strtotime($trxDate[1]->TrxDate)))
        ]];        
        $this->tanggal = $data3[0]->ADate;
        
        Mail::send('schdoaemail',["datadoa1"=>$data1, "datadoa2"=>$data2, "datadoa3"=>$data3], function ($message) use ($mail){
            $message->from('personalia@kspsb.id');
            $message->subject("[Sbbuilding] ".$this->subjectdesc." Hari ".$this->tanggal);
            $message->to($mail);
        });
        
        $this->info("Email ".$this->subjectdesc.", Sukses Terkirim !");        
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


