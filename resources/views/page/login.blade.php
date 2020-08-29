@extends('document')


@section('title')
    login
@endsection

@section('script-head')
    <!--suppress JSUnusedLocalSymbols -->
    <script src="{{asset('element/lib/core/jsqr/jsQr.js')}}"></script>
@endsection

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background-color: #f0f0f0">
        <div class="auth-box row">
            <div class="col-12 bg-white">
                <div class="p-3">
                    <h2 class="mt-3 text-center">Log In</h2>
                    <p class="text-center">Masukkan NID dan kata sandi untuk mengakses panel admin.</p>
                    <form class="mt-4" method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="nid">NID</label>
                                    <input class="form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" id="nid" type="text" placeholder="masukkan NID" name="nid" required autofocus>
                                    @if ($errors->has('nid'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nid') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Kata Sandi</label>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="pwd" type="password" placeholder="masukkan kata sandi" name="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-block btn-info">Masuk</button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-4">
                        <div id="toggler">
                            @include('html.open-scanner')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script>
        let toggler;
        $(document).ready(()=>{
            toggler = $('#toggler').get(0);
        });
        window.setInterval(()=>{
            $.ajax({
                type: 'POST',
                url: '{{url('post_check_rapat')}}',
                data: {_token:'{{csrf_token()}}'},
                success: data=>{
                    console.log('status = '+data.status);
                    if (data.status === '1') {
                        $(toggler).html('<div class="mt-4 text-center"><a class="btn btn-block btn-info" href="{{url('/scanner')}}"><span class="text-white">Jadikan sebagai Scanner</span></a></div>');
                    }
                    else {
                        $(toggler).html('<div class="mt-4 text-center"><span class="text-muted">Tidak ada rapat yang sedang berlangsung</span></div>');
                    }
                }
            });
        },{{env('APP_REFRESH_RATE')}});
    </script>
@endsection
