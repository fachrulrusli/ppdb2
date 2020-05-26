<?php

namespace App\Http;

use Carbon\Carbon;

class ApiHelper
{
    /**
     * Api response.
     *
     * @method respond
     *
     * @author Hardiyansyah
     *
     * @param object|array $data
     * @param int|string   $statusCode
     *
     * @return json
     */
    public static function respond($data, $statusCode)
    {
        $rtn = [
            'data' => $data,
            'status_code' => $statusCode,
        ];

        return response()->json($rtn, $statusCode);
    }
    /**
     * Api response.
     *
     * @method respondStatus
     *
     * @author Hardiyansyah
     *
     * @param object|array $data
     * @param int|string   $statusCode
     *
     * @return json
     */
    public static function respondStatus($msg,$statusCode)
    {
        $rtn = [
            'msg' => $msg,
            'status_code' => $statusCode,
        ];

        return response()->json($rtn, $statusCode);
    }

    /**
     * Api response.
     *
     * @method respond
     *
     * @author Hardiyansyah
     *
     * @param object|array $data
     * @param int|string   $statusCode
     *
     * @return json
     */
    public static function respondData($data)
    {


        return response()->json($data);
    }
    /**
     * Api error Response.
     *
     * @method respondWithError
     *
     * @author Hardiyansyah
     *
     * @param string $message
     * @param string $title
     *
     * @return json
     */
    public static function respondWithError($message, $title)
    {
        $rtn = [
            'error' => $message,
            'title' => isset($title) ? $title : 'Error',
        ];

        return response()->json($rtn);
    }
    /**
     * Format Nominal into Indonesian rupiah.
     *
     * @method  formatRupiah
     *
     * @author  Hardiyansyah
     *
     * @param decimal $nominal
     * @param boolean $simbol
     *
     * @return string
     */
    public static function formatRupiah($nominal, $simbol = false)
    {
        if ($simbol) {
            return 'Rp '.number_format($nominal, 0, '', '.');
        } else {
            return number_format($nominal, 0, '', '.');
        }
    }
    /**
     * Format tanggal indo.
     *
     * @method formatTanggalIndo
     *
     * @author Hardiyansyah
     *
     * @param date|string $value
     *
     * @return string
     */
    public static function formatTanggalIndo($value)
    {
        if($value)
        {
            if (strpos($value, '.') > 0) {
                $trimedvalue = substr($value, 0, strpos($value, '.'));
            } else {
                $trimedvalue = $value;
            }

            $dt = Carbon::createFromFormat('Y-m-d H:i:s', $trimedvalue);

            return $dt->formatLocalized('%d %B %Y');
        }else{
            return "";
        }

    }
    /**
     * Format tanggal indo untuk mutasi mobile.
     *
     * @method formatTanggalIndo
     *
     * @author Hardiyansyah
     *
     * @param date|string $value
     *
     * @return string
     */
    public static function formatTanggalIndoMutasi($value)
    {
        if (strpos($value, '.') > 0) {
            $trimedvalue = substr($value, 0, strpos($value, '.'));
        } else {
            $trimedvalue = $value;
        }

        $dt = Carbon::createFromFormat('Y-m-d H:i:s', $trimedvalue);

        return $dt->formatLocalized('%d-%m-%Y');
    }
    /**
     * Initsialisasi date.
     *
     * @method initDate
     *
     * @author Hardiyansyah
     *
     * @param date $date
     *
     * @return string
     */
    public static function initDate($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date);
    }
    /**
     * Reformate or expose date to Database format.
     *
     * @method ExposeDate
     *
     * @author Hardiyansyah
     *
     * @param date|string $date
     */
    public static function ExposeDate($date)
    {
        return $date->format('Y-m-d');
    }


    public static function respondRecordNotFound()
    {
         return response('@ntW4',500);
    }


    // public static function respondNotFound($message = 'Not Found')
    // {
    //     return $this->setStatusCode(404)->respondWithError($message);
    // }
    //
    // public static function respondInternalError($message = 'Internal Error')
    // {
    //     return $this->setStatusCode(500)->respondWithError($message);
    // }
    //
    // public static function respondUnathourize($message = 'Login Failed username or password doesnt match')
    // {
    //     return $this->setStatusCode(401)->respondWithError($message);
    // }
}
