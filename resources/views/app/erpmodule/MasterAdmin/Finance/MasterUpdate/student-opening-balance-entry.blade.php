@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Student Opening Balance Entry</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-rupee-sign"></i> Student Opening Balance Entry</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/StudentOpeningBalance')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-b-15 pd-l-0 pd-r-0 pd-t-15 m-0 row">
                        <div class="col-lg-2">
                            <label><b>Course <span class="text-gray">(Optional)</span> :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Section <span class="text-gray">(Optional)</span> :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-3">
                            <label><b>Fee Head <sup>*</sup>:</b></label>
                            @include('components.Finance.fee-head-import',['name'=>'fee_head_id','required'=>'required','selectid'=>request()->get('fee_head_id')])
                        </div>
                        <div class="col-lg-3">
                            <label><b>Import File (Student Opening Bal.) <span class="text-gray">(Optional)</span> :</b></label>
                            <input type="file" name="import_file" class="form-control input-sm">
                        </div>
                        <div class="col-lg-2">
                            <button class="btn mg-t-20 btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                        </div>
                        <div class="col-lg-12 pd-t-10">
                            <a href="{{url('ImportFileFormat/StudentOpeningBalance.xlsx')}}" loader-disable="true" download="" target="_blank" class="text-danger"><b><u><i class="fa fa-file-excel"></i> Download Student Opening Balance File Format</u></b></a>
                        </div>
                    </div>
                </form>

                @if(request()->get('fee_head_id'))
                    <form class="container-fluid" action="{{url('MasterAdmin/Finance/CreateStudentOpeningBalance')}}" method="POST">
                        {{csrf_field()}}
                        <div class="col-lg-12 pd-b-15 pd-t-15 m-0 bd-1 bd-t row">
                            <div class="col-lg-10 p-0">
                                <table class="table table-bordered bd bd-1">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                                        <th class="text-center">Admission No.</th>
                                        <th>Student Name</th>
                                        <th>Course - Section</th>
                                        <th>Father Name</th>
                                        <th>Mother Name</th>
                                        <th>Fee Head</th>
                                        <th class="text-center">Fee Instalment</th>
                                        <th class="text-center">Fee Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $feeheadinstalment=feeheadinstalmentlist(['foreign_fee_head_id'=>request()->get('fee_head_id')]);
                                    @endphp
                                    @foreach($student as $data)
                                        @php
                                            $feestructure=(new \App\Repositories\MasterAdmin\Finance\FinanceRepository())->feeheadstructurelist(['student_id'=>$data->student_id,'foreign_fee_head_id'=>request()->get('fee_head_id')]);
                                        @endphp
                                        @php
                                            $opening_balance=0;
                                            if(count($feestructure)){
                                            if(isset($feestructure[0]->feestructureinstalment[0]->fee_amount)){
                                                $opening_balance=$feestructure[0]->feestructureinstalment[0]->fee_amount;
                                            }else{
                                               $opening_balance=0;
                                            }
                                            }else{
                                            $opening_balance=0;
                                            }
                                            if(count($importdata)){
                                            $studentopening=$importdata->where('admission_no',$data->admission_no)->first();if(isset($studentopening)){$opening_balance=$studentopening['opening_balance'];}
                                            }
                                        @endphp

                                        <tr @if(count($feestructure)) class="bg-success-light" @endif>
                                            <td class="text-center">
                                                @if(count($feestructure)==0)
                                                    <input type="checkbox" class="checkbox1" @if(!empty($opening_balance)) checked @endif name="student_id[]" value="{{$data->student_id}}">
                                                @endif
                                            </td>
                                            <td class="text-center">{{$data->admission_no}}</td>
                                            <td>{{$data->FullName()}}</td>
                                            <td>{{$data->CourseSection()}}</td>
                                            <td>{{$data->FatherName()}}</td>
                                            <td>{{$data->MotherName()}}</td>
                                            <td>
                                                <input type="hidden" name="student_{{$data->student_id}}_fee_head_id" value="{{request()->get('fee_head_id')}}">
                                                <b>{{$feeheadinstalment[0]->feehead->fee_head}}</b></td>
                                            <td class="text-center">
                                                <select name="student_{{$data->student_id}}_fee_instalment" class="form-control input-sm">
                                                    @foreach($feeheadinstalment as $data1)
                                                        <option value="{{$data1->instalment_id}}">{{$data1->print_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="student_{{$data->student_id}}_fee_amount" @if(count($feestructure)) readonly @endif autocomplete="off" placeholder="Fee Amount" class="form-control input-sm wd-100 text-right" value="{{$opening_balance}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-lg-2 pd-r-0">
                                <button class="btn btn-primary btn-lg btn-block"><i class="fa fa-plus"></i> Create</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
