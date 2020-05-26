<?php namespace App\Consyst\Misc;

use Carbon\Carbon;
use DateTime;
use Symfony\Component\Process\Process;

/**
 * Consyst Global Helper
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package Consyst\Misc
 *
 */
class ConsystHelper
{
    /**
     * Helper function to format array of menu to provide child in properties
     *
     * @author Hardiyansyah
     * @param   $menus |array    menu object
     *
     * @return  array
     */
    public function formatMenuArray($menus)
    {
        $rtn = array();
        foreach ($menus as $menu) {
            $child = 0;
            $childMenu = array();
            $key = $menu->id;
            if ($menu->menu_grup == 0) {
                $childMenu = $this->isChild($menus, $key);
                //print_r($childMenu);
                $child = count($childMenu);
                $menu->child = $child;
                $menu->menus = $childMenu;
                array_push($rtn, $menu);
            }

        }
        return $rtn;
    }

    /**
     * Helper function to menu matcmaking
     *
     * @author  Hardiyansyah
     * @param   $menus |array  menu object
     * @param   $e |int        menu id ( parent )
     * @return  array
     */
    public function isChild($menus, $e)
    {
        return array_filter($menus, function ($element) use ($e) {

            return $element->menu_grup == $e;
        });
    }

    /**
     * Check if field type is binary data taype
     *
     * @author  Hardiyansyah
     * @param $input
     * @return bool
     */
    public function is_binary($input)
    {
        if (is_null($input)) {
            return false;
        }

        if (is_integer($input)) {
            return false;
        }

        return !ctype_print($input);
    }

    /***
     * handle binary data type on postgre
     * @param $bin
     * @return string
     */
    public function binary_sql($bin)
    {
        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            return pg_escape_bytea($bin);
        }

