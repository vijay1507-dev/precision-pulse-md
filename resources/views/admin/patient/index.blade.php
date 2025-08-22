<x-admin-layout>
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h3 class="mb-2">All Patient</h3>
              <p class="font-18">A list of all patients in your clinic with their details.</p>
            </div>
            <a class="btn btn-primary rounded-30" href="add-patient.html">Add Patient</a>
          </div>

          <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <div class="card-header d-flex align-items-center flex-wrap gap-3 bg-transparent border-0 mb-4 p-0">
              <div class="row justify-content-start">
                <div class="col-sm-auto">
                  <form class="form-search">
                    <i class="ph-duotone ph-magnifying-glass icon-search h-100 top-0 d-flex align-items-center">
                      <svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                          d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                      </svg>
                    </i>
                    <input type="search" class="form-control ps-5 rounded-30" placeholder="Search...">
                  </form>
                </div>
              </div>
              <div class="col-sm-auto">
                <select class="form-select form-control rounded-30" aria-label="Default select example">
                  <option selected>Filter by Role</option>
                  <option value="1">By earlier orders</option>
                  <option value="2">By latest offer</option>
                </select>
              </div>
              <div class="col-sm-auto">
                <select class="form-select form-control rounded-30" aria-label="Default select example">
                  <option selected>Filter by Date Range</option>
                  <option value="1">By earlier orders</option>
                  <option value="2">By latest offer</option>
                </select>
              </div>
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
                    <th scope="col">Date & Time</th>
                    <th scope="col">Reason for Vist</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="crm-contact">
                    <td> <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value=""
                        aria-label="..."> </td>

                    <td> 156 </td>
                    <td>
                      <a href="appointment-detail.html" class="d-block mb-1">Howard</a>
                    </td>
                    <td>
                      <span class="d-block mb-1">+1‑415‑123‑4567</span>
                    </td>
                    <td>
                      <span class="d-block">45</span>
                    </td>
                    <td> <span class="d-block"><span>10:30 AM</span><br> 30-12-2024</span></td>
                    <td>
                      <span class="d-block">Cardiology</span>
                    </td>
                    <td>
                      <span class="d-block mb-1">Dr. Calvin Carlo</span>
                    </td>
                    <td>
                      <span class="badge text-bg-primary rounded-pill">Pending</span>
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
                  <tr class="crm-contact">
                    <td> <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value=""
                        aria-label="..."> </td>

                    <td> 156 </td>
                    <td>
                      <a href="appointment-detail.html" class="d-block mb-1">Howard</a>
                    </td>
                    <td>
                      <span class="d-block mb-1">+1‑415‑123‑4567</span>
                    </td>
                    <td>
                      <span class="d-block">45</span>
                    </td>
                    <td> <span class="d-block"><span>10:30 AM</span><br> 30-12-2024</span></td>
                    <td>
                      <span class="d-block">Cardiology</span>
                    </td>
                    <td>
                      <span class="d-block mb-1">Dr. Calvin Carlo</span>
                    </td>
                    <td>
                      <span class="badge text-bg-primary rounded-pill">Pending</span>
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
                  <tr class="crm-contact">
                    <td> <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value=""
                        aria-label="..."> </td>

                    <td> 156 </td>
                    <td>
                      <a href="appointment-detail.html" class="d-block mb-1">Howard</a>
                    </td>
                    <td>
                      <span class="d-block mb-1">+1‑415‑123‑4567</span>
                    </td>
                    <td>
                      <span class="d-block">45</span>
                    </td>
                    <td> <span class="d-block"><span>10:30 AM</span><br> 30-12-2024</span></td>
                    <td>
                      <span class="d-block">Cardiology</span>
                    </td>
                    <td>
                      <span class="d-block mb-1">Dr. Calvin Carlo</span>
                    </td>
                    <td>
                      <span class="badge text-bg-success rounded-pill">Pending</span>
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
                  <tr class="crm-contact">
                    <td> <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value=""
                        aria-label="..."> </td>

                    <td> 156 </td>
                    <td>
                      <a href="appointment-detail.html" class="d-block mb-1">Howard</a>
                    </td>
                    <td>
                      <span class="d-block mb-1">+1‑415‑123‑4567</span>
                    </td>
                    <td>
                      <span class="d-block">45</span>
                    </td>
                    <td> <span class="d-block"><span>10:30 AM</span><br> 30-12-2024</span></td>
                    <td>
                      <span class="d-block">Cardiology</span>
                    </td>
                    <td>
                      <span class="d-block mb-1">Dr. Calvin Carlo</span>
                    </td>
                    <td>
                      <span class="badge text-bg-primary rounded-pill">Pending</span>
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
                  <tr class="crm-contact">
                    <td> <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value=""
                        aria-label="..."> </td>

                    <td> 156 </td>
                    <td>
                      <a href="appointment-detail.html" class="d-block mb-1">Howard</a>
                    </td>
                    <td>
                      <span class="d-block mb-1">+1‑415‑123‑4567</span>
                    </td>
                    <td>
                      <span class="d-block">45</span>
                    </td>
                    <td> <span class="d-block"><span>10:30 AM</span><br> 30-12-2024</span></td>
                    <td>
                      <span class="d-block">Cardiology</span>
                    </td>
                    <td>
                      <span class="d-block mb-1">Dr. Calvin Carlo</span>
                    </td>
                    <td>
                      <span class="badge text-bg-primary rounded-pill">Pending</span>
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
                  <tr class="crm-contact">
                    <td> <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value=""
                        aria-label="..."> </td>

                    <td> 156 </td>
                    <td>
                      <a href="appointment-detail.html" class="d-block mb-1">Howard</a>
                    </td>
                    <td>
                      <span class="d-block mb-1">+1‑415‑123‑4567</span>
                    </td>
                    <td>
                      <span class="d-block">45</span>
                    </td>
                    <td> <span class="d-block"><span>10:30 AM</span><br> 30-12-2024</span></td>
                    <td>
                      <span class="d-block">Cardiology</span>
                    </td>
                    <td>
                      <span class="d-block mb-1">Dr. Calvin Carlo</span>
                    </td>
                    <td>
                      <span class="badge text-bg-primary rounded-pill">Pending</span>
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
              </tbody>
              </table>
            </div>
            <div class="card-footer border-top-0">
              <div class="d-flex align-items-center">
                <div> Showing 10 Entries <i class="bi bi-arrow-right ms-2 fw-medium"></i> </div>
                <div class="ms-auto">
                  <nav aria-label="Page navigation" class="pagination-style-5">
                    <ul class="pagination mb-0">
                      <li class="page-item disabled"> <a class="page-link" href="javascript:void(0);"> Prev </a> </li>
                      <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                      <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a>
                      </li>
                      <li class="page-item"> <a class="page-link text-primary" href="javascript:void(0);"> next </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
</x-admin-layout>