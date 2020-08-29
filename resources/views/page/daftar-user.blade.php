@extends('html.admin')

@section('title')
    Pengguna
@endsection

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Pengguna</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{url('/pengguna')}}">Daftar pengguna sistem absensi rapat {{env('APP_NAME')}}</a>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                            <tr class="border-0">
                                <th class="border-0 font-18 font-weight-medium text-muted"></th>
                                <th class="border-0 font-18 font-weight-medium text-muted px-2">Nama</th>
                                <th class="border-0 font-18 font-weight-medium text-muted">NID</th>
                                <th class="border-0 font-18 font-weight-medium text-muted text-center">Total Hadir</th>
                                <th class="border-0 font-18 font-weight-medium text-muted text-center">Total Izin</th>
                                <th class="border-0 font-18 font-weight-medium text-muted text-center">Total Absen</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($response as $item)
                                <tr>
                                    <td class="border-top-0">
                                        <div class="d-flex no-block align-items-center">
                                            <div class=""><img
                                                    src="{{asset('storage/'.$item->profile_url)}}"
                                                    alt="user" class="rounded-circle" width="60"
                                                    height="60" />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-top-0 text-muted px-2 py-4 font-16">{{$item->name}}</td>
                                    <td class="border-top-0 text-muted px-2 py-4 font-16">{{$item->nid}}</td>
                                    @if ($item->hadir == 0 && ($item->absen > 0 || $item->izin > 0))
                                        <td class="border-top-0 text-muted px-2 py-4 font-16"><span class="text-danger">tidak pernah</span></td>
                                    @elseif($item->hadir == 0 && $item->absen == 0 && $item->izin == 0)
                                        <td class="border-top-0 text-muted px-2 py-4 font-16"><span class="text-muted">tidak pernah</span></td>
                                    @else
                                        <td class="border-top-0 text-muted px-2 py-4 font-16">{{$item->hadir}}</td>
                                    @endif

                                    @if ($item->izin > 2)
                                        <td class="border-top-0 text-muted px-2 py-4 font-16"><span class="text-warning">{{$item->izin}}</span></td>
                                    @elseif($item->izin == 0)
                                        <td class="border-top-0 text-muted px-2 py-4 font-16">tidak pernah</td>
                                    @else
                                        <td class="border-top-0 text-muted px-2 py-4 font-16">{{$item->izin}}</td>
                                    @endif

                                    @if ($item->absen > 2)
                                        <td class="border-top-0 text-muted px-2 py-4 font-16"><span class="text-danger">{{$item->izin}}</span></td>
                                    @elseif($item->absen == 0)
                                        <td class="border-top-0 text-muted px-2 py-4 font-16">tidak pernah</td>
                                    @else
                                        <td class="border-top-0 text-muted px-2 py-4 font-16">{{$item->absen}}</td>
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
