<aside id="sidebar" class="js-sidebar">
      <div class="h-100">
        <div class="sidebar-logo">
          <a href="#"><img src="{{ asset('assets/images/logo.webp')}}" class="img-fluid rounded" alt=""></a>
        </div>
        <ul class="sidebar-nav">

          <li class="sidebar-item">
            <a href="{{route('admin.dashboard')}}" class="sidebar-link">
              <x-icon.dashboard  />
              Dashboard
            </a>
          </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
              aria-expanded="false">
               <x-icon.appointment  />
              Appointment
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="{{route('admin.appointments')}}" class="sidebar-link">All Appointments</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Order History</a>
              </li>
            </ul>
          </li>

          <!-- <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-target="#Doctors" data-bs-toggle="collapse"
              aria-expanded="false">
              <x-icon.doctors  />
              Doctors
            </a>
            <ul id="Doctors" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="{{route('admin.doctors')}}" class="sidebar-link">All Doctors</a>
              </li>
              <li class="sidebar-item">
                <a href="{{route('admin.add-doctor')}}" class="sidebar-link">Add Doctor</a>
              </li>
            </ul>
          </li> -->

          <li class="sidebar-item">
            <a href="{{route('admin.patients')}}" class="sidebar-link collapsed" data-bs-target="#Patients" data-bs-toggle="collapse"
              aria-expanded="false">
               <x-icon.patients  />
              Patients
            </a>
            <ul id="Patients" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="{{route('admin.patients')}}" class="sidebar-link">All Patient</a>
              </li>
              <li class="sidebar-item">
                <a href="{{route('admin.patient.add')}}" class="sidebar-link">Add Patient</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="{{route('admin.revenue')}}" class="sidebar-link collapsed" data-bs-target="#posts">
              <x-icon.revenue  />
              Revenue 
            </a>
          </li>

          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-target="#Setting" data-bs-toggle="collapse"
              aria-expanded="false">
               <x-icon.settings  />
              Setting
            </a>
            <ul id="Setting" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
              <li class="sidebar-item">
                <a href="{{route('admin.setting.pacticeinfo')}}" class="sidebar-link">Practice Info</a>
              </li>
              <li class="sidebar-item">
                <a href="{{route('admin.setting.payments')}}" class="sidebar-link">Payments</a>
              </li>
              <li class="sidebar-item">
                <a href="{{route('admin.setting.telehealth')}}" class="sidebar-link">Telehealth Settings</a>
              </li>
              <li class="sidebar-item">
                <a href="{{route('admin.setting.notifications')}}" class="sidebar-link">Notifications</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="{{route('logout')}}" class="sidebar-link collapsed">
              <x-icon.logout  />
              Logout
            </a>
          </li>

        </ul>
      </div>
</aside>
