<form @if(isset($holiday)&&($holiday->id)) action="{{url('MasterAdmin/Attendance/EditHoliday/'.$holiday->id.'/edit')}}" @else action="{{url('MasterAdmin/Attendance/StoreHoliday')}}" @endif method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-3">
                <label>Holiday For <sup>*</sup> : </label>
                <table>
                    <tr>
                        <td><input type="checkbox" name="for_student" value="1"  @if(isset($holiday)&&($holiday->for_student==1)) checked @endif @if(!isset($holiday)) checked @endif></td><td class="pd-l-5">Student</td>
                        <td class="pd-l-15"><input type="checkbox" name="for_staff" value="1" @if(isset($holiday)&&($holiday->for_staff==1)) checked @endif @if(!isset($holiday)) checked @endif></td><td class="pd-l-5">Staff</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-3">
                <label>Alias/Symbol:</label>
                <input type="text" class="form-control" name="symbol" value="HL" @if(isset($holiday)&&($holiday)) value="{{$holiday->symbol}}" @endif placeholder="Enter Alias/Holiday" required>
            </div>
            <div class="col-lg-6">
                <label>Holiday :</label>
                <input type="text" class="form-control" name="holiday" @if(isset($holiday)&&($holiday)) value="{{$holiday->holiday}}" @endif placeholder="Enter Holiday" required>
            </div>
            <div class="col-lg-12">
                <label>Description :</label>
                <textarea class="form-control" name="description" placeholder="Enter Holiday Description">@if(isset($holiday)&&($holiday)) {{$holiday->description}} @endif</textarea>
            </div>
            <div class="col-lg-3">
                <label>Holiday From Date:</label>
                <input type="text" class="form-control date" name="holiday_from_date" @if(isset($holiday)&&($holiday)) value="{{nowdate($holiday->holiday_from_date,'d-m-Y')}}" @else value="{{nowdate('','d-m-Y')}}" @endif placeholder="dd-mm-yyy" required>
            </div>
            <div class="col-lg-3">
                <label>Holiday To Date:</label>
                <input type="text" class="form-control date" name="holiday_to_date" @if(isset($holiday)&&($holiday)) value="{{nowdate($holiday->holiday_to_date,'d-m-Y')}}" @else value="{{nowdate('','d-m-Y')}}" @endif placeholder="dd-mm-yyy" required>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> @if(isset($holiday)&&($holiday)) <i class="fa fa-edit"></i> Update @else <i class="fa fa-plus"></i> Save @endif</button>
    </div>
</form>

