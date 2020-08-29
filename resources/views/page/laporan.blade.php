<!DOCTYPE html>
<html lang="{{env('APP_LANG')}}" dir="{{env('APP_DIR')}}">
<head>
    <meta charset="{{env('APP_CHARSET')}}">
    <meta name="viewport" content="{{env('APP_VIEWPORT')}}">
    <meta name="description" content="{{env('APP_DESCRIPTION')}}">
    <meta name="author" content="{{env('APP_AUTHOR')}}">
    <link rel="icon" type="image/png" sizes="{{env('ICON_SIZE')}}" href="{{asset(env('ICON_SOURCE'))}}">
    <title>Laporan</title>
    <script src="{{asset('element/lib/extra/paged_js/paged.js')}}"></script>
    <script src="{{asset('element/lib/core/jquery/dist/jquery.min.js')}}"></script>

    <style>

        h1,h3 {
            text-align: center;
        }
        .break {
            page-break-after: always;
        }

        .rp-table-container {
            text-align: center;
        }

        .top {
            margin-top: 0.75em;
            margin-bottom: 0.75em;
            page-break-after: avoid;
        }

        .table-id {
            margin-bottom: 0.5em;
        }

        .rp-table {
            display: inline-table;
            border-collapse: collapse;
            width: 100%;
        }

        .rp-table>thead{
            font-weight: bolder;
        }

        .rp-table>tbody tr td:nth-child(2),
        .rp-table>tbody tr td:nth-child(3){
            text-align: left;
        }

        thead td {
            background-color: rgba(244, 208, 63,0.9);
            padding: 0.5em 0;
        }

        .danger {
            color : red;
        }

        .peserta-data {
            page-break-after: always;
        }

        .rp-table * {
            border: 1px solid black;
        }

        @page {
            size: A4;
            margin: 2cm 2cm 2cm 3cm;
        }
    </style>
</head>
<body>
{!! $report !!}
<script>
    const read = () => {
        window.print();
    };
    setTimeout(read, 1000);
</script>
</body>
</html>
