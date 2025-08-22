<x-admin-layout>
      @php  $imagesbase = asset('assets/images/'); @endphp
    <div class="container-fluid">
          <div class="mb-3">
            <h3>Dashboard</h3>
            <p class="font-18">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
              has been the industry.</p>
          </div>

          <div class="row dashboard_cards">
            <div class="col-xl-3">
              <x-admin.stat-card 
                title="Revenue" 
                value="$45,231.80" 
                icon="assets/images/refund.svg"
               />
            </div>
            <div class="col-xl-3">
              <x-admin.stat-card 
                title="Appointments" 
                value="+2,351" 
                icon="assets/images/appointment.svg"
              />
            </div>
            <div class="col-xl-3">
              <x-admin.stat-card 
                title="Today’s Schedule" 
                value="+122" 
                icon="assets/images/refund.svg"
              />
            </div>
            <div class="col-xl-3">
              <x-admin.stat-card 
                title="Total Patient" 
                value="+1,251" 
                icon="assets/images/medical-team.svg"
              />
            </div>
          </div>

          <!-- Dashboard-main -->
          <div class="row">
            <div class="col-12 col-md-6">
              <x-admin.chart-card title="Patients" />
            </div>
            <div class="col-12 col-md-6">
              <x-admin.chart-card title="Revenue" />
            </div>
          </div>
          <div class="row">
              <div class="col-12 col-md-6">
                 <x-admin.appointment-list-card
                    title="Today’s Schedule"
                    link="/appointments"
                    :appointments="[
                        ['name' => 'Calvin Carlo', 'image' => 'assets/images/profile.jpg', 'date' => now(), 'label' => 'TODAY'],
                        ['name' => 'Sarah Kumar', 'image' => 'assets/images/profile.jpg', 'date' => now(), 'label' => 'TODAY'],
                    ]"
                />
              </div>
              <div class="col-12 col-md-6">
                  <x-admin.appointment-list-card
                      title="Upcoming Appointments"
                      link="/appointments"
                      :appointments="[
                          ['name' => 'Mohit Singh', 'image' => 'assets/images/profile.jpg', 'date' => now()->addDays(2), 'label' => 'UPCOMING'],
                          ['name' => 'Ayesha Khan', 'image' => 'assets/images/profile.jpg', 'date' => now()->addDays(5), 'label' => 'UPCOMING'],
                      ]"
                  />
              </div>
        </div>
    </div>
</x-admin-layout>
