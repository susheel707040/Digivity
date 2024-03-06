<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div data-label="Example" class="df-example container-fluid">
        <div class="tab-content mg-t-5" id="myTabContent5">
            <div class="tab-pane fade active show" id="home5" role="tabpanel" aria-labelledby="home-tab5">
                @include('app.erpmodule.MasterAdmin.Dashboard.DashboardAnalytics')
            </div>
            <div class="tab-pane fade " id="profile5" role="tabpanel" aria-labelledby="profile-tab5">
                @include('app.erpmodule.MasterAdmin.Dashboard.DashboardModule')
            </div>
            <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab5">
                @include('app.erpmodule.MasterAdmin.Dashboard.DashboardSiteMap')
            </div>
        </div>
    </div>
</div>
