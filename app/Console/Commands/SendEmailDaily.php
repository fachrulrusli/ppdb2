<?php

namespace App\Console\Commands;
use Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class SendEmailDaily extends Command
{
   protected $signature = 'word:day';
     
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';
     
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
        $stmt1 = "EXEC sp_penilaian_getappraisaldata";
        $data = DB::select(DB::raw($stmt1));
        $count = count($data);
        
 
        for($i=0; $i<$count; $i++) {
            for($i=0; $i<$count; $i++) {

                // print_r($data[$i]->nik);

               // DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
               $sql = "SELECT dbo.fn_penilaian_getmaxappraisal_id ('".$data[$i]->nik."') As AppraisalID";
               $getAppraisalID = DB::select(DB::raw($sql));
               // print_r($getAppraisalID[$i]->AppraisalID);
                // INI UNTUK MENILAI SIAPA //
                DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
                $stmt4 = "EXEC sp_penilaian_getevaluationmail @empid = '".$data[$i]->nik."'";
                $data3 = DB::select(DB::raw($stmt4));
             
                // INI UNTUK ANDA AKAN DINILAI SAMA SIAPA AJA//
                DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
                $stmt3 = "EXEC sp_penilaian_getevaluatorfrom_id @_id = ".$getAppraisalID[0]->AppraisalID."";
                $data2 = DB::select(DB::raw($stmt3));
                $now = date('Y-m-d');


                if(empty($data3[0]->ExpDate) && empty($data2[0]->nik)){
                      // echo "a";  
                    // print_r($getAppraisalID[0]->AppraisalID);
                    DB::table('tr_penilaian_mst')
                    ->where('AppraisalID', $getAppraisalID[0]->AppraisalID)
                    ->update(['IsFinished' => 2]);

                }else{
                    
                    if(empty($data3[0]->ExpDate)){
                        $date = $data2[0]->ExpDate;
                    }else{
                        $date = $data3[0]->ExpDate;
                    }
                    if(empty($data2[0]->ExpDate)){
                        $date = $data3[0]->ExpDate;
                    }else{
                        $date = $data2[0]->ExpDate;
                    };

                    if($now > $date) {
                        DB::table('tr_penilaian_mst')
                        ->where('AppraisalID', $getAppraisalID[0]->AppraisalID)
                        ->update(['IsFinished' => 2]);
                    }else{                
                        $mail = $data[$i]->email_addr;
                       
                        Mail::send('croneemail',["html1"=>$data2, "html2" => $data3], function ($message) use ($mail){
                            $message->from('personalia@kspsb.id','Penilaian Karyawan');
                            $message->subject('Penilaian Karyawan KSPSB');
                            $message->to($mail);  
                        });
                    }
                }
            }
        }
      
        $this->info('The emails are send successfully!');
        
    }
}


