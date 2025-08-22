<div class="card custom-card main-card-item primary bg-white border-0 p-4 rounded-30">
    <h4>{{ $title }}</h4> 
     @if ($chart)

        {!! $chart->container() !!}
    @else
        <p class="text-danger">⚠️ Chart is null</p>
    @endif
</div>


@once
    @push('scripts')
        <script src="{{ $chart->cdn() }}"></script>
    @endpush
@endonce

@push('scripts')
    {{ $chart->script() }}
@endpush