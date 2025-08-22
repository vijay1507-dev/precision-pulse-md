<x-admin-layout>
  <div class="container-fluid py-4">
    <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
      <div class="row align-items-center">
        <div class="col-md-3 text-center">
          <img src="{{ $doctor->profile_photo ? asset('storage/' . $doctor->profile_photo) : asset('assets/images/profile.jpg') }}"
               alt="Profile Photo"
               class="rounded-circle shadow"
               style="width: 150px; height: 150px; object-fit: cover;">
        </div>

        <div class="col-md-9">
          <h3>{{ $doctor->user->name }} {{ $doctor->user->last_name }}</h3>
          <p><strong>Status:</strong>
            @if($doctor->availability && $doctor->availability->is_available)
              <span class="badge bg-success">Available</span>
            @else
              <span class="badge bg-secondary">Unavailable</span>
            @endif
          </p>
        </div>
      </div>
  </div>

    <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <div class="row">
              <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
                <div class="nav-icon pe-md-0 d-flex align-items-center">
                  <div class="custom-card_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                    </svg>
                  </div>
                  <div class="d-grid ms-3 text-start">
                    <h6 class="text-dark mb-1 fw-medium h6">Email</h6>
                    <span class="text-dark"> {{ $doctor->user->email }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
                <div class="nav-icon pe-md-0 d-flex align-items-center">
                  <div class="custom-card_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg>
                  </div>
                  <div class="d-grid ms-3 text-start">
                    <span class="text-dark mb-1 fs-medium h6">Phone No.</span>
                    <span class="text-dark">{{ $doctor->phone }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
                <div class="nav-icon pe-md-0 d-flex align-items-center">
                  <div class="custom-card_icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z"/>
</svg>
                  </div>
                  <div class="d-grid ms-3 text-start">
                    <span class="text-dark mb-1 fs-medium h6">Gender</span>
                    <span class="text-dark">{{ $doctor->gender }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
                <div class="nav-icon pe-md-0 d-flex align-items-center">
                   <div class="custom-card_icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
  <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
</svg>
                  </div>
                  <div class="d-grid ms-3 text-start">
                    <span class="text-dark mb-1 fs-medium h6">License</span>
                    <span class="text-dark">{{ $doctor->license_number }}</span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
                <div class="nav-icon pe-md-0 d-flex align-items-center">
                   <div class="custom-card_icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-star" viewBox="0 0 16 16">
  <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.18.18 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.18.18 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.18.18 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.18.18 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.18.18 0 0 0 .134-.098z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
</svg>
                  </div>
                  <div class="d-grid ms-3 text-start">
                    <span class="text-dark mb-1 fs-medium h6">NPI</span>
                    <span class="text-dark">{{ $doctor->npi }}</span>
                  </div>
                </div>
              </div>
               <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
                <div class="nav-icon pe-md-0 d-flex align-items-center">
                   <div class="custom-card_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-escape" viewBox="0 0 16 16">
  <path d="M8.538 1.02a.5.5 0 1 0-.076.998 6 6 0 1 1-6.445 6.444.5.5 0 0 0-.997.076A7 7 0 1 0 8.538 1.02"/>
  <path d="M7.096 7.828a.5.5 0 0 0 .707-.707L2.707 2.025h2.768a.5.5 0 1 0 0-1H1.5a.5.5 0 0 0-.5.5V5.5a.5.5 0 0 0 1 0V2.732z"/>
</svg>
                  </div>
                  <div class="d-grid ms-3 text-start">
                    <span class="text-dark mb-1 fs-medium h6">Specializations</span>
                    <span class="text-dark"> @foreach($doctor->specializations ?? [] as $spec)
            <span class="badge bg-primary me-1">{{ $spec }}</span>
          @endforeach</span>
                  </div>
                </div>
              </div>

            </div>

          </div>

      <div class="row card custom-card main-card-item primary border-0 p-4 rounded-30">

        <div class="col-md-12">
          <h5>About</h5>
          <p>{!! $doctor->about_me !!}</p>
        </div>
      </div>

      <div class="row card custom-card main-card-item primary border-0 p-4 rounded-30">
      <h5>Professional Experience</h5>
        <div class="row">
             @forelse($doctor->experiences as $exp)
              <div class="mb-3 ps-2 border-start border-3 border-dark mt-3 col-12 col-md-6">
                <strong>{{ $exp->position }}</strong> at <strong>{{ $exp->hospital_name }}</strong><br>
                <small class="text-muted">{{ $exp->start_date }} – {{ $exp->end_date ?? 'Present' }}</small>
                <p class="mt-1 mb-0">{{ $exp->description }}</p>
              </div>
            @empty
              <p>No experience listed.</p>
            @endforelse
        </div>
    </div>
       </div>
  </div>
</x-admin-layout>
