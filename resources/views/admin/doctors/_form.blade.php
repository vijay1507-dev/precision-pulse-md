<form method="POST"action="{{ $formAction }}" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="container-fluid">
      {{-- Error Messages --}}
      @if ($errors->any())
        <div class="alert alert-danger rounded-20">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div> 
      @endif
     {{-- Profile Photo --}} 
      <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
        <h3 class="mb-4">Profile Photo</h3>
        <div class="nav-icon pe-md-0 d-flex align-items-center">
          <img src="{{ $doctor->profile_photo 
                      ? asset('storage/' . $doctor->profile_photo) 
                      : asset('assets/images/profile.jpg') }}"
               class="doctor_profile img-fluid rounded-circle"
               alt="Doctor Profile Photo"
               style="width: 100px; height: 100px; object-fit: cover;">

          <div class="d-grid ms-3 text-start">
            <input type="file" name="profile_photo" class="form-control mb-2" accept=".jpg,.jpeg,.png,.gif">
            
            @error('profile_photo')
              <x-input-error :messages="$message" class="mt-2 text-danger" />
            @enderror

            <span class="text-sm text-muted">Upload JPG, PNG, or GIF (Max 2MB)</span>
          </div>
        </div>
      </div>
  {{-- End Profile Photo --}}

   {{-- Contact Info --}}
          <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <h3 class="mb-4">Contact Information</h3>
            <div class="row">
              {{-- First Name --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input
                  name="name"
                  type="text"
                  placeholder="First Name"
                  class="form-control mb-3 rounded-30"
                  value="{{ old('name', $doctor->user->name ?? '') }}"
                />
                @error('name')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- Last Name --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input
                  name="last_name"
                  type="text"
                  placeholder="Last Name"
                  class="form-control mb-3 rounded-30"
                  value="{{ old('last_name', $doctor->user->last_name ?? '') }}"
                />
                @error('last_name')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- Phone --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input
                  name="phone"
                  type="tel"
                  placeholder="Phone Number"
                  class="form-control mb-3 rounded-30"
                  value="{{ old('phone', $doctor->phone ?? '') }}"
                />
                @error('phone')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- Email --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input
                  name="email"
                  type="email"
                  placeholder="Email Id"
                  class="form-control mb-3 rounded-30"
                  value="{{ old('email', $doctor->user->email ?? '') }}"
                />
                @error('email')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- Password (only for create) --}}
              @if(!isset($isEdit) || $isEdit === false)
              <div class="col-12 col-md-4 col-sm-6">
                <input
                  name="password"
                  type="password"
                  placeholder="Password"
                  class="form-control mb-3 rounded-30"
                />
                @error('password')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              <div class="col-12 col-md-4 col-sm-6">
                <input
                  name="password_confirmation"
                  type="password"
                  placeholder="Confirm Password"
                  class="form-control mb-3 rounded-30"
                />
              </div>
              @endif
            </div>
          </div>
       {{-- end Contact Info }}

      {{-- Personal Info --}}
        <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
          <h3 class="mb-4">Personal Information</h3>
          <div class="row">
            {{-- Gender --}}
            <div class="col-12 col-md-4 col-sm-6">
              <select class="form-select form-control rounded-30" name="gender">
                <option value="" disabled {{ old('gender', $doctor->gender ?? '') === null ? 'selected' : '' }}>Select Gender</option>
                <option value="Male" {{ old('gender', $doctor->gender ?? '') === 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $doctor->gender ?? '') === 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender', $doctor->gender ?? '') === 'Other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('gender')
                <x-input-error :messages="$message" class="mt-2" />
              @enderror
            </div>

            {{-- License Number --}}
            <div class="col-12 col-md-4 col-sm-6">
              <input
                name="license_number"
                placeholder="License No"
                class="form-control mb-3 rounded-30"
                value="{{ old('license_number', $doctor->license_number ?? '') }}"
              />
              @error('license_number')
                <x-input-error :messages="$message" class="mt-2" />
              @enderror
            </div>

            {{-- NPI --}}
            <div class="col-12 col-md-4 col-sm-6">
              <input
                name="npi"
                placeholder="NPI"
                class="form-control mb-3 rounded-30"
                value="{{ old('npi', $doctor->npi ?? '') }}"
              />
              @error('npi')
                <x-input-error :messages="$message" class="mt-2" />
              @enderror
            </div>
          </div>
        </div>
         {{-- End Personal Info --}}

      {{-- Specialization Info --}}
        <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="mb-4">Specialization Information</h3>
            <a class="btn btn-primary rounded-30" href="javascript:void(0);" id="addSpecialization">Add More</a>
          </div>

          <div class="row" id="specializationContainer">
            @php
              $specializations = old('specializations', $doctor->specializations ?? ['']);
            @endphp

            @foreach($specializations as $index => $value)
              <div class="col-12 col-md-4 col-sm-6 specialization-field">
                <div class="input-group mb-3">
                  <input
                    type="text"
                    name="specializations[]"
                    class="form-control rounded-30"
                    value="{{ $value }}"
                    placeholder="Specialization" />

                  @if($index != 0)
                    <button class="btn btn-danger removeSpecialization" type="button">
                      <i class="bi bi-x-lg"></i>
                    </button>
                  @endif
                </div>
                @error("specializations.$index")
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>
            @endforeach
          </div>
        </div>
    {{-- End specializations Info --}}

      {{-- Experience --}}
      <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h3 class="mb-4">Professional Experience</h3>
          <a class="btn btn-primary rounded-30" href="javascript:void(0);" id="addExperience">Add More</a>
        </div>

        <div id="experienceContainer">
          @php
            $experiences = old('experiences', $doctor->experiences ?? [[]]);
           @endphp
          @foreach ($experiences as $i => $experience)
            <div class="row experience-block mb-4">
              {{-- Hospital Name --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input 
                  name="experiences[{{ $i }}][hospital_name]" 
                  placeholder="Hospital Name" 
                  class="form-control mb-3 rounded-30" 
                  value="{{ old("experiences.$i.hospital_name", $experience['hospital_name'] ?? ($experience->hospital_name ?? '')) }}" />
                @error("experiences.$i.hospital_name")
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- Address --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input 
                  name="experiences[{{ $i }}][address]" 
                  placeholder="Address" 
                  class="form-control mb-3 rounded-30" 
                  value="{{ old("experiences.$i.address", $experience['address'] ?? ($experience->address ?? '')) }}" />
                @error("experiences.$i.address")
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- Position --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input 
                  name="experiences[{{ $i }}][position]" 
                  placeholder="Position" 
                  class="form-control mb-3 rounded-30" 
                  value="{{ old("experiences.$i.position", $experience['position'] ?? ($experience->position ?? '')) }}" />
                @error("experiences.$i.position")
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- Start Date --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input 
                  name="experiences[{{ $i }}][start_date]" 
                  type="date"
                  placeholder="Start Date" 
                  class="form-control mb-3 rounded-30 date-picker" 
                  value="{{ old("experiences.$i.start_date", $experience['start_date'] ?? ($experience->start_date ?? '')) }}" />
                @error("experiences.$i.start_date")
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>

              {{-- End Date --}}
              <div class="col-12 col-md-4 col-sm-6">
                <input 
                  name="experiences[{{ $i }}][end_date]" 
                  type="date"
                  placeholder="End Date" 
                  class="form-control mb-3 rounded-30 date-picker" 
                  value="{{ old("experiences.$i.end_date", $experience['end_date'] ?? ($experience->end_date ?? '')) }}" />
              </div>

              {{-- Description --}}
              <div class="col-12">
                <textarea 
                  name="experiences[{{ $i }}][description]" 
                  placeholder="Description" 
                  class="form-control mb-3 rounded-30"
                  rows="3">{{ old("experiences.$i.description", $experience['description'] ?? ($experience->description ?? '')) }}</textarea>
              </div>

              {{-- Remove Button --}}
              @if($i !== 0)
              <div class="col-12 col-md-2 col-sm-6 mb-3">
                <button type="button" class="btn btn-danger rounded-30 removeExperience">
                  <i class="bi bi-x-lg"></i> Remove
                </button>
              </div>
              @endif
            </div>
          @endforeach
        </div>
      </div>
      {{-- End  Experience --}}

     {{-- About Me --}}
        <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
          <h3 class="mb-4">About Me</h3>
          @error('about_me')
            <x-input-error :messages="$message" class="mt-2" />
          @enderror

          <div class="row">
            <div class="col-12">
              <x-tiny-editor 
                name="about_me" 
                id="about-me" 
                :value="old('about_me', $doctor->about_me ?? '')" 
              />
            </div>
          </div>
        </div>


     {{-- Doctor Availability Settings --}}
@php


      $availability = $doctor->availability ?? null;


@endphp
    <div class="card p-4 mb-4 rounded-30 shadow">
      <h3 class="mb-4">Doctor Availability Settings</h3>

      {{-- Accept Appointments --}}
      <div class="form-group mb-3">
        <label><strong>Accept Appointments?</strong></label><br>
        <input type="checkbox" name="is_available" value="1"
          {{ old('is_available', $availability->is_available ?? true) ? 'checked' : '' }}>
        @error('is_available')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      {{-- Available Days --}}
      <div class="form-group mb-3">
        <label><strong>Available Days</strong></label><br>
        @php
          $availableDays = old('available_days', $availability->available_days ?? []);
        @endphp
        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $i => $day)
          <label class="me-3">
            <input type="checkbox" name="available_days[]" value="{{ $day }}"
              {{ in_array($day, $availableDays) ? 'checked' : '' }}>
            {{ $day }}
          </label>
        @endforeach
        @error('available_days')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      {{-- Date Range --}}
      <div class="form-group mb-3">
        <label><strong>Date Range</strong></label>
        <div class="row">
          <div class="col-md-6">
            <input type="text" name="available_from" placeholder="Start Date"
              class="form-control mb-3 rounded-30 date-picker @error('available_from') is-invalid @enderror"
              value="{{ old('available_from', $availability->available_from ?? '') }}">
            @error('available_from')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6">
            <input type="text" name="available_to" placeholder="End Date"
              class="form-control mb-3 rounded-30 date-picker @error('available_to') is-invalid @enderror"
              value="{{ old('available_to', $availability->available_to ?? '') }}">
            @error('available_to')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      {{-- Time Range --}}
      <div class="row">
        <div class="col-md-6">
          <input type="text" name="start_time" placeholder="Start Time"
            class="form-control mb-3 rounded-30 time-picker @error('start_time') is-invalid @enderror"
            value="{{ old('start_time', $availability->start_time ?? '') }}">
          @error('start_time')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-6">
          <input type="text" name="end_time" placeholder="End Time"
            class="form-control mb-3 rounded-30 time-picker @error('end_time') is-invalid @enderror"
            value="{{ old('end_time', $availability->end_time ?? '') }}">
          @error('end_time')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
      </div>

    {{-- Slot Duration & Recurrence --}}
    <div class="row">
      <div class="col-md-6">
        <label><strong>Slot Duration (mins)</strong></label>
        <input type="number" name="slot_duration"
          class="form-control mb-3 rounded-30 @error('slot_duration') is-invalid @enderror"
          value="{{ old('slot_duration', $availability->slot_duration ?? 30) }}">
        @error('slot_duration')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label><strong>Recurring Pattern</strong></label>
        <select name="recurrence" class="form-control mb-3 rounded-30 @error('recurrence') is-invalid @enderror">
          @php
            $recurrence = old('recurrence', $availability->recurrence ?? 'none');
          @endphp
          <option value="none" {{ $recurrence === 'none' ? 'selected' : '' }}>None</option>
          <option value="daily" {{ $recurrence === 'daily' ? 'selected' : '' }}>Daily</option>
          <option value="weekly" {{ $recurrence === 'weekly' ? 'selected' : '' }}>Weekly (Selected Days)</option>
        </select>
        @error('recurrence')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
    </div>

    {{-- Blocked Dates --}}
    <div class="form-group mb-3">
      <label><strong>Blocked Dates</strong></label>
      <input type="text" name="blocked_dates"
        class="form-control mb-3 rounded-30 blocked-dates-picker @error('blocked_dates') is-invalid @enderror"
        placeholder="Comma-separated dates like: 2025-07-20,2025-07-24"
        value="{{ old('blocked_dates', is_array($availability->blocked_dates ?? null) ? implode(',', $availability->blocked_dates) : '') }}">
      @error('blocked_dates')
        <div class="invalid-feedback d-block">{{ $message }}</div>
      @enderror
    </div>
  </div>

   {{-- End Doctor Availability Settings --}}

      {{-- Submit --}}
      <div class="w-100 d-block mt-3 text-center">
        <button class="btn btn-primary rounded-30" type="submit">Save</button>
      </div>
    </div>
  </form>
  {{-- JS for dynamic fields --}}
      <script>
        let experienceIndex = {{ count(old('experiences', [])) ?: 1 }};

        // Specializations
        document.getElementById('addSpecialization').addEventListener('click', function () {
          const container = document.getElementById('specializationContainer');
          const newField = document.createElement('div');
          newField.className = 'col-12 col-md-4 col-sm-6 specialization-field';
          newField.innerHTML = `
            <div class="input-group mb-3">
              <input type="text" name="specializations[]" class="form-control rounded-30" placeholder="Specialization">
              <button class="btn btn-danger removeSpecialization" type="button"><i class="bi bi-x-lg"></i></button>
            </div>
          `;
          container.appendChild(newField);
        });

        // Dynamic Experience Fields (with indexed name matching validation)
        document.getElementById('addExperience').addEventListener('click', function () {
          const container = document.getElementById('experienceContainer');
          const newBlock = document.createElement('div');
          newBlock.className = 'row experience-block';
          newBlock.innerHTML = `
            <div class="col-12 col-md-4 col-sm-6">
              <input type="text" name="experiences[${experienceIndex}][hospital_name]" class="form-control mb-3 rounded-30" placeholder="Hospital Name">
            </div>
            <div class="col-12 col-md-4 col-sm-6">
              <input type="text" name="experiences[${experienceIndex}][start_date]" class="date-picker form-control mb-3 rounded-30 date-picker" placeholder="Start Date">
            </div>
            <div class="col-12 col-md-4 col-sm-6">
              <input type="text" name="experiences[${experienceIndex}][end_date]" class="date-picker form-control mb-3 rounded-30 date-picker" placeholder="End Date">
            </div>
            <div class="col-12 col-md-4 col-sm-6">
              <input type="text" name="experiences[${experienceIndex}][position]" class="form-control mb-3 rounded-30" placeholder="Position">
            </div>
            <div class="col-12 col-md-4 col-sm-6">
              <input type="text" name="experiences[${experienceIndex}][address]" class="form-control mb-3 rounded-30 " placeholder="Address">
            </div>
            <div class="col-12 col-md-12">
              <textarea name="experiences[${experienceIndex}][description]" class="form-control mb-3 rounded-30" placeholder="Description"></textarea>
            </div>
            <div class="col-12 col-md-2 col-sm-6 mb-3">
              <button type="button" class="btn btn-danger rounded-30 removeExperience">
                <i class="bi bi-x-lg"></i> Remove
              </button>
            </div>
          `;
          container.appendChild(newBlock);
          date_picker();
          experienceIndex++; 
        });

        document.addEventListener('click', function (e) {
          if (e.target.closest('.removeSpecialization')) {
            e.target.closest('.specialization-field').remove();
          }
          if (e.target.closest('.removeExperience')) {
            e.target.closest('.experience-block').remove();
          }
        });
      </script>


  <script type="text/javascript">
  flatpickr(".time-picker", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: false
    });
  flatpickr(".blocked-dates-picker", {
    mode: "multiple",
    dateFormat: "m/d/Y"
  });
</script>