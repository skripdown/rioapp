@extends('html.admin')


@section('title')
    Detail Rapat
@endsection

@section('breadcrumb')
    @php
        if(!empty($response)){
            $id         = $response[0];
            $tanggal    = $response[1];
            $waktu      = $response[2];
            $data       = $response[3];
        }
    @endphp
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Rapat {{$tanggal.' '.$waktu}}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{url('/rapat/'.$id)}}">Detail Halaman Rapat</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <p class="card-text">
                                Membuat Laporan Hasil Rapat
                            </p>
                        </div>
                        <div class="col-2">
                            <a href="{{url('/laporan/'.$id)}}" target="_blank" class="btn btn-primary float-right btn-info">cetak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                            <tr class="border-0">
                                <th class="border-0 font-14 font-weight-medium text-muted"></th>
                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Nama</th>
                                <th class="border-0 font-14 font-weight-medium text-muted">NID</th>
                                <th class="border-0 font-14 font-weight-medium text-muted text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $datum)
                                    <tr>
                                        <td class="border-top-0">
                                            <div class="d-flex no-block align-items-center">
                                                <div>
                                                    <img src="{{asset('storage/'.$datum->profile_url)}}" alt="photo" class="rounded-circle" width="60" height="60">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{$datum->name}}</td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{$datum->nid}}</td>
                                        @if (\Services\Injection::wasHadis($datum->id,$id))
                                            <td class="border-top-0 text-muted px-2 py-4 font-21 text-center" style="font-size: 14pt">
                                                <span class="text-success">hadir</span>
                                            </td>
                                        @elseif(\Services\Injection::wasIzin($datum->id,$id))
                                            <td class="border-top-0 text-muted px-2 py-4 font-21 text-center" style="font-size: 14pt">izin</td>
                                        @else
                                            <td class="border-top-0 text-muted px-2 py-4 font-21 text-center" style="font-size: 14pt">
                                                <span class="text-danger">absen</span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')

@endsection
