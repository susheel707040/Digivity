<script type="text/javascript" src="{{url('/assets/lib/colorpicker/spectrum.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/assets/lib/colorpicker/spectrum.css')}}">

<form action="{{url('MasterAdmin/App/CreateCalendarType')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0  m-0">
            <div class="col-lg-6 pd-t-10">
                <label><b>Calendar Type <sup>*</sup> :</b></label>
                <input type="text" name="calendar_type" required placeholder="Enter Calendar Type" class="form-control">
            </div>
            <div class="col-lg-6 pd-t-10">
                <label><b>Priority <sup>*</sup> : </b></label>
                <select name="priority" required class="form-control input-sm">
                    @for($i=1;$i<=100;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-lg-6 pd-t-10">
                <label><b>Color Code <sup>*</sup> :</b></label>
                <input type="text" name="color" id="color-picker" placeholder="Enter Color Code" value="#eeeeee" class="form-control">
            </div>
            <div class="col-lg-6 pd-t-10">
                <label><b>Status <sup>*</sup> :</b></label>
                <table>
                    <tr>
                        <td><input type="radio" name="status" value="yes" checked></td><td class="pd-l-5">Active</td>
                        <td class="pd-l-10"><input type="radio" name="status" value="no"></td><td class="pd-l-5">In-Active</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>
<script>
    $('#color-picker').spectrum({
        type: "text",
        showInput: "true",
        showInitial: "true"
    });
</script>

