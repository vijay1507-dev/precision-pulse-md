<x-admin-layout>
@php  $imagesbase = asset('assets/images/'); @endphp
<div class="container-fluid">
    <div class="mb-3">
       <h3 class="mb-2">Appointment Detail</h3>
       <p class="font-18">Lorem Ipsum is simply dummy text of the printing</p>
     </div>

  <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
         <div class="row">
            <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/user.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Name</span>
                  <span class="text-dark">Howard Tanner</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/phone.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Phone No.</span>
                  <span class="text-dark">+1‑415‑123‑4567</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/date.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Date & Time</span>
                  <span class="text-dark">May 14, 2025/2:30pm</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/check.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Reason</span>
                  <span class="text-dark">Cardiology</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/doctor.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Doctor Name</span>
                  <span class="text-dark">Dr. Calvin Carlo</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/date.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Appointment Status</span>
                  <span class="badge text-bg-success rounded-pill w-fit-content">Complete</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/price.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Payment Status</span>
                  <span class="badge text-bg-danger rounded-pill w-fit-content">Pending</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <img src="{{$imagesbase}}/price.png" class="avatar img-fluid  " alt="">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Total Payment</span>
                  <span class="text-dark">$59.00</span>
                </div>
              </div>
            </div>

         </div>
      
  </div>

  <div class="mt-4">
     <h3 class="mb-3">Attached File</h3>
      <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
      <div class="row">
        <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
          <div class="nav-icon pe-md-0 d-flex align-items-center">
            <img src="{{$imagesbase}}/pdf.png" class="avatar img-fluid  " alt="">
            <div class="d-grid ms-3 text-start">
              <span class="text-dark mb-1 fs-medium h6">Lorem Ipsum is<br>
              simply dummy</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
          <div class="nav-icon pe-md-0 d-flex align-items-center">
            <img src="{{$imagesbase}}/pdf.png" class="avatar img-fluid  " alt="">
            <div class="d-grid ms-3 text-start">
              <span class="text-dark mb-1 fs-medium h6">Lorem Ipsum is<br>
              simply dummy</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
          <div class="nav-icon pe-md-0 d-flex align-items-center">
            <img src="{{$imagesbase}}/pdf.png" class="avatar img-fluid  " alt="">
            <div class="d-grid ms-3 text-start">
              <span class="text-dark mb-1 fs-medium h6">Lorem Ipsum is<br>
              simply dummy</span>
            </div>
          </div>
        </div>

      </div>
  
    </div>
  </div>
  <div class="mt-4">
      <h3 class="mb-3">Medical History</h3>
      <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
         <div class="row">
            <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Blood Group</span>
                  <span class="text-dark">A+</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Current Medications</span>
                  <span class="text-dark">Lorem Ipsum is simply</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-4 pb-3">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Past Surgeries</span>
                  <span class="text-dark">Lorem Ipsum is simply</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Allergies</span>
                  <span class="text-dark">Lorem Ipsum is simply</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Family Medical History</span>
                  <span class="text-dark">Diabetes</span>
                </div>
              </div>
            </div>
             <div class="col-12 col-md-4 col-sm-6 mb-0 pb-0">
              <div class="nav-icon pe-md-0 d-flex align-items-center">
                <div class="d-grid ms-3 text-start">
                  <span class="text-dark mb-1 fs-medium h6">Lifestyle Information</span>
                  <span class="text-dark">Smoking</span>
                </div>
              </div>
            </div>

         </div>
      
  </div>
  </div>
  <div class="mt-4">
     <h3 class="mb-3">Patient Snapshot</h3>
    <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
     </div>
  </div>

  <div class="mt-5 d-flex align-items-center justify-content-center gap-3">
      <a class="btn btn-primary rounded-30" href="#">Click Here to Join Zoom Call</a>
      <a class="btn btn-success rounded-30" href="#">Test Zoom Call</a>
      <a class="btn text-white bg-darkblue rounded-30" href="#">Intake Form</a>
      <a class="btn btn-outline-primary rounded-30" href="add-prescription.html">Add Prescription</a>
  </div>
</div>
</x-admin-layout>