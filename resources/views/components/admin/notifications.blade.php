<ul class="list-group list-group-flush">
  @foreach ($notifications as $notification)
    <li class="list-group-item border-bottom mb-3">
      <div class="d-flex">
        <div class="flex-shrink-0">
          <div class="notifi_auth">
            <img 
              src="{{ $notification['avatar'] ?? asset('assets/images/profile.jpg') }}" 
              width="40" 
              class="rounded-circle" 
              alt="avatar"
            >
          </div>
        </div>
        <div class="flex-grow-1 ms-3">
          <div class="d-flex">
            <div class="flex-grow-1 me-3 position-relative">
              <h6 class="mb-0 text-truncate">{{ $notification['title'] ?? 'Notification' }}</h6>
            </div>
            <div class="flex-shrink-0">
              <span class="text-sm text-muted">{{ $notification['time'] ?? 'Just now' }}</span>
            </div>
          </div>
          <p class="position-relative mt-1 mb-2">
            <span>{{ $notification['message'] ?? '' }}</span>
          </p>
        </div>
      </div>
    </li>
  @endforeach
</ul>
