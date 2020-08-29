@extends('html.admin')


@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{url('/home')}}">Beranda administrator notulen rapat</a>
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
                <div id="on-rapat-exist" class="card-body d-none">
                    <div id="opt-rapat-baru" class="row">
                        <div class="col-10">
                            <p class="card-text">
                                Sedang sedang berjalan.
                            </p>
                        </div>
                        <div class="col-2">
                            <a href="javascript:void(0)" class="btn btn-primary float-right opacity-7">Buat</a>
                        </div>
                    </div>
                </div>
                <div id="no-form-container" class="card-body">
                    <div id="opt-rapat-baru" class="row">
                        <div class="col-10">
                            <p class="card-text">
                                Membuat absensi agenda rapat baru.
                            </p>
                        </div>
                        <div class="col-2">
                            <a href="javascript:void(0)" id="btn-baru" target="_blank" class="btn btn-primary float-right">Buat</a>
                        </div>
                    </div>
                </div>
                <div id="form-container" class="card-body d-none">
                    <h4 class="card-title">Tema Rapat</h4>
                    <div class="row">
                        <form class="col-12" method="post" action="{{url('post_create_rapat')}}">
                            @csrf
                            <label for="nametext" class="d-none"></label>
                            <input type="text" class="form-control" id="nametext" aria-describedby="name"
                                   placeholder="tema rapat" name="tema">
                            <small id="name" class="form-text text-muted">Membuat absensi rapat baru</small>
                            <a href="javascript:void(0)" id="btn-batal" class="btn btn-danger float-right ml-4">Batal</a>
                            <input type="submit" class="btn btn-primary float-right" value="buat">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <p class="card-text">
                                Mengarsipkan data riwayat rapat keseluruhan.
                            </p>
                        </div>
                        <div class="col-2">
                            <a href="{{url('/arsip')}}"  class="btn btn-primary float-right btn-danger">Arsip</a>
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
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-cyan text-center">
                                    <h1 id="total_rapat" class="font-light text-white">0</h1>
                                    <h6 class="text-white">Total Rapat</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-success text-center">
                                    <h1 id="total_hadir" class="font-light text-white">0</h1>
                                    <h6 class="text-white">Total Hadir</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-warning text-center">
                                    <h1 id="total_izin" class="font-light text-white">0</h1>
                                    <h6 class="text-white">Total Izin</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-danger text-center">
                                    <h1 id="total_absen" class="font-light text-white">0</h1>
                                    <h6 class="text-white">Total Absen</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered display no-wrap">
                            <thead>
                            <tr>
                                <th>Tema</th>
                                <th>Tanggal / Pukul</th>
                                <th>Hadir</th>
                                <th>Izin</th>
                                <th>Absen</th>
                                <th style="width: 100px">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($response as $item)
                                <tr>
                                    <td>{{$item->tema}}</td>
                                    <td>{{$item->tanggal}} / {{$item->mulai}}-{{$item->selesai}} WIB</td>
                                    <td>{{$item->hadir}} orang</td>
                                    <td>{{$item->izin}} orang</td>
                                    <td class="text-danger">{{$item->absen}} orang</td>
                                    <td class="text-center">
                                        <a href="{{url('/rapat/'.$item->id)}}" target="_blank" class="btn btn-primary btn-sm">Detail</a>
                                        <a href="{{url('/laporan/'.$item->id)}}" target="_blank" class="btn btn-primary btn-sm">Laporan</a>
                                    </td>
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
    const form_     = $('#form-container').get(0);
    const no_form   = $('#no-form-container').get(0);
    const btn_baru  = $('#btn-baru').get(0);
    const btn_batal = $('#btn-batal').get(0);
    $(btn_baru).click(()=>{
        $(form_).removeClass('d-none');
        $(no_form).addClass('d-none');
    });
    $(btn_batal).click(()=>{
        $(no_form).removeClass('d-none');
        $(form_).addClass('d-none');
    });
@endsection
