<x-admin-layout>
        <div class="container-fluid">

          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h3 class="mb-2">Payments</h3>
              <p class="font-18">A list of all patients in your clinic with their details.</p>
            </div>
          </div>

          <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <h3 class="mb-4">Select Payment Method</h3>
            <div class="row">
                <div class="col-12 col-md-4 col-sm-6">
                <select class="form-select form-control rounded-30" aria-label="Default select example">
                  <option selected>Stripe Mode</option>
                  <option value="1">hgfftr</option>
                  <option value="2">fWWWYTQ9</option>
                 
                </select>
              </div>

              <div class="col-12 col-md-4 col-sm-6">
                <input type="text" class="form-control mb-3 rounded-30" placeholder="Publishable Key">
              </div>
               <div class="col-12 col-md-4 col-sm-6">
                <input type="text" class="form-control mb-3 rounded-30" placeholder="Secret Key">
              </div>
                  <div class="col-12 col-md-4 col-sm-6">
                <input type="text" class="form-control mb-3 rounded-30" placeholder="Webhook Secret">
              </div>


            </div>
            <div class="w-100 d-block">
                <a class="btn btn-primary px-3 rounded-30 me-3" href="#">Submit</a>
          </div>

          </div>
        </div>
</x-admin-layout>
