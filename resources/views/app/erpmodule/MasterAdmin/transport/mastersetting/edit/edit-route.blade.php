<form action="{{url('MasterAdmin/Transport/EditRoute/'.$route->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">

            <div class="col-lg-6">
                <label>Sequence <sup>*</sup> : </label>
                <select id="sequence" name="sequence" class="form-control input-sm">
                    <option value="0">---Select---</option>
                    @for($i=1;$i<=100;$i++)
                        <option value="{{$i}}" @if($route->sequence==$i) selected @endif>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-6">
                <label>Route <sup>*</sup> : </label>
                <input type="text" id="route" name="route" autocomplete="off"
                     value="{{$route->route}}"  class="form-control input-sm" placeholder="Enter Route">
            </div>

            <div class="col-lg-6">
                <label>Route Longitude and Latitude <span class="text-gray">(Optional)</span> : </label>
                <div class="row p-0 m-0">
                    <div class="col-6 pd-l-0 pd-r-10 m-0">
                        <input type="text" id="longitude" name="longitude" autocomplete="off"
                               value="{{$route->longitude}}"  class="form-control input-sm" placeholder="Longitude">
                    </div>

                    <div class="col-6 pd-l-5">
                        <input type="text" id="latitude" name="latitude" autocomplete="off"
                               value="{{$route->latitude}}"  class="form-control input-sm" placeholder="Latitude">
                    </div>

                </div>
            </div>


            <div class="col-lg-6">
                <label>Map Api Url <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="map_api_url" name="map_api_url" autocomplete="off"
                       value="{{$route->map_api_url}}"   class="form-control input-sm" placeholder="Enter Map Api Url">
            </div>

            <div class="col-lg-6">
                <label>School to Route Distance (km) <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="school_to_route_distance" name="school_to_route_distance" autocomplete="off"
                       value="{{$route->school_to_route_distance}}" class="form-control input-sm" placeholder="Enter School to Route Distance (km)">
            </div>

            <div class="col-lg-6">
                <label>Route to School Distance (km) <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="route_to_school_distance" name="route_to_school_distance" autocomplete="off"
                       value="{{$route->route_to_school_distance}}"  class="form-control input-sm" placeholder="Enter Route to School Distance">
            </div>

            <div class="col-lg-12">
                <label>Note <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="note" id="note" placeholder="Enter Note">{{$route->note}}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

