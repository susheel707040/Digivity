<form action="{{url('MasterAdmin/Transport/EditVehicle/'.$vehicle->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Vehicle Type <sup>*</sup> : </label>
                <select class="form-control input-sm" name="vehicle_type_id" id="vehicle_type_id">
                    <option value="0">---Select---</option>
                    @foreach($vehicletype as $data)
                        <option value="{{$data->id}}" @if($vehicle->vehicle_type_id==$data->id) selected @endif>{{$data->vehicle_type}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-6">
                <label>Vehicle Name <sup>*</sup> : </label>
                <input type="text" value="{{$vehicle->vehicle_name}}" placeholder="Enter Vehicle Name" class="form-control input-sm" name="vehicle_name" id="vehicle_name">
            </div>

            <div class="col-lg-6">
                <label>Reg. No. <sup>*</sup> : </label>
                <input type="text" value="{{$vehicle->registration_no}}" placeholder="Enter Registration Number" class="form-control input-sm" name="registration_no" id="registration_no">
            </div>

            <div class="col-lg-6">
                <label>Reg. Date <sup>*</sup> : </label>
                <input type="text" value="{{$vehicle->registration_date}}" placeholder="Enter Registration Date" class="form-control input-sm" name="registration_date" id="registration_date">
            </div>

            <div class="col-lg-6">
                <label>No. of Seat <span class="text-gray">(optional)</span> : </label>
                <input type="text" value="{{$vehicle->no_of_seat}}" placeholder="Enter No. of Seat" class="form-control input-sm" name="no_of_seat" id="no_of_seat">
            </div>

            <div class="col-lg-6">
                <label>Max Seat Allow <span class="text-gray">(optional)</span> : </label>
                <input type="text"  value="{{$vehicle->max_allow}}" placeholder="Enter Max Seat Allow" class="form-control input-sm" name="max_allow" id="max_allow">
            </div>

            <div class="col-lg-6">
                <label>Mileage(km) <span class="text-gray">(optional)</span> : </label>
                <input type="text" value="{{$vehicle->mileage_km}}" placeholder="Enter Mileage (kilometer)" class="form-control input-sm" name="mileage_km" id="mileage_km">
            </div>

            <div class="col-lg-6">
                <label>Fuel Type <span class="text-gray">(optional)</span> : </label>
                <select name="fuel_type" id="fuel_type" class="form-control">
                    <option value="petrol" @if($vehicle->fuel_type=="petrol") selected @endif>Petrol</option>
                    <option value="diesel" @if($vehicle->fuel_type=="diesel") selected @endif>Diesel</option>
                    <option value="cng" @if($vehicle->fuel_type=="cng") selected @endif>Petrol & Cng</option>
                    <option value="lpg" @if($vehicle->fuel_type=="lpg") selected @endif>Petrol & Lpg</option>
                    <option value="electric" @if($vehicle->fuel_type=="electric") selected @endif>Electric</option>
                </select>
            </div>

            <div class="col-lg-6">
                <label>Vehicle Owner Name <span class="text-gray">(optional)</span> : </label>
                <input type="text"  value="{{$vehicle->owner_name}}" placeholder="Enter Vehicle Owner Name" class="form-control input-sm" name="owner_name" id="owner_name">
            </div>
            <div class="col-lg-6">
                <label>Mobile No. <span class="text-gray">(optional)</span> : </label>
                <input type="text"  value="{{$vehicle->mobile_no}}" placeholder="Enter Mobile Number" class="form-control input-sm" name="mobile_no" id="mobile_no">
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

