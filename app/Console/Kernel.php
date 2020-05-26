<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        
        'App\Console\Commands\SendEmailDaily'        
        ,'App\Console\Commands\SchdoaEmailDaily'
        ,'App\Console\Commands\PromoEmployEmailDaily'
        ,'App\Console\Commands\ResignEmployEmail'
        ,'App\Console\Commands\LatePresenceEmailDaily'
        ,'App\Console\Commands\PengingatAbsenPulang1'
        ,'App\Console\Commands\PengingatAbsenPulang2'

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {        
        //$schedule->command('word:day')
        //    ->twiceDaily(9, 14);        
        // $schedule->call(function () {
        //     DB::unprepared('SET IDENTITY_INSERT tr_jawaban ON');
        //     DB::table('tr_jawaban')->insert([
        //         'id' => "11",
        //         'id_pertanyaan' => "1",
        //         'jawaban'   => "5",
        //         'created_at' => date("Y-m-d")
        //     ]);
        //     DB::unprepared('SET IDENTITY_INSERT tr_jawaban OFF');

        // })->everyMinute();

        $schedule->command('pengingatabsenpusat:day')
           ->dailyAt('17:50');
        $schedule->command('pengingatabsencabang:day')
           ->dailyAt('17:50');

        // $schedule->command('schdoa:day')
        //    ->dailyAt('14:10');
        //$schedule->command('resignemploy:month')
        //    ->monthly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
