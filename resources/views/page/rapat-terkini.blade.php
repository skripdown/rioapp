@extends('html.admin')


@section('title')
    Rapat terkini
@endsection

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Rapat Terkini</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{url('/rapat_terkini')}}">Halaman Notula Rapat Sekarang</a>
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
                                Menutup agenda rapat sekarang.
                            </p>
                        </div>
                        <div class="col-2">
                            <form action="{{url('post_end_rapat')}}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-primary float-right btn-danger" value="Tutup">
                            </form>
                        </div>
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
                                Melihat kode QR scanner
                            </p>
                        </div>
                        <div class="col-2">
                            <a href="{{url('/show_qr_scanner')}}" class="btn btn-primary float-right btn-info">Putus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div id="rapat-terkini-table-container" class="card-body">
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
                            <tbody id="rapat-terkini-table">

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
