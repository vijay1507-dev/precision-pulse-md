<x-admin-layout>
  <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h3 class="mb-2">Add Patient</h3>
              <p class="font-18">A list of all patients in your clinic with their details.</p>
            </div>
            <a class="btn btn-primary rounded-30" href="add-appointment.html">Add Appointments</a>
          </div>
           @include('admin.patient._form', [
            'formAction' => route('admin.doctor.create'),
            'isEdit'     => true,
            'button'    => 'Update'
            ])
        </div>
</x-admin-layout>