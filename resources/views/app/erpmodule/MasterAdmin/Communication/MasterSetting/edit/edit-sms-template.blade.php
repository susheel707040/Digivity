<form action="{{url('MasterAdmin/Communication/EditSMSTemplate/'.$smstemplate->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-4">
                <label>SMS Template Name <sup>*</sup> : </label>
                <input type="text" value="{{$smstemplate->template_name}}" id="template_name" name="template_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter SMS Template Name" required>
            </div>

            <div class="col-lg-4">
                <label>SMS Type <span class="text-gray">(optional)</span> : </label>
                @include('component.Communication.sms-type-import',['class'=>'form-control','selectid'=>$smstemplate->sms_type])
            </div>

            <div class="col-lg-2">
                <label>Is Active <sup>*</sup> : </label>
                <table>
                    <tr>
                        <td><input type="radio" name="is_active" value="1" @if($smstemplate->is_active==1) checked @endif></td><td class="pd-l-5">Yes</td>
                        <td class="pd-l-10"><input type="radio" name="is_active" value="0" @if($smstemplate->is_active==0) checked @endif></td><td class="pd-l-5">No</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-2 pd-l-0">
                <label>Unicode <span class="text-gray">(optional)</span> : </label>
                <table>
                    <tr>
                        <td><input type="radio" name="unicode" value="yes" @if($smstemplate->unicode=="yes") checked @endif></td><td class="pd-l-5">Yes</td>
                        <td class="pd-l-10"><input name="unicode" value="no" type="radio" @if($smstemplate->unicode=="no") checked @endif></td><td class="pd-l-5">No</td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-12">
                <label>SMS Template <sup>*</sup> :</label>
                <textarea placeholder="Enter SMS Template" autocomplete="off" name="template" class="form-control" style="height:200px; ">{{$smstemplate->template}}</textarea>
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-pen"></i> Update</button>
    </div>
</form>

