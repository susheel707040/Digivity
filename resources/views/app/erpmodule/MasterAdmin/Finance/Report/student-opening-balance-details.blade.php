@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Student Opening Balance and Advance Details</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Opening Balance and Advance Details</b></div>
            <div class="panel-body pd-b-10 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/StudentOpeningBalanceReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-l-0 pd-b-15 row m-0 bd-1 bd-b">
                        <div class="col-lg-2">
                            <label><b>Class/Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Fee Head :</b></label>
                            @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id'),'search'=>['type'=>'opening-balance']])
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>

                <div class="col-lg-12 pd-b-15 row m-0 ">
                    <div class="col-lg-12 p-0 text-right">
                        @include('layouts.actionbutton.action-button-verticle')
                    </div>
                    <table class="table datatable table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th>Sl.No.</th>
                            <th>Admission No.</th>
                            <th>Class/Course</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th class="text-right">Opening Balance</th>
                            <th class="text-right">Advance Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $totalopening=0; $totaladvance=0; @endphp
                        @foreach($student as $data)
                            @php
                                $openingbal=0;
                                $advancebal=0;
                                $search=['fee_to'=>'student','student_id'=>$data->student_id,'custom_fee_id'=>null];
                                if(request()->get('fee_head_id')){
                                    $search=array_merge($search,['fee_head_id'=>request()->get('fee_head_id')]);
                                }

                                $feestructure=(new \App\Repositories\MasterAdmin\Finance\FinanceRepository())->feeheadstructurelist($search);
                                foreach ($feestructure as $data1){
                                    if($data1->fee_amount>0){
                                        $openingbal=abs($data1->fee_amount);
                                        $totalopening +=$openingbal;
                                    }elseif($data1->fee_amount<0){
                                        $advancebal +=abs($data1->fee_amount);
                                        $totaladvance +=$advancebal;
                                    }
                                }
                            @endphp
                            @if(($openingbal>0)||($advancebal>0))
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->admission_no}}</td>
                                    <td>{{$data->CourseSection()}}</td>
                                    <td>{{$data->fullName()}}</td>
                                    <td>{{$data->FatherName()}}</td>
                                    <td class="text-right">{{numberformat($openingbal,2)}}</td>
                                    <td class="text-right">{{numberformat($advancebal,2)}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                            <td colspan="5" class="text-right"><b>Total :</b></td>
                            <td class="text-right"><b>{{numberformat($totalopening,2)}}</b></td>
                            <td class="text-right"><b>{{numberformat($totaladvance,2)}}</b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
