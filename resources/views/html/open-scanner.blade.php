<div class="mt-4 text-center">
    @if (Services\Injection::isOnRapat())
        <a class="btn btn-block btn-info" href="{{url('/scanner')}}">
            <span class="text-white">
                Jadikan sebagai Scanner
            </span>
        </a>
    @else
        <span class="text-muted">
            Tidak ada rapat yang sedang berlangsung
        </span>
    @endif
</div>
