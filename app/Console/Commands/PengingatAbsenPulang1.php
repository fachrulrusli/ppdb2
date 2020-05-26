<?php

namespace App\Console\Commands;
use Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class PengingatAbsenPulang1 extends Command
{
   protected $signature = 'pengingatabsenpusat:day';
     
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notif Pengingat Absen Pulang Pusat';
     
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

        $date = date('Y-m-d');

        DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $stmt1 = "SELECT DISTINCT x.nik,x.nama, x.kdshift,c.batas_pulang, CONVERT(TIME,DATEADD(MINUTE, -10, c.batas_pulang)) as sendtime, z.hp 
                    FROM(
                    SELECT DISTINCT a.nik, b.nama,
                    CASE WHEN b.id_cabang LIKE '%001%' OR b.id_cabang LIKE '%000%' THEN '1' ELSE '2' END as kdshift 
                    FROM [dbo].[tr_kehadiran_new] a
                    INNER JOIN v_kywexists b ON b.nik = a.nik 
                    WHERE tanggal = '".$date."'
                    AND manual = 'WFH' AND jammasuk = jamkeluar) as x
                    INNER JOIN ms_jam_office c ON c.kodeshift = x.kdshift
                    INNER JOIN sys_ms_user z ON z.nik = x.nik 
                    WHERE x.kdshift = '1' AND hp is not null
                ";
        $data = DB::select(DB::raw($stmt1));
        $count = count($data);
        
        if(!empty($date)){
            for($i=0; $i<$count; $i++) {
                if(substr($data[$i]->hp, 0,1) == 0){
                    $nowanya = str_replace('0', '62',substr($data[$i]->hp,0,1));
                    $nomor = $nowanya.substr($data[$i]->hp, 1,12);
                }
                // print_r($nomor);
                $wa = config('consyst.SendWA.WA');
                $token = config('consyst.SendWA.TOKEN');
                $message = 'Yth. *'.$data[$i]->nama.'* '."\r\n\r\n".'Jangan Lupa Presensi Pulang, Segera Lakukan Presensi Sebelum Jam '.$data[$i]->batas_pulang.' WIB'."\r\n\r\n".'*Pesan Ini Dikirim Otomatis Oleh Sistem, Mohon Untuk Tidak Membalas Pesan Ini*'."\r\n".'*Terima Kasih,*'."\r\n".'*Stay Safe Stay Healthy*';

                $data[$i] = [
                    'phone' => $nomor, // Receivers phone
                    'body' => $message// Message
                ];
                $json[$i] = json_encode($data[$i]); // Encode data to JSON
                // print_r($json[$i]);
                $url = 'https://api.chat-api.com/'.$wa.'/sendMessage?token='.$token.'';
                
                $options = stream_context_create(['http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $json[$i],
                    'timeout'=>60
                ]
                ]);
               
                $result = file_get_contents($url, false, $options);

                if($result){
                    $this->info('The Message Sent Successfully!');
                }else{
                    $this->info('The Message Cannot Send, please try again!');
                }
            }
        }else{
                $this->info('Data is empty');
        }  
    }

}


