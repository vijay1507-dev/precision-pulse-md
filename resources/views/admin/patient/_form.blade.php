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
          <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <h3 class="mb-4">Profile Photo</h3>
            <div class="d-flex align-items-center">
              <div id="profilePreview"
                class="doctor_profile img-fluid d-flex justify-content-center align-items-center rounded-circle bg-skyblue imgframe">
                +
              </div>
              <div class=" ms-3 text-start">
                <div class="">
                  <label for="uploadPhoto" class=" mb-2 p-3 bg-skyblue">
                    Upload Photo
                  </label>
                  <input type="file" id="uploadPhoto" name="image" value="" accept="image/png, image/jpeg, image/gif" hidden />
                </div>
                <span class="text-sm">Upload a profile photo. JPG, PNG or GIF. Max 2MB.</span>
              </div>
            </div>
          </div>
          <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <h3 class="mb-4">Personal Information</h3>
            <div class="row">
              <div class="col-12 col-md-4 col-sm-6">
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control mb-3 rounded-30" placeholder="First Name">
                @error('first_name')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>
              <div class="col-12 col-md-4 col-sm-6">

                <input type="text" name="last_name" class="form-control mb-3 rounded-30" value="{{ old('last_name') }}" placeholder="Last Name">

                @error('last_name')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror

              </div>

              <div class="col-12 col-md-4 col-sm-6">

                <input type="text" name="email" value="{{ old('email') }}" class="form-control mb-3 rounded-30" placeholder="Email Id">
                @error('email')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror

              </div>
              <div class="col-12 col-md-4 col-sm-6">
                <input type="text" name="password" class="form-control mb-3 rounded-30" placeholder="Password">
                @error('password')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>
              <div class="col-12 col-md-4 col-sm-6">
                <input type="text" name="date_of_birth" value="{{ old('date_of_birth')}}" class="date-picker form-control mb-3 rounded-30" placeholder="Date of Birth">
                @error('date_of_birth')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>
              <div class="col-12 col-md-4 col-sm-6">
                <select name="gender"  class="form-select form-control rounded-30" aria-label="Default select example">
                  <option disabled value="">Select Gender</option>
                  <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                 @error('gender')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>
              <div class="col-12 col-md-4 col-sm-6">
                <input type="tel" name="phone_number" class="form-control mb-3 rounded-30" placeholder="+1 (123) 456-7890">
                 @error('phone_number')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>
              <div class="col-12 col-md-4 col-sm-6">
                <input type="number" name="height_cm" value="{{ old('height_cm')}}" placeholder="Height(eg.6.1)" class="form-control mb-3 rounded-30">
                @error('height_cm')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
              </div>
              <div class="col-12 col-md-4 col-sm-6">
              <input type="number" name="weight_lbs" placeholder="Weight in lbs" value="{{ old('weight_lbs')}}" class="form-control mb-3 rounded-30">
               @error('weight_lbs')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
          </div>
          <div class="w-100 d-block">
            <a class="btn btn-primary px-3 rounded-30 me-3" href="#">Cancel</a>
            <button class="btn btn-outline-success px-3 rounded-30" type="submit">Register</button>
          </div>
    </div>
  </form>
<script>
    const input = document.getElementById('uploadPhoto');
    const preview = document.getElementById('profilePreview');
    input.addEventListener('change', function () {
      const file = this.files[0];
      if (file && file.size <= 2 * 1024 * 1024) { // 2MB limit
        const reader = new FileReader();

        reader.onload = function (e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Profile" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;" />`;
        };
        reader.readAsDataURL(file);
      } else {
        alert("Please select an image under 2MB.");
      }
    });
</script>