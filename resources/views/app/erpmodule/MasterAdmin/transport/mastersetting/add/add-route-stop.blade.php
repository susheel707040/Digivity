<form action="{{url('MasterAdmin/Transport/CreateRouteStop')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">

            <div class="col-lg-3">
                <label>Sequence : </label>
                <select id="sequence" name="sequence" class="form-control input-sm">
                    <option value="0">---Select---</option>
                    @for($i=1;$i<=100;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-3">
                <label>Stop No. : </label>
                <input type="text" id="stop_no" name="stop_no" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Stop Number">
            </div>

            <div class="col-lg-6">
                <label>Route Stop Name<sup>*</sup> : </label>
                <input type="text" id="route_stop" name="route_stop" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Route Stop Name">
            </div>

            <div class="col-lg-6">
                <label>Route Stop Longitude and Latitude <span class="text-gray">(Optional)</span> : </label>
                <div class="row p-0 m-0">
                    <div class="col-6 pd-l-0 pd-r-10 m-0">
                        <input type="text" id="longitude" name="longitude" autocomplete="off"
                               class="form-control input-sm" placeholder="Longitude">
                    </div>

                    <div class="col-6 pd-l-5">
                        <input type="text" id="latitude" name="latitude" autocomplete="off"
                               class="form-control input-sm" placeholder="Latitude">
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <label>Map Api Url <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="map_api_url" name="map_api_url" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Map Api Url">
            </div>

            <div class="col-lg-6">
                <label>School to Stop Distance (km) <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="school_to_stop_distance" name="school_to_stop_distance" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter School to Route Distance (km)">
            </div>

            <div class="col-lg-6">
                <label>Stop to School Distance (km) <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="stop_to_school_distance" name="stop_to_school_distance" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Route to School Distance">
            </div>

            <div class="col-lg-12">
                <label>Note <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="note" id="note" placeholder="Enter Note"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

