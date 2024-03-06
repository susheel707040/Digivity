<form action="{{url('MasterAdmin/Finance/EditFeeHead/'.$feehead->id.'/edit')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Fee Head <sup>*</sup> : </label>
                <input type="text" id="fee_head" name="fee_head" autocomplete="off"
                     value="{{$feehead->fee_head}}"  class="form-control input-sm" placeholder="Enter Fee Account" required="">
            </div>
            <div class="col-lg-6">
                <label>Print line 1 <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="print_line_one" name="print_line_one" autocomplete="off"
                      value="{{$feehead->print_line_one}}" class="form-control input-sm" placeholder="Enter Print line 1">
            </div>

            <div class="col-lg-6">
                <label>Print line 2 <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="print_line_two" name="print_line_two" autocomplete="off"
                       value="{{$feehead->print_line_two}}"  class="form-control input-sm" placeholder="Enter Print line 2">
            </div>
            <div class="col-lg-6">
                <label>Type <span class="text-gray">(Optional)</span> : </label>
                <select class="form-control input-sm" id="type" name="type">
                    <option value="">---Select---</option>
                    @foreach($feetype as $data)
                        <option value="{{$data}}" @if($feehead->type==$data) selected @endif>{{ucfirst($data)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6">
                <table cellspacing="0" cellpadding="0" class="p-0 m-0">
                    <tr>
                        <td>
                            <label>Refund <sup>*</sup> :</label>
                        </td>
                        <td class="pd-l-20">
                            <label>Apply <sup>*</sup> :</label>
                        </td>
                        <td class="pd-l-20">
                            <label>Custom Fee Head<sup>*</sup> :</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td><input type="radio" id="refund" name="refund" value="yes" @if($feehead->refund=="yes") checked @endif></td>
                                    <td class="pd-l-5">Yes</td>
                                    <td class="pd-l-5"><input type="radio" id="refund" name="refund" value="no" @if($feehead->refund=="no") checked @endif></td>
                                    <td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </td>
                        <td class="pd-l-20">
                            <table>
                                <tr>
                                    <td><input type="radio" name="apply" value="yes" @if($feehead->apply=="yes") checked @endif></td>
                                    <td class="pd-l-5">Yes</td>
                                    <td class="pd-l-5"><input type="radio" name="apply" value="no" @if($feehead->apply=="no") checked @endif></td>
                                    <td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </td>
                        <td class="pd-l-20">
                            <table>
                                <tr>
                                    <td><input type="radio" id="refund" name="fee_custom" value="yes" @if($feehead->fee_custom=="yes") checked @endif></td>
                                    <td class="pd-l-5">Yes</td>
                                    <td class="pd-l-5"><input type="radio" id="refund" name="fee_custom" value="no"  @if($feehead->fee_custom=="no") checked @endif></td>
                                    <td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-6">
                <label>Priority <sup>*</sup> :</label>
                <select name="priority" id="priority" class="form-control input-sm" required>
                    @for($i=1;$i<=40;$i++)
                        <option>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-4">
                <label>Fee use in Prospectus/Form Sale <sup>*</sup> :</label>
                <table>
                    <tr>
                        <td><input type="radio" name="form_sale" value="yes" @if($feehead->form_sale=="yes") checked @endif></td><td class="pd-l-5">Yes</td>
                        <td class="pd-l-5"><input type="radio" name="form_sale" value="no" @if($feehead->form_sale=="no") checked @endif></td><td class="pd-l-5">No</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-edit"></i> Update</button>
    </div>
</form>

