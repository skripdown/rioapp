<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace Services;

use App\Rapat;
use App\User;
use Illuminate\Support\Facades\DB;

class Injection {

    public static function isOnRapat() {
        return (DB::table('rapats')->where('status','1')->get()->count()).'';
    }

    public static function getRapat() {
        return DB::table('rapats')->where('status','0')->get();
    }

    public static function getRapats() {
        return Rapat::all();
    }

    public static function getRapat_($id) {
        return DB::table('rapats')->where('id',$id)->first();
    }

    public static function getCurrentRapat() {
        return DB::table('rapats')->where('status','1')->first();
    }

    public static function getRapatAttributes() {
        $tot_rapat  = (DB::table('rapats')->where('status','0')->get()->count()).'';
        $temp       = DB::select('SELECT SUM(hadir), SUM(izin), SUM(absen) FROM rapats WHERE status = "0"');
        if ($tot_rapat == '0') {
            return array($tot_rapat, 0, 0, 0);
        }
        return array($tot_rapat, $temp->hadir, $temp->izin, $temp->absen);
    }

    public static function getUsers() {
        return DB::table('users')->where('role','user')->get();
    }

    public static function getUser($id) {
        return User::find($id);
    }

    public static function createRapat($request) {
        $year  = date("Y");
        $month = date("m");
        $day   = date("d");
        $start = date("h:i");

        if ($month == '01') $month = 'januari';
        elseif ($month == '02') $month = 'februari';
        elseif ($month == '03') $month = 'maret';
        elseif ($month == '04') $month = 'april';
        elseif ($month == '05') $month = 'mei';
        elseif ($month == '06') $month = 'juni';
        elseif ($month == '07') $month = 'juli';
        elseif ($month == '08') $month = 'agustus';
        elseif ($month == '09') $month = 'september';
        elseif ($month == '10') $month = 'oktober';
        elseif ($month == '11') $month = 'november';
        elseif ($month == '12') $month = 'desember';

        $temp = date("YYYY-MM-DD");
        $temp = strtotime($temp);
        $hari = date("l",$temp);

        if ($hari == 'monday') $hari = 'senin';
        elseif ($hari == 'tuesday') $hari = 'selasa';
        elseif ($hari == 'wednesday') $hari = 'rabu';
        elseif ($hari == 'thursday') $hari = 'kamis';
        elseif ($hari == 'friday') $hari = 'jumat';
        elseif ($hari == 'saturday') $hari = 'sabtu';
        elseif ($hari == 'sunday') $hari = 'minggu';


        $rapat = new Rapat();
        $rapat->tema    = $request->tema;
        $rapat->tanggal = $hari.', '.$day.' '.$month.' '.$year;
        $rapat->mulai   = $start;
        $rapat->status  = '1';
        $rapat->absen   = DB::table('users')->where('role','user')->get()->count();

        $rapat->save();

        return $rapat->id;
    }

    public static function endRapat() {
        $id    = self::getCurrentRapat()->id;
        $rapat = Rapat::find($id);
        $rapat->selesai = date("h:i");
        $rapat->status = '0';
        $rapat->save();
    }

    public static function clearRapat() {
        DB::table('rapats')->delete();
        DB::table('hadir_rapat')->delete();
        DB::table('izin_rapat')->delete();
        DB::table('absen_rapat')->delete();
    }

    public static function setAbsenAll($id_rapat) {
        $users = self::getUsers();
        foreach ($users as $user) {
            DB::table('absen_rapat')->insert([
                'rapat' => $id_rapat,
                'peserta' => ''.$user->nid,
            ]);
        }
    }

    public static function setIzin( $id_user) {
        $user = self::getUser($id_user);
        $rapat = self::getCurrentRapat();
        DB::table('izin_rapat')->insert([
            'rapat' => $rapat->id,
            'peserta' => $user->nid,
        ]);
        DB::table('absen_rapat')
            ->where('peserta',$user->nid)
            ->where('rapat',$rapat->id)
            ->delete();
    }

    public static function setHadir( $id_user) {
        $user = self::getUser($id_user);
        $rapat = self::getCurrentRapat();
        $absen_tbl = DB::table('absen_rapat')->where('peserta',$user->nid)->where('rapat',$rapat->id)->first();

        DB::table('hadir_rapat')->insert([
            'rapat' => $rapat->id,
            'peserta' => $user->nid,
        ]);

        if ($absen_tbl != null) {
            DB::table('absen_rapat')
                ->where('peserta',$user->nid)
                ->where('rapat',$rapat->id)
                ->delete();
        }
        else {
            DB::table('izin_rapat')
                ->where('peserta',$user->nid)
                ->where('rapat',$rapat->id)
                ->delete();
        }
    }

    public static function isHadir($id_user) {
        $nid        = self::getUser($id_user)->nid;
        $rapat_id   = self::getCurrentRapat();
        if ($rapat_id != null) {
            $temp   = DB::table('hadir_rapat')
                ->where('rapat',$rapat_id->id)
                ->where('peserta',$nid)
                ->get()->count();

            return $temp > 0;
        }
        else
            return false;
    }

    public static function isIzin($id_user) {
        $nid        = self::getUser($id_user)->nid;
        $rapat_id   = self::getCurrentRapat();
        if ($rapat_id != null) {
            $temp   = DB::table('izin_rapat')
                ->where('rapat',$rapat_id->id)
                ->where('peserta',$nid)
                ->get()->count();

            return $temp > 0;
        }
        else
            return false;
    }

    public static function wasHadis($id_user, $id_rapat) {
        $user = self::getUser($id_user)->nid;
        $count = DB::table('hadir_rapat')
            ->where('nid',$user)
            ->where('rapat',$id_rapat)
            ->get()->count();

        return $count > 0;
    }

    public static function wasIzin($id_user, $id_rapat) {
        $user = self::getUser($id_user)->nid;
        $count = DB::table('izin_rapat')
            ->where('nid',$user)
            ->where('rapat',$id_rapat)
            ->get()->count();

        return $count > 0;
    }

    public static function userRapatStatus($id_user,$id_rapat) {
        if (DB::table('hadir_rapat')
                ->where('nid',$id_user->nid)
                ->where('rapat',$id_rapat)->get()->count() > 0)
                return 1;

        if (DB::table('izin_rapat')
                ->where('nid',$id_user->nid)
                ->where('rapat',$id_rapat)->get()->count() > 0)
                return 2;
        return 0;
    }

    public static function getUserRapatAtt($id) {
        $user = self::getUser($id);
        $user = $user->nid;
        $tot_hadir  = DB::table('hadir_rapat')->where('nid',$user)->get()->count();
        $tot_izin   = DB::table('izin_rapat')->where('nid',$user)->get()->count();
        $tot_absen  = DB::table('absen_rapat')->where('nid',$user)->get()->count();
        return array($tot_hadir,$tot_izin,$tot_absen);
    }

}
