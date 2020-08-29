<?php
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Http\Controllers\midd\Paper;
use App\Http\Controllers\midd\Qr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Services\Injection;

class AppController extends Controller
{

    public function read_code(Request $request) {
        $result = Qr::verify($request->code);
        if ($result[0]) {
            return response()->json(array('result'=>'1','nid'=>$result[1]),200);
        }
        return response()->json(array('result'=>'0'),200);
    }

    public function init_scanner (Request $request) {
        if (Qr::verifyScanner($request->code)) {
            return response()->json(array('result'=>'1'),200);
        }
        return response()->json(array('result'=>'0'),200);
    }

    public function update_code() {
        if (Injection::isHadir(Auth::user()->id)) {
            return response()->json(array('status'=>Injection::isOnRapat(),'hadir'=>'1'),200);
        }
        return response()->json(array('status'=>Injection::isOnRapat(),'hadir'=>'0','qr_code'=>Qr::update(Auth::user()->nid)),200);
    }

    public function update_data_rapat_terkini() {
        $render_ = '';
        $users = Injection::getUsers();
        $temp1  = Injection::getRapatAttributes();
        foreach ($users as $user) {
            $render_ =
                $render_.'<tr>'
                .'<td class="border-top-0"><div class="d-flex no-block align-items-center"><div class="">'
                .'<img src="'.url('storage/'.$user->profile_url).'" alt="user" class="rounded-circle" width="60" height="60" /></div></div></td>'
                .'<td class="border-top-0 text-muted px-2 py-4 font-14">'.$user->name.'</td>'
                .'<td class="border-top-0 text-muted px-2 py-4 font-14">'.$user->nid.'</td>';
            if (Injection::isHadir($user->id)) {
                $render_ = $render_
                    .'<td class="border-top-0 text-muted px-2 py-4 font-21 text-center" style="font-size: 14pt">'
                    .'<span class="text-success">hadir</span></td>';
            }
            elseif (Injection::isIzin($user->id)) {
                $render_ = $render_
                    .'<td class="border-top-0 text-muted px-2 py-4 font-21 text-center" style="font-size: 14pt">izin</td>';
            }
            else {
                $render_ = $render_
                    .'<td class="border-top-0 text-muted px-2 py-4 font-21 text-center" style="font-size: 14pt">'
                    .'<form action="'.url('post_set_izin').'" method="post">'
                    .'<input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" name="id" value="'.$user->id.'">'
                    .'<span class="text-danger">absen</span>'
                    .'<input type="submit" class="btn btn-info" value="tandai izin" style="margin-left: 1rem"></form></td>';
            }
            $render_ = $render_.'</tr>';
        }

        return response()->json(array(
            'html'=>$render_,
            'status'=>'1',
            'total_rapat'=>$temp1[0],
            'total_hadir'=>$temp1[1],
            'total_izin'=>$temp1[2],
            'total_absen'=>$temp1[3],
            ),200);
    }

    public function check_rapat() {
        return response()->json(array('status'=>Injection::isOnRapat()),200);
    }

    public function check_admin_rapat() {
        $temp   = Injection::isOnRapat();
        $temp1  = Injection::getRapatAttributes();
        if ($temp == '1') {
            return $this->update_data_rapat_terkini();
        }
        return response()->json(
            array(
                'status'=>$temp,
                'total_rapat'=>$temp1[0],
                'total_hadir'=>$temp1[1],
                'total_izin'=>$temp1[2],
                'total_absen'=>$temp1[3],
            ),
            200
        );
    }

    public function newRapat(Request $request) {
        $id = Injection::createRapat($request);
        Injection::setAbsenAll($id);
        Qr::setScannerCode();
        return redirect()->back();
    }

    public function endRapat() {
        Injection::endRapat();
        return $this->routeHome();
    }

    public function set_izin(Request $request) {
        Injection::setIzin($request->id);
        return redirect()->back();
    }

    public function routeLogin() {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $response = Injection::getRapat();
                return view('page.dashboard',compact('response'));
            }
            else {
                return view('page.user');
            }
        }
        else {
            return view('page.login');
        }
    }

    public function routeRapatTerkini() {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                if (Injection::isOnRapat()) {
                    return view('page.rapat-terkini');
                }
                else {
                    $response = Injection::getRapat();
                    return view('page.dashboard',compact('response'));
                }
            }
            else {
                return view('page.user');
            }
        }
        else {
            return view('page.login');
        }
    }

    public function rapatDetail($id) {
        $rapat      = Injection::getRapat_($id);
        $tanggal    = $rapat->tanggal;
        $waktu      = $rapat->mulai.' - '.$rapat->selesai.' WIB';
        $data       = Injection::getUsers();
        $response   = array($id,$tanggal,$waktu,$data);

        return view('page.rapat-detail',compact('response'));
    }

    public function routeDataPengguna() {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $response = Injection::getUsers();
                return view('page.daftar-user',compact('response'));
            }
            else {
                return view('page.user');
            }
        }
        else {
            return view('page.login');
        }
    }

    public function routeScanner() {
        if (Injection::isOnRapat()) {
            return view('page.scanner');
        }
        return redirect(url('/login'));
    }

    public function routeScannerQR() {
        if (Auth::check()) {
            if (Injection::isOnRapat()) {
                $response = Qr::getScannerCode();
                return view('page.scanner-qr-code',compact('response'));
            }
            $response = Injection::getRapat();
            return view('page.dashboard',compact('response'));

        }

        return view('page.login');
    }

    public function routeLaporan($id) {
        $rapat  = Injection::getRapat_($id);
        $pukul  = $rapat->mulai .' - '.$rapat->selesai.' WIB';
        $report = Paper::newPaper($rapat->tanggal,$pukul,$rapat->tema);
        $report = $report.Paper::addData($rapat->id);
        $report = Paper::closePaper($report);

        return view('page.laporan',compact('report'));
    }

    public function routeArsip() {
        $coll   = Injection::getRapats();
        $arcv   = '';
        foreach ($coll as $rapat) {
            $pukul  = $rapat->mulai .' - '.$rapat->selesai.' WIB';
            $report = Paper::newPaper($rapat->tanggal,$pukul,$rapat->tema);
            $report = $report.Paper::addData($rapat->id);
            $report = Paper::closePaper($report);
            $arcv   = $arcv.$report;
        }
        $report = $arcv;
        Injection::clearRapat();

        return view('page.laporan',compact('report'));
    }

    public function routeHome() {
        return $this->routeLogin();
    }

}
