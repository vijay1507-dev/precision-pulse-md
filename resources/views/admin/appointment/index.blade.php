<x-admin-layout>
@php  $imagesbase = asset('assets/images/'); @endphp
<div class="container-fluid">
  <div class="row dashboard_cards">
    <div class="col-xl-3">
      <div class="card custom-card main-card-item primary bg-white border-0">
        <div class="card-body p-4">
          <div class="d-flex align-items-start justify-content-between mb-0 gap-2">
            <div class="text-end">
              <div class="mb-4"> <span class="avatar avatar-md  svg-white avatar-rounded"> <img
                    src="{{ $imagesbase }}/refund.svg" alt=""> </span> </div>
            </div>
            <div class="w-100">
              <h3 class="fw-semibold lh-1 mb-2">$45,231.89</h3> <span class="d-block mb-0 ">Revenue</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card custom-card main-card-item primary bg-white border-0">
        <div class="card-body p-4">
          <div class="d-flex align-items-start justify-content-between mb-0 gap-2">
            <div class="text-end">
              <div class="mb-4"> <span class="avatar avatar-md  svg-white avatar-rounded"> <img
                    src="{{ $imagesbase }}/appointment.svg" alt=""> </span> </div>
            </div>
            <div class="w-100">
              <h3 class="fw-semibold lh-1 mb-2">+2,350</h3> <span class="d-block mb-0 ">Appointments</span>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card custom-card main-card-item primary bg-white border-0">
        <div class="card-body p-4">
          <div class="d-flex align-items-start justify-content-between mb-0 gap-2">
            <div class="text-end">
              <div class="mb-4"> <span class="avatar avatar-md  svg-white avatar-rounded"> <img
                    src="{{ $imagesbase }}/refund.svg" alt=""> </span> </div>
            </div>

            <div class="w-100">
              <h3 class="fw-semibold lh-1 mb-2">+122</h3> <span class="d-block mb-0 ">Today’s Schedule</span>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card custom-card main-card-item primary bg-white border-0">
        <div class="card-body p-4">
          <div class="d-flex align-items-start justify-content-between mb-0 gap-2">
            <div class="text-end">
              <div class="mb-4"> <span class="avatar avatar-md  svg-white avatar-rounded"> <img
                    src="{{ $imagesbase }}/medical-team.svg" alt=""> </span> </div>
            </div>

            <div class="w-100">
              <h3 class="fw-semibold lh-1 mb-2">1,250</h3> <span class="d-block mb-0 ">Total Patient</span>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h3 class="mb-2">All Appointments</h3>
      <p class="font-18">Manage your clinic's appointments and schedules.</p>
    </div>
    <a class="btn btn-primary rounded-30" href="{{route('admin.add-appointment')}}">Add Appointments</a>
  </div>

  <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">

    <x-appointments.list :appointments="$appointments">
        <x-slot name="header"> <h2>My Appointments</h2> </x-slot>
    </x-appointments.list>
    
  </div>
</div>
</x-admin-layout>