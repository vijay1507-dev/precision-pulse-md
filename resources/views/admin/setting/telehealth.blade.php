<x-admin-layout>
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h3 class="mb-2">Telehealth Settings</h3>
              <p class="font-18">A list of all patients in your clinic with their details.</p>
            </div>
          </div>

          <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">

            <div class="row">

              <div class="col-12 col-md-6 col-sm-6">
                <Label class="fw=500 fs-5 p-1">Zoom API
                  Key</Label>
                <input type="text" class="form-control mb-3 rounded-30" placeholder="your_zoom_api_key_here">
              </div>
              <div class="col-12 col-md-6 col-sm-6  p-1">
                <Label class="fw=500 fs-5">Zoom API
                  Secret</Label>
                <input type="text" class="form-control mb-3 rounded-30" placeholder="your_zoom_api_secret_here">
              </div>
              <div class="col-12 col-md-6 col-sm-6  p-1">
                <Label class="fw=500 fs-5">Zoom
                  Redirect URL</Label>
                <input type="text" class="form-control mb-3 rounded-30"
                  placeholder="https://yourdomain.com/zoom/callback">
              </div>

              <div class="col-12 col-md-6 col-sm-6  p-1">
                <Label class="fw=500 fs-5">Enable Zoom
                  Integration</Label>
                <div class="container mt-2">
                  <label class="toggle-label ">
                    <div class="toggle-switch me-2">
                      <input type="checkbox" id="customToggle1">
                      <span class="toggle-slider d-flex  align-items-center"> </span>
                    </div>

                  </label>
                </div>
              </div>
              <div class="col-12 col-md-6 col-sm-6 p-1">
                <label for="meetingDuration" class="fw-500 fs-5">
                  Default Meeting Duration (min)
                </label>

                <select id="meetingDuration" class="form-control mb-3 rounded-30">
                  <option value="30">30 min</option>
                  <option value="45">45 min</option>
                  <option value="60">60 min</option>
                </select>
              </div>
            </div>
            <div class="w-100 d-flex justify-content-center">
              <a class="btn btn-primary px-3 rounded-30 me-3" href="#">Save</a>
            </div>
          </div>
        </div>
      <script>
    const toggle = document.getElementById('customToggle1');
    const statusLabel = document.getElementById('toggleStatus');

    toggle.addEventListener('change', function () {
      statusLabel.textContent = this.checked ? 'On' : 'Off';
    });
  </script>

</x-admin-layout>