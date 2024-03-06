<form action="{{url('/MasterAdmin/FrontOffice/CreateEntryEnquiry')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="col-lg-12 pd-l-10 pd-r-10 m-0 row mx-auto">
        <div class="col-lg-8 pd-b-20 row m-0 p-0">
            <div class="col-lg-3 pd-l-5 pd-r-5">
                <label>Purpose <sup>*</sup> :</label>
                @include('components.FrontOffice.purpose-import')
            </div>
        </div>
        <div class="col-lg-4 pd-l-0 pd-b-15 pd-r-0 vhr">
            @include('components.FrontOffice.web-camera-import')
        </div>
    </div>

</form>
