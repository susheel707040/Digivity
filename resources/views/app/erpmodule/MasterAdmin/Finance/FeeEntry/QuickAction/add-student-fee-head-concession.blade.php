<div class="row m-0 p-0">
    <form action="{{url('MasterAdmin/Finance/AddStudentFeeHeadConcession/'.$student->student_id.'/create')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
          data-parsley-validate="" novalidate="">
        {{csrf_field()}}
        <div class="col-lg-12">
            @include('component.Student.student-short-table-record',['student'=>$student])
        </div>
       <div class="col-lg-12 row m-0 p-0">
            <div class="col-lg-9">
                <table class="table tx-12 table-bordered mg-t-10">
                    <thead class="bg-light">
                    <tr>
                        <th>Fee Name - Instalment</th>
                        <th>Fee Amount</th>
                        <th>Concession</th>
                        <th hidden>Late Fee</th>
                        <th hidden>Pay Fee Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($studentfeestructure[0] as $data)
                        @php
                            $feeconcessiondata=collect($studentfeeheadinstalmentconcession)->where('foreign_fee_head_id',$data['foreign_fee_head_id']);
                        @endphp
                        <input type="hidden" readonly="readonly" name="foreign_{{$student->student_id}}_fee_head_id[]" value="{{$data['foreign_fee_head_id']}}">
                        <input type="hidden" readonly="readonly" name="fee_head_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_id" value="{{$data['fee_head_id']}}">

                        @foreach($data['fee_head_all_instalment'] as $data1)
                            @php
                                $feeconcessiondata=collect($studentfeeheadinstalmentconcession)->where('foreign_fee_head_id',$data['foreign_fee_head_id'])->where('instalment_id',$data1)->shift();
                            @endphp

                        @if(isset($data["fee_structure_instalment_amount"][$data1]))
                        <tr>
                        <td>
                             {{$data['fee_head']}} - <input type="hidden" name="student_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_instalment_id[]" value="{{$data1}}">
                            <b>{{$data['fee_head_instalment_print'][$data1]}}</b>
                        </td>
                        <td><input type="text" value="@if(isset($data["fee_structure_instalment_amount"][$data1])){{$data["fee_structure_instalment_amount"][$data1]}}@endif" class="form-control1 input-sm p-0 m-0 wd-60"></td>

                        <td>
                            <table cellspacing="0" cellpadding="0" class="pd-l-2 pd-r-2 pd-t-0 pd-b-0 mg-l-5 float-left table-borderless">
                                <tr>
                                    <td class="p-0 m-0">
                                        <select name="student_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_{{$data1}}_concession_type" class="form-control1 input-sm p-0 m-0 wd-60">
                                            <option value="f" @if(isset($feeconcessiondata->concession_type)) @if($feeconcessiondata->concession_type=="f")) selected @endif @endif>Fixed</option>
                                            <option value="p" @if(isset($feeconcessiondata->concession_type)) @if($feeconcessiondata->concession_type=="p")) selected @endif @endif>%</option>
                                        </select>
                                    </td>
                                    <td class="p-0 m-0"><input type="text" value="@if(isset($feeconcessiondata->concession)){{$feeconcessiondata->concession}}@else{{"0"}}@endif" name="student_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_{{$data1}}_concession" autocomplete="off" class="form-control1 text-center input-sm p-0 m-0 wd-60" value="0"></td>
                                </tr>
                            </table>
                        </td>

                        <td hidden><input type="text" class="form-control1 input-sm p-0 m-0 wd-60"></td>
                        <td hidden><input type="text" class="form-control1 input-sm p-0 m-0 wd-60"></td>

                        </tr>
                        @endif
                        @endforeach
                        <tbody>
                    @endforeach
                        </tbody>
                    <tfoot>
                    <tr class="bg-success-light" hidden>
                        <td>Total :</td>
                        <td>0.0</td>
                        <td>0.0</td>
                        <td>0.0</td>
                        <td>0.0</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
           <div class="col-lg-3">
               <button type="submit" class="btn btn-primary mg-t-10 btn-block float-right"> <i class="fa fa-plus"></i> Apply</button>
               <button type="button" class="btn btn-white btn-block float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
               @if(count($studentfeeheadinstalmentconcession))
                   <a href="{{url('MasterAdmin/Finance/RemoveStudentFeeHeadInstalmentConcession/'.$student->student_id.'/remove')}}">
                       <button type="button" class="btn btn-danger btn-block mg-t-20 float-right"> <i class="fa fa-trash"></i> Remove Student Concession</button></a>
               @endif
           </div>
          </div>
        </form>
</div>
