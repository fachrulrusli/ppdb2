<?php

namespace App\Console\Commands;
use Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class PromoEmployEmailDaily extends Command
{
    protected $signature = 'promoemploy:day';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim email ke HRD perihal Karyawan Promosi';
    private $subjectdesc = 'Pengingat penilaian karyawan Promosi';
    private $tanggal;
    private $mailto = 'hrd@kspsb.id';
     
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
        $stmt1 = 'CALL `GetPromosionReminder` ()';
        $data1 = DB::connection('mysql-humanys')->select(DB::raw($stmt1));         
        //print (empty($data1) ? 'Kosong':'Isi');
        if (!empty($data1)) {
            Mail::send('promoemail',["datapromo"=>$data1], function ($message) use ($mail){
                $message->from('personalia@kspsb.id');
                $message->subject($this->subjectdesc." [".$this->tanggal."] ");
                $message->to($mail);
            });
            $this->info("Email ".$this->subjectdesc.", Sukses Terkirim !");
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
