<x-admin-layout>
<div class="container-fluid">
  <div class="mb-3">
  <h3 class="mb-2">Edit Prescription</h3>
  <p class="font-18">Lorem Ipsum is simply dummy text of the printing</p>
  </div>

  <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
  <div class="row">
    <div class="col-12 col-md-6">
      <input type="text" class="form-control mb-3 rounded-30" placeholder="Howard Tanner">
    </div>
    
    <div class="col-12 col-md-6">
       <select class="form-select form-control rounded-30" aria-label="Default select example">
            <option selected>Cardiology</option>
            <option value="1">By earlier orders</option>
            <option value="2">By latest offer</option>
        </select>
    </div>
     <div class="col-12 col-md-12">
     <textarea class="form-control rounded-30" rows="5"></textarea>
    </div>
   
  </div>

  <div class="card custom-card main-card-item primary border-0 p-0 rounded-30">
  <div class="d-flex align-items-center justify-content-between my-4">
    <h3 class="mb-0">Medicines</h3>
    <a class="btn btn-primary rounded-30" href="#">Add Medication</a>
  </div>
  <div class="row">
    <div class="col-12 col-md-6">
      <input type="text" class="form-control mb-3 rounded-30" placeholder="Medication name">
    </div>
      <div class="col-12 col-md-6">
      <input type="text" class="form-control mb-3 rounded-30" placeholder="Dosage">
    </div>
     
    <div class="col-12 col-md-6">
       <select class="form-select form-control rounded-30 mb-3" aria-label="Default select example">
            <option selected>Route</option>
            <option value="1">By earlier orders</option>
            <option value="2">By latest offer</option>
        </select>
    </div>
     <div class="col-12 col-md-6">
       <select class="form-select form-control rounded-30 mb-3" aria-label="Default select example">
            <option selected>Frequency</option>
            <option value="1">Dr. John Doe</option>
            <option value="2">Dr. Jane Smith</option>
        </select>
    </div>
     <div class="col-12 col-md-12">
     <textarea class="form-control rounded-30" rows="5"></textarea>
    </div>
    
  <div class="col-12 text-start mt-4">
    <button class="btn btn-primary rounded-30 px-4">Save</button>
  </div>
  </div>

  </div>
</x-admin-layout>