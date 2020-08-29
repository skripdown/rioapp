<?php

namespace App\Http\Controllers\midd;

use App\Http\Controllers\Controller;
use App\QR_dosen;
use App\QR_scanner;
use Illuminate\Support\Facades\DB;
use Services\Injection;

class Qr extends Controller
{

    public static function verify($qr_code) {
        $code_data = DB::table('q_r_dosens')->where('qr',$qr_code)->first();
        if ($code_data != null) {
            $user = DB::table('users')->where('nid',$code_data->nid)->first();
            Injection::setHadir($user->id);
            return array(true,$code_data->nid);
        }
        return array(false);
    }

    public static function update($id) {
        $nid = ''.$id.rand(100,999);
        $code_data = DB::table('q_r_dosens')->where('nid',$id.'')->first();
        $code_data = QR_dosen::find($code_data->id);
        $code_data->qr = $nid;
        $code_data->save();

        return $nid;
    }

    public static function verifyScanner($qr_code) {
        $scanner = QR_scanner::find(1);
        return $qr_code == $scanner->qr;
    }

    public static function setScannerCode() {
        $scanner = QR_scanner::find(1);
        $scanner->qr = str_shuffle('abcdefghkl1234567');
        $scanner->save();
    }

    public static function getScannerCode() {
        $scanner = QR_scanner::find(1);
        return $scanner->qr;
    }

}
