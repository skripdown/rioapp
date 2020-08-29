@extends('document')


@section('title')
    Scanner
@endsection

@section('style')
    <!--suppress JSUnresolvedFunction -->
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
    <style>
        body {
            font-family: 'Ropa Sans', sans-serif;
            color: #333;
            max-width: 640px;
            margin: 0 auto;
            position: relative;
        }

        h1 {
            margin: 10px 0;
            font-size: 40px;
        }

        #loadingMessage {
            text-align: center;
            padding: 40px;
            background-color: #eee;
        }

        #canvas {
            width: 100%;
        }

        #output {
            margin-top: 20px;
            background: #eee;
            padding: 10px 10px 0;
        }

        #output div {
            padding-bottom: 10px;
            word-wrap: break-word;
        }
    </style>
@endsection

@section('content')
    <h1 class="text-center" style="margin-top: 15vh">
        {{env('APP_NAME')}} |
        <span id="status">Aktifasi kode QR</span>
    </h1>
    <h3 id="scanner_not_init" class="text-danger">Scanner belum terhubung dengan sistem.</h3>
    <p>Pindai kode QR</p>
    <div id="loadingMessage">🎥 tidak dapat mengakses video stream (pastikan perangkat memiliki webcam)</div>
    <canvas id="canvas" hidden></canvas>
    <div id="output" hidden>
        <div id="outputMessage">Tidak ada QR code yang terdeteksi.</div>
        <div hidden><b>Data:</b>
            <span id="outputData"></span>
        </div>
    </div>
@endsection

@section('script-body')
    <script src="{{asset('element/lib/core/jsqr/jsQr.js')}}"></script>
    <script>
        $(document).ready(()=>{

            let scanner_init = false;
            const not_init = $('#scanner_not_init').get(0);
            const video    = document.createElement('video');
            const canvasEl = $('#canvas').get(0);
            const canvas   = canvasEl.getContext('2d');
            const load_msg = $('#loadingMessage').get(0);
            const out_ctr  = $('#output').get(0);
            const out_msg  = $('#outputMessage').get(0);
            const out_data = $('#outputData').get(0);

            function drawLine(begin, end, color) {
                canvas.beginPath();
                canvas.moveTo(begin.x, begin.y);
                canvas.lineTo(end.x, end.y);
                canvas.lineWidth = 4;
                canvas.strokeStyle = color;
                canvas.stroke();
            }

            function tick() {
                load_msg.innerText = "⌛ Memuat Scanner...";
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    load_msg.hidden = true;
                    canvasEl.hidden = false;
                    out_ctr.hidden  = false;

                    canvasEl.height = video.videoHeight;
                    canvasEl.width  = video.videoWidth;
                    canvas.drawImage(video, 0, 0, canvasEl.width, canvasEl.height);

                    const imageData = canvas.getImageData(0, 0, canvasEl.width, canvasEl.height);
                    const code      = jsQR(imageData.data, imageData.width, imageData.height, {
                        inversionAttempts: "dontInvert"
                    });

                    if (code) {
                        drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                        drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                        drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                        drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                        out_msg.hidden                = true;
                        out_data.parentElement.hidden = false;
                        out_data.innerText            = code.data;
                        if (scanner_init) {
                            $.ajax({
                                type: 'POST',
                                url: '{{url('post_qr_code')}}',
                                data: {_token:'{{csrf_token()}}',qr:code.data},
                                success: data=>{
                                    if (data.result === '1') {
                                        setTimeout(()=>{
                                            out_data.innerHTML = '<span class="text-success">'+data.nid+' terabsensi</span>';
                                        },1000);
                                        setTimeout(()=>{
                                            out_data.innerHTML = '';
                                        },1000);
                                        out_msg.hidden = false;
                                    }
                                }
                            });
                        }
                        else {
                            $.ajax({
                                type: 'POST',
                                url: '{{url('post_scanner_code')}}',
                                data: {_token:'{{csrf_token()}}',qr:code.data},
                                success: data=>{
                                    if (data.result === '1')
                                        scanner_init = true;
                                }
                            });
                        }
                    }
                    else {
                        out_msg.hidden                = false;
                        out_data.parentElement.hidden = true;
                    }
                }
                requestAnimationFrame(tick);
            }

            navigator.mediaDevices.getUserMedia({
                video: {facingMode: "environment"}
            }).then(stream=>{
                video.srcObject = stream;
                video.setAttribute("playsline",true);
                video.play();
                requestAnimationFrame(tick);
            });

        });
    </script>
@endsection
