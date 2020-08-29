<?php

namespace App\Http\Controllers\midd;

use App\Http\Controllers\Controller;
use Services\Injection;

class Paper extends Controller
{

    public static function newPaper($tanggal,$pukul,$tema) {
        return
        '<h1>LEMBAGA JURUSAN XX</h1><h3>Hasil Notula Rapat</h3><hr>'.
        '<div class="top"><table><tr> <td><strong>Tanggal </strong></td>'.
        '<td><strong> : </strong></td>'.
        '<td><strong>'.$tanggal.'</strong></td></tr><tr>'.
        '<td><strong>Pukul</strong></td>'.
        '<td><strong> : </strong></td>'.
        '<td><strong>'.$pukul.'</strong></td></tr><tr>'.
        '<td><strong>Tema</strong></td>'.
        '<td><strong> : </strong></td>'.
        '<td><strong>'.$tema.'</strong></td></tr></table></div>'.
        '<div class="peserta-data">'.
        '<div class="table-id"><strong>Data peserta : </strong></div>'.
        '<div class="rp-table-container"><table class="rp-table">'.
        '<thead><tr><td>No.</td><td>Nama Lengkap</td><td>Nomor Induk Dosen</td>'.
        '<td>Status</td><td>Total Hadir</td><td>Total Izin</td><td>Total Absen</td>'.
        '</tr></thead><tbody>';
    }

    public static function addData($id_rapat) {
        $peserta    = Injection::getUsers();
        $index      = 1;
        $render_    = '';
        foreach ($peserta as $item) {
            $userAtt = Injection::getRapatAttributes();
            $render_ = $render_.
                '<tr><td>'.$index.'. </td>'.
                '<td>&nbsp;'.$item->name.'</td>'.
                '<td>&nbsp;'.$item->nid.'</td>';
            $status = Injection::userRapatStatus($item->nid,$id_rapat);
            if ($status == 1)
                $render_ = $render_.'<td>hadir</td>';
            elseif ($status == 2)
                $render_ = $render_.'<td>izin</td>';
            else
                $render_ = $render_.'<td class="danger">absen</td>';
            $render_ = $render_.
                '<td>'.$userAtt[0].'</td>'.
                '<td>'.$userAtt[1].'</td>';
            if ($userAtt[2] > 2)
                $render_ = $render_.'<td class="danger">'.$userAtt[2].'</td>';
            else
                $render_ = $render_.'<td>'.$userAtt[2].'</td>';
            $render_ = $render_.'</tr>';
            $index += 1;
        }
        return $render_;
    }

    public static function closePaper($paper) {
        return
            '<div class="break">'.$paper.
            '</tbody></table></div></div></div>';
    }

}
