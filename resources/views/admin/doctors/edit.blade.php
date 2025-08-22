<x-admin-layout>
  <div class="container-fluid">
    {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div>
            <h3 class="mb-2">Update Doctor Profile</h3>
            <p class="font-18">Enter the doctor’s basic information including name, specialty, contact details, and profile photo.</p>
          </div>
            <a class="btn btn-primary rounded-30" href="#">Available Doctors</a>
        </div>
  </div>
   @include('admin.doctors._form', [
          'doctor'     => $doctor,
          'formAction' => route('admin.doctor.update', $doctor->id),
          'isEdit'     => true
      ])

  {{-- Bootstrap Icons --}}
</x-admin-layout>
