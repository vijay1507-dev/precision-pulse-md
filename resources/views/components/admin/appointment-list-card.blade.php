<div class="card custom-card main-card-item primary border-0 p-4 rounded-30 bgyellow_light">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">{{ $title }}</h4>
            <a class="btn btn-primary rounded-30" href="{{ $link }}">View all Appointments</a>
        </div>

        <div class="card bg-white border-0 p-3 rounded-30">
            @forelse ($appointments as $appointment)
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <a href="#" class="nav-icon pe-md-0 d-flex align-items-center">
                        <img src="{{ asset($appointment['image']) }}" class="avatar img-fluid" alt="">
                        <div class="d-grid ms-3 text-start">
                            <span class="text-dark mb-0 fs-medium h6">{{ $appointment['name'] }}</span>
                            <span class="text-muted">Booking on {{ \Carbon\Carbon::parse($appointment['date'])->format('jS M, Y') }}</span>
                        </div>
                    </a>
                    <span class="bg-yellow rounded-30 badge rounded-pill">
                        {{ $appointment['label'] ?? 'TODAY' }}
                    </span>
                </div>
            @empty
                <p class="text-muted mb-0">No appointments found.</p>
            @endforelse
        </div>
</div>