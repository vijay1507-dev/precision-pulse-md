<x-admin-layout>
        <div class="container-fluid">
           <div class="d-flex align-items-center flex-wrap justify-content-between">
             <div class="mb-3">
               @if(session('success'))
                      <div  
                        x-data="{ show: true }" 
                        x-show="show" 
                        x-init="setTimeout(() => show = false, 3000)"
                        class="alert alert-success rounded-30 mb-3">
                        {{ session('success') }}
                      </div>
                    @endif
              <h3 class="mb-2">All Doctor</h3>
              <p class="font-16">Browse the list of registered doctors and manage their profiles, availability, and appointments.</p>
            </div>
            <a class="btn btn-primary rounded-30" href="{{route('admin.add-doctor')}}">Add New Doctor</a>
           </div>

         <div class="row doctor-slider-section card custom-card main-card-item primary border-0 p-4 rounded-30">
                <form method="GET" class="row g-2 mb-4 mt-0">
              <div class="col-md-3 mt-0">
                <div class="form-search">
                  <i class="ph-duotone ph-magnifying-glass icon-search h-100 top-0 d-flex align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                      </svg>
                    </i>
                  <input type="text" name="search" value="{{ request('search') }}" class="form-control ps-5 rounded-30" placeholder="Search name or email">
                </div>
               
              </div>

              <div class="col-md-3 mt-0">
                <select name="specialization" class="form-select form-control rounded-30">
                  <option value="">All Specializations</option>
                  <option value="Cardiology" {{ request('specialization') == 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
                  <option value="Dermatology" {{ request('specialization') == 'Dermatology' ? 'selected' : '' }}>Dermatology</option>
                  <!-- Add more options dynamically if you want -->
                </select>
              </div>

              <div class="col-md-4 mt-0 d-flex align-items-center gap-2">
                <button class="btn btn-primary rounded-30" type="submit">Filter</button>
                <a href="{{ route('admin.doctors') }}" class="btn btn-secondary rounded-30">Reset</a>
              </div>
            </form>

            <table class="table table-bordered table-striped align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>
                    <a href="{{ route('admin.doctors', array_merge(request()->all(), ['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}">
                      Name
                      @if(request('sort') == 'name')
                        <i class="bi bi-caret-{{ request('direction') == 'asc' ? 'up' : 'down' }}-fill"></i>
                      @endif
                    </a>
                  </th>
                  <th>Specializations</th>
                  <th>
                    <a href="{{ route('admin.doctors', array_merge(request()->all(), ['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}">
                      Email
                      @if(request('sort') == 'email')
                        <i class="bi bi-caret-{{ request('direction') == 'asc' ? 'up' : 'down' }}-fill"></i>
                      @endif
                    </a>
                  </th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($doctors as $index => $doctor)
                  <tr>
                    <td>{{ $doctors->firstItem() + $index }}</td>
                    <td>
                      <img src="{{ $doctor->profile_photo ? asset('storage/' . $doctor->profile_photo) : asset('assets/images/profile.jpg') }}"
                       class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                      <strong class="ms-2">  {{ $doctor->user->name }} {{ $doctor->user->last_name }} </strong></td>
                    <td>
                      @foreach($doctor->specializations ?? [] as $spec)
                        <span class="badge bg-primary">{{ $spec }}</span>
                      @endforeach
                    </td>
                    <td>{{ $doctor->user->email }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>
                      @if($doctor->availability && $doctor->availability->is_available)
                        <span class="badge bg-success">Available</span>
                      @else
                        <span class="badge bg-secondary">Unavailable</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('admin.doctor.show', $doctor->id) }}" class="btn btn-info btn-sm">View</a>
                      <a href="{{ route('admin.doctor.edit', $doctor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="8" class="text-center">No doctors found.</td></tr>
                @endforelse
              </tbody>
            </table>
            <div class="card-footer border-top-0">
                        {{ $doctors->links() }}
            </div>
            </div>
         </div>
</x-admin-layout>