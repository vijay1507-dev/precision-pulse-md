<x-admin-layout>
      @php  $imagesbase = asset('assets/images/'); @endphp

<div class="container-fluid">
       @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
      @endif
    <h4 class="mb-3">Admin Profile</h4>

    <div class="p-4">
        <form class="row" method="POST" action="{{ route('admin.profile.save', $admin->id ?? null) }}" enctype="multipart/form-data">
            @csrf

        {{-- Avatar --}}   
        <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <h3 class="mb-4">Profile Photo</h3>
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                 @if (!empty($admin->avatar))
                    <img src="{{ asset('storage/' . $admin->avatar) }}" alt="avatar" width="60" class="doctor_profile img-fluid ">
                @endif
                
                <div class="d-grid ms-3 text-start">
                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                    @error('avatar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <span class="text-sm">Upload a profile photo. JPG, PNG or webP. Max 2MB.</span>
                </div>
              </div>
             
          </div>

            <div class ="card row flex-row flex-wrap custom-card main-card-item primary border-0 p-4 rounded-30">
                {{-- Name --}}
                <div class="mb-3 col-12 col-md-6 col-sm-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $admin->user->name ?? auth()->user()->name) }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3 col-12 col-md-6 col-sm-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $admin->user->email ?? auth()->user()->email) }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
       

                {{-- Password --}}
                <div class="mb-3 col-6">
                    <label for="password" class="form-label">Password <small class="text-muted">(leave blank to keep current)</small></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-3 col-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $admin->phone ?? '') }}" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
      

            {{-- Position --}}
            <div class="mb-3 col-6">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" value="{{ old('position', $admin->position ?? '') }}" class="form-control @error('position') is-invalid @enderror">
                @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Department --}}
            <div class="mb-3 col-6">
                <label  for="department" class="form-label">Department</label>
                <input type="text" name="department" value="{{ old('department', $admin->department ?? '') }}" class="form-control @error('department') is-invalid @enderror">
                @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

    
            {{-- Bio --}}
            <div class="mb-3 col-12">
                <label for="bio" class="form-label">Bio</label>
                 <x-tiny-editor name="bio" id="bio" :value="old('bio', $admin->bio ?? '')" />
                 @error('bio') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            {{-- Submit --}}
            <div class="text-end col-12">
                <button type="submit" class="btn btn-primary w-auto px-4">Save</button>
            </div>
        </div>
        </form>

    </div>
</div>
</x-admin-layout>