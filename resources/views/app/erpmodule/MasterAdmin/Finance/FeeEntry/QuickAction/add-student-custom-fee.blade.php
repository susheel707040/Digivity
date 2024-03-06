<form action="{{url('MasterAdmin/Finance/AddStudentCustomFee/'.$student->student_id.'/create')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
<div class="col-lg-12">
@include('component.Student.student-short-table-record')
    <table class="table tx-12  mg-t-5 table-bordered">
        <thead class="bg-light ">
        <tr>
            <th class="wd-250"><b>Fee Head <sup>*</sup></b></th>
            <th><b>Fee Head Instalment <sup>*</sup></b></th>
            <th class="text-center"><b>Priority</b></th>
            <th class="text-center"><b>Collect Date <sup>*</sup></b></th>
            <th class="wd-200 text-center"><b>Instalment Description <sup>*</sup></b></th>
            <th class="wd-150 text-center"><b>Concession</b></th>
            <th class="wd-150 text-center"><b>Fee Head Amount <sup>*</sup></b></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <select id="fee_head_id" name="student_{{$student->student_id}}_fee_head_id" required class="form-control1 input-sm">
                    <option value="">---Select---</option>
                    @foreach(feeheadlist(['fee_custom'=>'yes']) as $data)
                        <option value="{{$data->id}}">{{$data->fee_head}}</option>
                    @endforeach
                </select>
            </td>
            <td class="text-center">
                <select id="instalment_id" name="student_{{$student->student_id}}_instalment_id" required class="form-control1 input-sm">
                    @foreach($feemonth['installment'] as $instalmentid)
                        <option value="{{$instalmentid}}" @if(date('M')==ucfirst($instalmentid)) selected @endif>{{ucfirst($instalmentid)}}</option>
                    @endforeach
                    @foreach($feemonth['lifetime'] as $instalmentid)
                     <option value="{{$instalmentid}}">{{ucfirst($instalmentid)}}</option>
                    @endforeach
                    @foreach($feemonth['annual'] as $instalmentid)
                     <option value="{{$instalmentid}}">{{ucfirst($instalmentid)}}</option>
                    @endforeach
                </select>
            </td>
            <td class="text-center">
                <select id="priority" name="student_{{$student->student_id}}_priority_id" class="form-control1 input-sm">
                    @for($i=1;$i<=50;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </td>
            <td><input type="text" id="start_date" name="student_{{$student->student_id}}_start_date" value="{{date('d-m-Y')}}" placeholder="dd-mm-yyyy" class="form-control1 date input-sm"></td>
            <td><input type="text" id="instalment_print" name="student_{{$student->student_id}}_instalment_print" placeholder="Eg. Late Fee, Notebook" class="form-control1 input-sm"></td>
            <td>
                <table cellpadding="0" cellspacing="0" class="table p-0 m-0 table-borderless">
                    <tr>
                        <td class="p-0 m-0">
                            <select id="concession_type" name="student_{{$student->student_id}}_concession_type" class="form-control1 input-sm">
                                <option value="f">Fixed</option>
                            </select>
                        </td>
                        <td class="p-0 m-0">
                            <input type="text" id="concession" name="student_{{$student->student_id}}_concession"  value="0" class="form-control1 text-right wd-70 input-sm">
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <input type="text" id="fee_head_amount" name="student_{{$student->student_id}}_fee_head_amount" value="0" class="form-control1 text-right input-sm">
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer pd-x-20 pd-y-15">
    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Create</button>
</div>
</form>