        return $bin;
    }

    /**
     * Handles binary data for database connections.
     *
     * @param  binary $bin
     * @return binary
     */

    public static function unescapeBinary($bin)
    {
        if (is_resource($bin)) {
            $bin = stream_get_contents($bin);
        }

        if (\DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $bin = pg_unescape_bytea($bin);
        }

        return $bin;
    }

    /**
     * Generate action button for datatable
     *
     * @author Hardiyansyah
     * @param  integer $id id
     * @param  string $urlEdit Edit Url
     * @param  string $urlDelete delete url
     * @param  String $custom custom html
     * @return string             formated html
     */
    public static function generateActionButton($id, $urlEdit, $urlDelete, $custom = "")
    {
        $rtn = '<div class="btn-group">';
        $edit = '<a href="#" data="' . $urlEdit . '" class="btn btn-xs btn-primary btn-edit" id="re-' . $id . '" onclick=ajaxEdit("#re-' . $id . '"); data-toggle="modal" data-target="#Form"><i class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Data"></i></a>';
        $delete = '<a href ="#" data="' . $urlDelete . '" class="btn btn-xs btn-danger" id="rd-' . $id . '" onclick=showConfirm("#rd-' . $id . '");><i class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Data"></i></a>';

        if (!$urlEdit == "") {
            $rtn .= $edit;
        }
        if (!$urlDelete == "") {
            $rtn .= $delete;
        }
        $rtn .= $custom;
        $rtn .= '</div>';
        return $rtn;

    }

    /**
     * Generate action button custom
     * this function will generate action button and user must pass button param for button
     *
     * @author Hardiyansyah
     * @param  array $button array button list with parameter
     * @return string             formated html
     */
    public static function generateActionButtonEx($button)
    {
        $rtn = '<div class="btn-group">';
        foreach ($button as $value) {

            $rtn .= ConsystHelper::generateEditButton($value);

        }
        $rtn .= '</div>';
        return $rtn;

    }

    /**
     * Generate toolbar button for datatable
     *
     * @author Hardiyansyah
     * @param bool $shownew show new button
     * @return string string formated html
     */
    public static function generateToolbarButton($showNew = false, $custom = "")
    {

        $new = '<a class="btn red btn-xs new" data-target="#Form"><i class="fa fa-plus"></i> <span>'.trans('button.global.new').'</span></a>';
        $refresh = '<a class="btn blue btn-xs" href="#" id="refresh"><i class="fa  fa-refresh"></i> <span>'.trans('button.global.refresh').'</span></a>';

        $rtn = '<div class="btn-group">';
        if ($showNew == true) {
            $rtn .= $new;
        }
        $rtn .= $refresh;

        //if ($custom<>""){
        $rtn .= $custom;
        //}
        $rtn .= "</div><br/><br/>";
        return $rtn;

    }

    /**
     * Generate json response
     *
     * @author Hardiyansyah
     * @param  string $message Message to be displayed
     * @param  integer $status status
     * @return mixed          Json response
     */
    public static function generateJsonAction($message, $status)
    {
        $rtn = array(
            "status" => $status,
            "msg" => $message,
        );
        return $rtn;
    }

    /**
     * Generete 1 action button for grid action button
     * @method generateEditButton
     * @author Hardiyansyah
     * @param  array $param array of button with parameter
     * @return string                   string formated html for button
     */
    public static function generateEditButton($param)
    {

        $rtn = '<div class="btn-group">';
        $url = $param['url'];
        if (empty($url)) {
            return '';
        }
        $button = '<a href="#" data="' . $url . '" class="btn btn-xs ?type ?class" id="?pre_id-' . $param['id'] . '" onclick=?onclick("#?pre_id-' . $param['id'] . '"); ><i class="?icon"  data-toggle="tooltip" title="?title"></i>?title</a>';
        $buffer = str_replace("?type", $param['button_type'], $button);
        $buffer = str_replace("?class", $param['button_class'], $buffer);
        $buffer = str_replace("?icon", $param['icon'], $buffer);
        $buffer = str_replace("?onclick", $param['on_click'], $buffer);
        $buffer = str_replace("?title", $param['title'], $buffer);
        $buffer = str_replace("?pre_id", $param['id_prefix'], $buffer);

        // 1. url
        // 2. icon
        // 3. caption - on halt
        // 4. button_class
        // 5. button_type
        $rtn .= $buffer;
        $rtn .= "</div>";

        return $rtn;
    }

    /**
     * Handling nullable date value
     * @method dateNullHandler
     * @author Hardiyansyah
     * @param  date $value given date
     * @return date                 if given variable is null then return null
     */
    public static function dateNullHandler($value)
    {
        if (strlen($value)) {
            return new Carbon($value);
        } else {
            return null;
        }
    }

    public static function checkMenu($id, $arrID)
    {
        if (in_array($id, $arrID)) {
            return true;
        }
    }

    public static function removeWhiteSpace($str)
    {
        return preg_replace('/\s+/', '', $str);
    }

    public static function returnHelper($msg, $sts)
    {
        return array(
            'msg' => $msg,
            'status' => $sts
        );
    }

    /**
     * Log query in PDOException event
     * @method logQueryException
     * @author Hardiyansyah
     * @param  PDOException $e PDOException
     * @return void
     */
    public static function logQueryException(\PDOException $e)
    {
        $sql = $e->getSql();
        $bd = $e->getBindings();
        foreach ($bd as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $bd[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } else {
                if (is_string($binding)) {
                    $bd[$i] = "'$binding'";
                }
            }
        }
        // Insert bindings into query
        $query = str_replace(array('%', '?'), array('%%', '%s'), $sql);

        $query = vsprintf($query, $bd);

        // Save the query to file
        $logFile = fopen(
            storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '_query.log'),
            'a+'
        );
        fwrite($logFile, date('Y-m-d H:i:s') . ': ' . $query . PHP_EOL);
        fclose($logFile);
    }

    /**
     * Get Repo Namespace or filename for current model
     * @method  getRepo
     * @author  Hardiyansyah
     * @param   string $class
     * @return  string                  repository name
     */
    public static function getRepo($class)
    {

        return trim(config('consyst.root_namespace') . '\ ') . $class;
    }

    /**
     * Format Nominal into Indonesian rupiah
     * @method  formatRupiah
     * @author  Hardiyansyah
     * @param decimal $nominal
     * @param integer $simbol
     * @return  string
     */
    public static function formatRupiah($nominal, $simbol = false)
    {
        if ($simbol) {
            return "Rp " . number_format($nominal, 0, '', '.');
        } else {
            return number_format($nominal, 0, '', '.');
        }

    }

    /**
     * Get User from Session
     * @method  getSessionUserLogin
     * @author  Hardiyansyah
     * @return  array
     */
    public static function getSessionUserLogin()
    {
        $rtn = [
            'id' => Crypt::decrypt(Session::get('secret.id')),
            'nama' => strtoupper(Session::get('secret.name')),
            'cabang' => Crypt::decrypt(Session::get('secret.kode_cabang')),
        ];
        return $rtn;

    }

    public static function getModels($models)
    {
        return trim(config('consyst.root_namespace') . '\Models\ ') . $models;
    }

    /**
     * conver date to format Y-m-d
     * @method convertDate
     * @author Hardiyansyah
     * @param  date $date date
     * @param  string $format date format default d/m/y
     * @return string|date          string date with Y-m-d format
     */
    public static function convertDate($date, $format = 'd/m/Y')
    {
        if ((self::checkDate($date)) or (self::checkDate($date, 'd-m-Y'))) {
            return Carbon::createFromFormat($format, $date)->toDateString();
        } elseif ((self::checkDate($date, 'm/d/Y')) or (self::checkDate($date, 'm-d-Y'))) {
            return Carbon::createFromFormat('m/d/Y', $date)->toDateString();
        } elseif ((self::checkDate($date, 'Y/m/d')) or (self::checkDate($date, 'Y-m-d'))) {
            return $date;
        } else {
            return Carbon::now(); // invalid date set to now
        }
    }

    /**
     * Check date format
     * @method checkDate
     * @author Hardiyansyah
     * @param  date $date date
     * @param  string $format date format default d/m/y
     * @return bool               return true if format d/m/y  and false if format using something else
     */
    public static function checkDate($date, $format = 'd/m/Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * check if string empty or null
     * @method IsNothing
     * @author Hardiyansyah
     * @param  string|int $value ape bae masukin aja :D
     * @return bool                              true if nothing and flase if has something on it
     */
    public static function IsNothing($value)
    {
        return (!isset($value) || trim($value) === '');
    }

    /**
     * Print array with pre html tag for debuging reason
     * @method arrayBeauty
     * @author Hardiyansyah
     * @param  array|string $array array or string that want to prety print
     */
    public static function arrayBeauty($array)
    {
        if (is_array($array)) {
            echo('<pre>');
            print_r($array);
            echo('</pre>');
        } else {
            echo $array;
        }

    }
    public static function generateActionButtonExAction($button)
    {
        $rtn = '<div class="btn-group pull-right">';
        $rtn .= '<button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>';
        $rtn .= '<ul class="dropdown-menu pull-right" role="menu">';
        foreach ($button as $value) {

            $rtn .= ConsystHelper::generateEditButtonAction($value);

        }
        $rtn .= '</ul>';
        $rtn .= '</div>';
        return $rtn;

    }

    public static function generateEditButtonAction($param)
    {

        $rtn = ' <li>';
        $url = $param['url'];
        if (empty($url)) {
            return '';
        }

        $button = '<a href="#" data="' . $url . '" id="?pre_id-' . $param['id'] . '" onclick=?onclick("#?pre_id-' . $param['id'] . '"); ><i class="?icon"  data-toggle="tooltip" title="?title"></i> ?title</a>';
        $buffer = str_replace("?type", $param['button_type'], $button);
        $buffer = str_replace("?class", $param['button_class'], $buffer);
        $buffer = str_replace("?icon", $param['icon'], $buffer);
        $buffer = str_replace("?onclick", $param['on_click'], $buffer);
        $buffer = str_replace("?title", $param['title'], $buffer);
        $buffer = str_replace("?pre_id", $param['id_prefix'], $buffer);

        // 1. url
        // 2. icon
        // 3. caption - on halt
        // 4. button_class
        // 5. button_type
        $rtn .= $buffer;
        $rtn .= '</li>';

        return $rtn;
    }

    public static function generateEditDPButton($do=true, $array)
    {
        if($do == true )
        {
            $dp = '<div class="btn-group pull-right">
                <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    Action <i class="fa fa-angle-down"></i>
                </button>';
                    $count = count($array);
                    if($count > 0 )
                    {
                        $dp.='<ul class="dropdown-menu pull-right">';
                            for( $i=0; $i <= ($count - 1); $i++ ) {

                                $element1 = isset($array[$i]['class']) ? $array[$i]['class'] : "";
                                $element2 = isset($array[$i]['id']) ? $array[$i]['id'] : "";
                                $element3 = isset($array[$i]['icon']) ? $array[$i]['icon'] : "";
                                $element4 = isset($array[$i]['title']) ? $array[$i]['title'] : "";
                                $element5 = isset($array[$i]['onClick']) ? $array[$i]['onClick'] : "";

                                $dp.='<li>
                                        <a onclick="'.$element5.'(this.id)" 
                                            class="'.$element1.'" id="'.$element2.'">
                                        <i class="'.$element3.'"></i> '.$element4.' </a>
                                    </li>';
                            }
                        $dp.='</ul>';
                    }
            $dp.='</div>';
            return $dp;
        }
    }

    public static function isNullInput($var,$rtn='')
    {
        $buffer = isset($var) ? $var : $rtn;
        $buffer = empty($buffer)?$rtn :$buffer;
        $buffer = is_null($buffer)? $rtn:$buffer;
        return $buffer;
    }

    public static function generateUrlAction($param)
    {

        $rtn = '';
        $url = $param['url'];
        if (empty($url)) {
            return '';
        }
        $button = '<a href="#" data="' . $url . '" id="?pre_id-' . $param['id'] . '" onclick=?onclick("#?pre_id-' . $param['id'] . '"); > ?title</a>';
        $buffer = str_replace("?onclick", 'ajaxEdit', $button);
        $buffer = str_replace("?title", $param['title'], $buffer);
        $buffer = str_replace("?pre_id", $param['id_prefix'], $buffer);

        $rtn .= $buffer;
        $rtn .= '';

        return $rtn;
    }

    /**
     * [deleteCompleteTask Description]
     * @method  deleteCompleteTask
     * @author  Hardiyansyah
     * @return  int
     */
    public static  function deleteCompleteTask()
    {
       return DB::delete('delete from sys_tr_progress where status=99');

    }

    /**
     * [isWindows Description]
     * @method  isWindows
     * @author  Hardiyansyah
     * @return  int
     */
    public static function isWindows()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * [asyncProgExec Description]
     * @method  asyncProgExec
     * @author  Hardiyansyah
     * @param $command
     * @return  Process
     */
    public static function asyncProgExec($command)
    {
        if (self::isWindows()==1)
        {
            $proc = new Process('php artisan '.$command);
            
        }else{
            $proc = new Process('artisan '.$command.'> /dev/null 2>&1 & echo $!');
        }
            $proc->setTimeout(60);
            $proc->setIdleTimeout(60);
            $proc->setWorkingDirectory(base_path());
            $proc->run();
            //return $proc;
        
    }

    /**
     * [killConnectionParstial Description]
     * @method  killConnectionParstial
     * @author  Hardiyansyah
     */
    public static function killConnectionParstial()
    {
        ignore_user_abort(true);//avoid apache to kill the php running
        ob_start();//start buffer output

        //echo "show something to user";
        //session_write_close();//close session file on server side to avoid blocking other requests

        header("Content-Encoding: none");//send header to avoid the browser side to take content as gzip format
        header("Content-Length: ".ob_get_length());//send length header
        header("Connection: close");//or redirect to some url: header('Location: http://www.google.com');
        ob_end_flush();flush();//really send content, can't change the order:1.ob buffer to normal buffer, 2.normal buffer to output

        //continue do something on server side
        ob_start();
        sleep(5);//the user won't wait for the 5 seconds
        echo 'for diyism';//user can't see this
        file_put_contents('/tmp/process.log', ob_get_contents());
        ob_end_clean();
    }

    public static function utf8_encode_deep(&$input) {
        if (is_string($input)) {
            $input = utf8_encode($input);
        } else if (is_array($input)) {
            foreach ($input as &$value) {
                self::utf8_encode_deep($value);
            }

            unset($value);
        } else if (is_object($input)) {
            $vars = array_keys(get_object_vars($input));

            foreach ($vars as $var) {
                self::utf8_encode_deep($input->$var);
            }
        }
    }

    /**
     * @methode IsNullOrEmptyString
     * @author  Hardiyansyah
     *
     * @param $str
     *
     * @return bool
     */
    public static function IsNullOrEmptyString($str){
        return (!isset($str) || trim($str)==='');
    }

    /**
     * @methode is_tab_no_baru
     * @author  Hardiyansyah
     *
     * @param $norek
     *
     * @return int
     */
    public static function is_tab_no_baru($norek)
    {

        $ret = substr(trim($norek), 3,2);    // returns "f"

        if($ret==11 || $ret==13)
        {
            return 0;
        }else{
            return 1;
        }


    }
    public static function removeNewLine($str)
    {
        return trim(preg_replace('/\s\s+/', ' ', $str));
    }
    /**
     * Encode array from latin1 to utf8 recursively
     * @param $dat
     * @return array|string
     */
    public static function convert_from_latin1_to_utf8_recursively($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        } elseif (is_array($dat)) {
            $ret = [];
            foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

            return $ret;
        } elseif (is_object($dat)) {
            foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

            return $dat;
        } else {
            return $dat;
        }
    }

    /**
     * @author  Hardiyansyah
     * @param $tanggal = format date yyyy-mm-dd
     * @return string delimiter ;
     */
    public static function selisihTanggalIndo($tanggal){
        $dmy=Carbon::parse($tanggal)->format('d-m-Y');
        $tgl=explode("-",$dmy);
        $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
        $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
        $sshari=$cek_jmlhr1-$tgl['0'];
        $ssbln=12-$tgl['1']-1;
        $hari=0;
        $bulan=0;
        $tahun=0;

        if($sshari+date('d')>=$cek_jmlhr2){
            $bulan=1;
            $hari=$sshari+date('d')-$cek_jmlhr2;
        }else{
            $hari=$sshari+date('d');
        }
        if($ssbln+date('m')+$bulan>=12){
            $bulan=($ssbln+date('m')+$bulan)-12;
            $tahun=date('Y')-$tgl['2'];
        }else{
            $bulan=($ssbln+date('m')+$bulan);
            $tahun=(date('Y')-$tgl['2'])-1;
        }

        $selisih=$tahun.";".$bulan;
        return $selisih;
    }
    public static  function setButtonStatus($status)
    {
        if($status=='0')
        {
            return "btn btn-default";
        }else{
            return "btn btn-primary";
        }
    }
    public static  function setButtonStatusCaption($status)
    {
        if($status=='0')
        {
            return "OFF";
        }else{
            return "RUNNING";
        }
    }

    /**
     * @author  Hardiyansyah
     * @param $array 
     */
    public static function validateExtract($array)
    {
        if(count($array) > 0) {
            $message = null;
            for($i=0; $i <= count($array) - 1; $i++) {
                $message .= $array[$i].'<br>';
            }
        }
        return rtrim($message,",");
    }
    public static function convertDays($hari)
    {
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
     
            case 'Mon':			
                $hari_ini = "Senin";
            break;
     
            case 'Tue':
                $hari_ini = "Selasa";
            break;
     
            case 'Wed':
                $hari_ini = "Rabu";
            break;
     
            case 'Thu':
                $hari_ini = "Kamis";
            break;
     
            case 'Fri':
                $hari_ini = "Jumat";
            break;
     
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
        return $hari_ini;
    }
    
}
