<div class="card custom-card main-card-item primary bg-white border-0">
    <div class="card-body p-4">
        <div class="d-flex align-items-start justify-content-between mb-0 gap-2">
            <div class="text-end">
                <div class="mb-4">
                    <span class="avatar avatar-md svg-white avatar-rounded">
                        <img src="{{ asset($icon) }}" alt="">
                    </span>
                </div>
            </div>
            <div class="w-100">
                <h3 class="fw-semibold lh-1 mb-2">{{ $value }}</h3>
                <span class="d-block mb-0">{{ $title }}</span>
            </div>
        </div>
    </div>
</div>