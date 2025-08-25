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
                <div class="d-flex gap-0 height_profile" bis_skin_checked="1">
                  <select id="heightFeet" name="height_feet" class="w-50 form-select">
                    <option value="">Feet</option>
                    <option value="1" {{ old('height_feet') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('height_feet') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('height_feet') == '3' ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('height_feet') == '4' ? 'selected' : '' }}>4</option>
                    <option value="5" {{ old('height_feet') == '5' ? 'selected' : '' }}>5</option>
                    <option value="6" {{ old('height_feet') == '6' ? 'selected' : '' }}>6</option>
                    <option value="7" {{ old('height_feet') == '7' ? 'selected' : '' }}>7</option>
                    <option value="8" {{ old('height_feet') == '8' ? 'selected' : '' }}>8</option>
                    <option value="9" {{ old('height_feet') == '9' ? 'selected' : '' }}>9</option>
                  </select>
                  <select id="heightInches" name="height_inches" class="w-50 form-select">
                    <option value="">Inches</option>
                    <option value="0.0" {{ old('height_inches') == '0.0' ? 'selected' : '' }}>0</option>
                    <option value="0.1" {{ old('height_inches') == '0.1' ? 'selected' : '' }}>1</option>
                    <option value="0.2" {{ old('height_inches') == '0.2' ? 'selected' : '' }}>2</option>
                    <option value="0.3" {{ old('height_inches') == '0.3' ? 'selected' : '' }}>3</option>
                    <option value="0.4" {{ old('height_inches') == '0.4' ? 'selected' : '' }}>4</option>
                    <option value="0.5" {{ old('height_inches') == '0.5' ? 'selected' : '' }}>5</option>
                    <option value="0.6" {{ old('height_inches') == '0.6' ? 'selected' : '' }}>6</option>
                    <option value="0.7" {{ old('height_inches') == '0.7' ? 'selected' : '' }}>7</option>
                    <option value="0.8" {{ old('height_inches') == '0.8' ? 'selected' : '' }}>8</option>
                    <option value="0.9" {{ old('height_inches') == '0.9' ? 'selected' : '' }}>9</option>
                    <option value="1.0" {{ old('height_inches') == '1.0' ? 'selected' : '' }}>10</option>
                    <option value="1.1" {{ old('height_inches') == '1.1' ? 'selected' : '' }}>11</option>
                  </select>
                </div>
                @error('height_feet')
                  <x-input-error :messages="$message" class="mt-2" />
                @enderror
                @error('height_inches')
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
            <button class="btn btn-outline-success px-3 rounded-30" type="submit">Submit</button>
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