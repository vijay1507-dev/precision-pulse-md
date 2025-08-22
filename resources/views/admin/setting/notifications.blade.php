<x-admin-layout>
                <div class="container-fluid">

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h3 class="mb-2">Notifications</h3>
                            <p class="font-18">Lorem Ipsum is simply dummy text of the printing</p>
                        </div>
                    </div>

<!-- Step 1 (initially visible) -->
<div id="step1" class="row g-2 align-items-stretch">
    <!-- Left Card -->
    <div class="col-12 col-md-4 d-flex">
        <div class="bg-white main-card-item border-0 rounded-3 py-3 w-100">
            <div class="border-bottom p-0">
                <p class="fs-6 fw-semibold px-3 bluecolor" >
                    Registration Appointment Template
                </p>
            </div>
            <div class="border-bottom p-0">
                <p class="fs-6 fw-normal pt-4 px-3" >
                    Appointment Mail Template
                </p>
            </div>
            <div class="border-bottom pt-3 px-3">
                <p class="fs-6 fw-normal" >
                    Prescription Mail
                </p>
            </div>
        </div>
    </div>

    <!-- Right Card -->
    <div class="col-12 col-md-8 d-flex">
        <div class="bg-white custom-card main-card-item border-0 p-4 rounded-3 w-100">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <input type="text" class="form-control rounded-30" placeholder="Recipient(s)">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <input type="text" class="form-control rounded-30" placeholder="Subject">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <input type="text" class="form-control rounded-30" placeholder="CC(s)">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <input type="text" class="form-control rounded-30" placeholder="BCC(s)">
                </div>
                <div contenteditable="true" class="form-control bg-skyblue rounded-30 p-3 mb-3"
                   >
                    Dear {User Name},<br><br>
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry...<br><br>
                    Thanks and Regards,<br>
                    User Name
                </div>
            </div>
        </div>
    </div>
</div>
<div id="step2" class="row g-2 align-items-stretch" style="display: none;">
    <!-- Content for step 2 goes here -->
     <div class="card custom-card main-card-item primary border-0 p-4 rounded-30">
            <div class="row">
              <div class="col-12 col-md-4 col-sm-6">
                <select class="form-select form-control rounded-30 border-0" aria-label="Default select example">
                  <option selected>Patient Name</option>
                  <option value="1">sukh</option>
                  <option value="2">jass</option>
                </select>
              </div>

            </div>

            <div class="card py-2 mt-4" style="width: 25rem;">
              <div>
                <div class="p-2">
                  <div class="search-container d-flex align-items-center  bg-skyblue rounded-30 px-3 "
                 >
                    <img src="./image/search-interface-symbol 1.png" alt="Search icon" class="me-2" width="20"
                      height="20">
                    <input type="search" class="form-control border-0 p-0" placeholder="Search...">
                  </div>
                </div>
                <div class="border-bottom mt-3">
                  <p class=" fw-semibold fs-6 p-2 px-3" >Howard</p>
                </div>
                <div class="border-bottom mt-3">
                  <p class=" fw-semibold fs-6 p-2 px-3">Calvin</p>
                </div>
                <div class="border-bottom mt-3">
                  <p class=" fw-semibold fs-6 p-2 px-3" >Cristino</p>
                </div>
                <div class="border-bottom mt-3">
                  <p class=" fw-semibold fs-6p-2 px-3" >Toni Kovar</p>
                </div>
              </div>
            </div>
          </div>
          <div>
           <a  class="btn btn-primary px-3 rounded-30 me-3">Send</a>
           </div>
</div>

<div class="w-100 mt-3">
    <!-- Step 1 button - hides when clicked -->
    <a id="step1Button" class="btn btn-primary px-3 rounded-30 me-3" href="javascript:void(0);" onclick="goToStep2()">Send to Patient</a>
    <!-- Step 2 button - initially hidden -->
    </div>
</div>
<script>
function goToStep2() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'flex';
    document.getElementById('step1Button').style.display = 'none';
    document.getElementById('step2Button').style.display = 'inline-block';
}

function goToStep1() {
    document.getElementById('step1').style.display = 'flex';
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1Button').style.display = 'inline-block';
    document.getElementById('step2Button').style.display = 'none';
}
</script>
</x-admin-layout>