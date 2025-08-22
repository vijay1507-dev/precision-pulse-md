@php 
 $imagesbase = asset('assets/images/');
 $current = Auth::user(); 
 @endphp

  <nav class="navbar navbar-expand px-3">
  <button class="btn" id="sidebar-toggle" type="button">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse navbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown ms-2">
        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0 notification_head">
         <x-icon.notification class="header-link-icon animate-bell" />
         <span class="header-icon-pulse bg-secondary rounded pulse pulse-secondary"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <div class="dropdown-header d-flex align-items-center justify-content-between notifiation_drop">
            <h5 class="text-dark">Notifications</h5>
            <ul class="list-inline ms-auto mb-0">
              <li class="list-inline-item">
                <a href="#" class="avtar avtar-s btn-link-hover-primary">
                   <x-icon.link class="bi bi-link-45deg" />
                </a>
              </li>
            </ul>
          </div>
          <div
            class="dropdown-body text-wrap header-notification-scroll position-relative simplebar-scrollable-y">
            <div class="simplebar-wrapper">
              @php
              $notifications = [
                [
                  'avatar'  => asset('assets/images/profile.jpg'),
                  'title'   => 'System Update',
                  'message' => 'New features added. Check the panel.',
                  'time'    => '1 hour ago',
                ],
                [
                  'avatar'  => asset('assets/images/profile.jpg'),
                  'title'   => 'Booking Alert',
                  'message' => 'An appointment was booked by Jane.',
                  'time'    => '2 hours ago',
                ],
              ];
              @endphp
               <x-admin.notifications :notifications="$notifications" />     
            </div>
          </div>

          <div class="dropdown-footer">
            <div class="row g-3">
              <div class="col-6">
                <div class="d-grid"><button class="btn btn-primary">Archive all</button></div>
              </div>
              <div class="col-6">
                <div class="d-grid"><button class="btn btn-outline-secondary">Mark all as read</button></div>
              </div>
            </div>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown ms-3">
        <x-user-profile :user="$current" />
        <div class="dropdown-menu dropdown-menu-end"> 
          <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a>
          <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
        </div>
      </li>
    </ul> 
  </div>
</nav>