<x-admin-layout>
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h3 class="mb-2">All Patient</h3>
              <p class="font-18">A list of all patients in your clinic with their details.</p>
            </div>
            <a class="btn btn-primary rounded-30" href="{{route('admin.patient.add')}}">Add Patient</a>
          </div>

          <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <div class="card-header d-flex align-items-center flex-wrap gap-3 bg-transparent border-0 mb-4 p-0">
              <form method="GET" action="{{ route('admin.patients') }}" class="row justify-content-start w-100">
                <div class="col-sm-auto">
                  <div class="form-search position-relative">
                    <i class="ph-duotone ph-magnifying-glass icon-search h-100 top-0 d-flex align-items-center position-absolute" style="left: 15px; z-index: 10;">
                      <svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                          d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                      </svg>
                    </i>
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control ps-5 rounded-30" placeholder="Search by name, phone, email...">
                  </div>
                </div>
                <div class="col-sm-auto">
                  <button type="submit" class="btn btn-primary ">Filter</button>
                </div>
                <div class="col-sm-auto">
                  <a href="{{ route('admin.patients') }}" class="btn btn-outline-secondary ">Clear</a>
                </div>
              </form>
              @if(request()->hasAny(['search', 'gender', 'date_from', 'date_to']))
                <div class="col-12 mt-2">
                  <small class="text-muted">
                    <i class="bi bi-funnel"></i> Active filters:
                    @if(request('search'))
                      <span class="badge bg-primary me-1">Search: "{{ request('search') }}"</span>
                    @endif
                    @if(request('gender') && request('gender') !== 'all')
                      <span class="badge bg-info me-1">Gender: {{ ucfirst(request('gender')) }}</span>
                    @endif
                    @if(request('date_from'))
                      <span class="badge bg-success me-1">From: {{ request('date_from') }}</span>
                    @endif
                    @if(request('date_to'))
                      <span class="badge bg-warning me-1">To: {{ request('date_to') }}</span>
                    @endif
                  </small>
                </div>
              @endif
            </div>
            <div class="table-responsive">
              <table class="table text-nowrap">
                <thead>
                  <tr>
                    <th scope="col"> <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value=""
                        aria-label="..."> </th>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone No</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($patients as  $patient)

                  <tr class="crm-contact">
                    <td> <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value=""
                        aria-label="..."> </td>

                    <td> {{ $loop->iteration + ($patients->currentPage() - 1) * $patients->perPage() }} </td>
                    <td>
                      <a href="appointment-detail.html" class="d-block mb-1">{{ $patient->user->name }}</a>
                    </td>
                    <td>
                      <span class="d-block mb-1">{{ $patient->phone_number }}</span>
                    </td>
                    <td>
                      <span class="d-block">{{ $patient->age }}</span>
                    </td>
                    <td>
                      <span class="d-block">{{ $patient->gender }}</span>
                    </td>
                    <td> <span class="d-block"><span>{{ $patient->date_of_birth }}</span><br> {{ $patient->created_at->format('d-m-Y') }}</span></td>
                    <td>
                      <span class="badge text-bg-primary rounded-pill">Active</span>
                    </td>
                    <td>
                      <li class="nav-item dropdown ms-3">
                        <button data-bs-toggle="dropdown" class="border-0 bg-transparent p-0">
                          <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15.5" cy="15.5" r="15.5" fill="#0078B6" fill-opacity="0.1" />
                            <circle cx="10" cy="16" r="2" fill="#0078B6" />
                            <circle cx="16" cy="16" r="2" fill="#0078B6" />
                            <circle cx="22" cy="16" r="2" fill="#0078B6" />
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">

                          <a href="view-patients.html" class="dropdown-item">View</a>
                          <a href="edit-appointment.html" class="dropdown-item">Edit</a>
                          <a href="#" class="dropdown-item">Delete</a>
                        </div>
                      </li>
                    </td>

                  </tr>
                  @empty
                  <tr>
                    <td colspan="10" class="text-center py-4">
                      <div class="text-muted">
                        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                        @if(request()->hasAny(['search', 'gender', 'date_from', 'date_to']))
                          <p class="mb-0 mt-2">No patients found matching your filters.</p>
                          <p class="text-sm">Try adjusting your search criteria or <a href="{{ route('admin.patients') }}">clear all filters</a>.</p>
                        @else
                          <p class="mb-0 mt-2">No patients found.</p>
                          <p class="text-sm">Start by adding your first patient.</p>
                        @endif
                      </div>
                    </td>
                  </tr>
                  @endforelse
              </tbody>
              </table>
            </div>
            <div class="card-footer border-top-0">
              <div class="d-flex align-items-center">
                <div> 
                  Showing {{ $patients->firstItem() ?? 0 }} to {{ $patients->lastItem() ?? 0 }} of {{ $patients->total() }} entries 
                  <i class="bi bi-arrow-right ms-2 fw-medium"></i> 
                </div>
                @if ($patients->hasPages())
                <div class="ms-auto">
                  <nav aria-label="Page navigation" class="pagination-style-5">
                    <ul class="pagination mb-0">
                      @if ($patients->onFirstPage())
                        <li class="page-item disabled"> 
                          <a class="page-link" href="javascript:void(0);"> Prev </a> 
                        </li>
                      @else
                        <li class="page-item"> 
                          <a class="page-link" href="{{ $patients->previousPageUrl() }}"> Prev </a> 
                        </li>
                      @endif
                      
                      @foreach ($patients->getUrlRange(1, $patients->lastPage()) as $page => $url)
                        @if ($page == $patients->currentPage())
                          <li class="page-item active">
                            <a class="page-link" href="javascript:void(0);">{{ $page }}</a>
                          </li>
                        @else
                          <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                          </li>
                        @endif
                      @endforeach
                      
                      @if ($patients->hasMorePages())
                        <li class="page-item"> 
                          <a class="page-link text-primary" href="{{ $patients->nextPageUrl() }}"> Next </a>
                        </li>
                      @else
                        <li class="page-item disabled"> 
                          <a class="page-link text-primary" href="javascript:void(0);"> Next </a>
                        </li>
                      @endif
                    </ul>
                  </nav>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
</x-admin-layout>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');
      const searchInput = document.querySelector('input[name="search"]');
      if (searchInput) {
          searchInput.addEventListener('keypress', function(e) {
              if (e.key === 'Enter') {
                  e.preventDefault();
                  form.submit();
              }
          });
      }
  });
</script>