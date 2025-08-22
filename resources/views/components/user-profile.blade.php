<a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0 d-flex align-items-center">
  <div class="d-grid me-3 text-end">
    <span class="text-dark mb-0 fs-medium h6">
      {{ $user->name }}
    </span>
    <span class="text-muted">
      {{ $user->email }}
    </span>
  </div>
<img
  src="{{ isset($user->admin) && $user->admin->avatar 
           ? asset('storage/' . $user->admin->avatar) 
           : $fallbackImage }}"
  class="avatar img-fluid"
  alt="{{ $user->name }}"
>
</a>
