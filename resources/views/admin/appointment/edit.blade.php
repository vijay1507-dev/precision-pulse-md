<x-admin-layout>
<div class="container-fluid">
<div class="mb-3">
<h3 class="mb-2">Edit an Appointment</h3>
<p class="font-18">Schedule a new appointment for a patient.</p>
</div>

<div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
 <div class="row">
    <div class="col-12 col-md-4 col-sm-6">
      <input type="text" class="form-control mb-3 rounded-30" placeholder="Name">
    </div>
      <div class="col-12 col-md-4 col-sm-6">
      <input type="text" class="form-control mb-3 rounded-30" placeholder="+1 (123) 456-7890">
    </div>
      <div class="col-12 col-md-4 col-sm-6">
      <input type="text" class="form-control mb-3 rounded-30" placeholder="Email Id">
    </div>
     <div class="col-12 col-md-4 col-sm-6">
      <input type="date" class="form-control mb-3 rounded-30" placeholder="Preferred Date & Time">
    </div>
    
    <div class="col-12 col-md-4 col-sm-6">
       <select class="form-select form-control rounded-30" aria-label="Default select example">
            <option selected>Filter by Date Range</option>
            <option value="1">By earlier orders</option>
            <option value="2">By latest offer</option>
        </select>
    </div>
     <div class="col-12 col-md-4 col-sm-6">
       <select class="form-select form-control rounded-30" aria-label="Default select example">
            <option selected>Select doctor</option>
            <option value="1">Dr. John Doe</option>
            <option value="2">Dr. Jane Smith</option>
        </select>
    </div>
     <div class="col-12 col-md-4 col-sm-6">
      <input type="text" class="form-control mb-3 rounded-30" placeholder="Age">
    </div>
     <div class="col-12 col-md-12">
     <label class="file_upload_wrapper">
      <input type="file" class="form-control file_upload" />
      <div class="file_upload_content">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4" />
        </svg>
        <span>Upload prior lab reports or documents (optional)</span>
      </div>
    </label>
    </div>
 </div>
 <div class="col-12 text-center mt-4">
    <button class="btn btn-primary rounded-30 px-4">Next</button>
 </div>
</div>
<div class="mt-5 d-flex align-items-center justify-content-center gap-3">
<a class="btn btn-primary rounded-30" href="#">Click Here to Join Zoom Call</a>
<a class="btn btn-success rounded-30" href="#">Test Zoom Call</a>
<a class="btn text-white bg-darkblue rounded-30" href="#">Intake Form</a>
<a class="btn btn-outline-primary rounded-30" href="#">Add Prescription</a>
</div>
</div>
</x-admin-layout>