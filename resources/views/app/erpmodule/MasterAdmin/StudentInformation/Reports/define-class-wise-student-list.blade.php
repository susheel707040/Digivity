@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Management</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Class Wise Student List</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student List</b></div>
            <div class="panel-body pd-b-0 row">

                <form action="{{url('MasterAdmin/StudentInformation/ClassWiseStudentList')}}" method="POST">
                    {{csrf_field()}}
                <div class="col-lg-12 nav-line">
                    <div class="row tx-12 pd-b-10 m-0">
                        <div class="col-lg-2 p-1">
                            <label><b>Course :</b></label>
                           @include('components.course-import',['selectid'=>request()->get('course_id'),
                                                                'required' => 'required',
                                                                'error_message' => 'Select Std.',
                                                                ])
                           {{-- 'class'=>'form-control select-box','data'=>['for'=>'section_id','this_id'=>'course_id','request_ids'=>'','get'=>'sectionlist'] , --}}
                        </div>
                        <div class="col-lg-3 p-1">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id'),
                                                                'required' => 'required',
                                                                'error_message' => 'Select Section',
                                                                ])
                        </div>
                        <div class="col-lg-2 p-1">
                            <label><b>House :</b></label>
                            @include('components.GlobalSetting.house-import',['selectid'=>request()->get('house_id')])
                        </div>
                        <div class="col-lg-2 p-1">
                            <label><b>Admission Type :</b></label>
                            <select name="admission_type_id" class="form-control input-sm">
                                <option value="">Active</option>
                                <option value="">In-Active</option>
                            </select>
                        </div>
                        <div class="col-lg-2 p-1">
                            <label><b>Is New :</b></label>
                           @include('components.GlobalSetting.is-new-status',['selectid'=>request()->get('is_new'),'selectnull'=>1])
                        </div>
                        <div class="col-lg-3 p-1">
                            <label><b>Status :</b></label>
                            <select name="status" class="form-control input-sm">
                                <option value="active">Active</option>
                                <option value="inactive">In-Active</option>
                            </select>
                        </div>
                        <div class="col-lg-3 p-1">
                            <label><b>Transport Status :</b></label>
                            <select name="transport_id" class="form-control input-sm">
                                <option value="">---Select---</option>
                                <option>Self</option>
                                <option value="">Bus</option>
                            </select>
                        </div>
                        <div class="col-lg-3 p-1">
                            <label><b>Category :</b></label>
                            <select name="caste" class="form-control input-sm">
                                <option value="">---Select---</option>
                                @foreach(categoryselectlist() as $data)
                                    <option value="{{$data->id}}">{{$data->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 p-1">
                            <button class="btn btn-outline-primary btn-sm tx-11  btn-icon" style="margin: 25px 67px;"><i class="fa fa-search"></i> Search</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 pd-t-1 text-primary"><u><i class="fa fa-search-plus"></i> Advance Search</u></div>
                    </div>
                </div>
            </form>

                @if(request()->get('_token'))
                @php $sms=1; @endphp
                <div class="col-lg-12 pd-l-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle',['sms'=>1])</span></div>
                <div data-label="Example" class="col-lg-12 p-1 df-example demo-table tx-11">
                    <table id="example2" class="table table-bordered tx-11 datatable">
                        <thead class="bg-light">
                        <tr>
                            <th class="wd-5p text-center">#</th>
                            <th class="wd-5p no-sort text-center col-hide" ><input type="checkbox" class="CheckAll mg-r-10" value="checkbox1"></th>
                            <th class="text-center mg-r-10" >Doa</th>
                            <th class="text-center">Admi. No.</th>
                            <th>Course - Sec.</th>
                            <th>Student</th>
                            <th>Gender</th>
                            <th class="text-center">Dob</th>
                            <th>Age</th>
                            <th>Father</th>
                            <th>Mother</th>
                            <th>Mobile No.</th>
                            <th>Address</th>
                            <th>Caste</th>
                            <th>Category</th>
                            <th>Aadhar No.</th>
                            <th>Transport Service</th>
                            <th class="wd-10p text-center col-hide">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($student as $data)

                            <tr class="student-id-{{$data->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center col-hide"><input type="checkbox" data-name="{{$data->fullName()}} <b>({{$data->CourseSection()}})</b>" data-contact-no="{!! \App\Helper\MobileNumberValidate::validate($data->student->contact_no) !!}" name="student_id" value="{{$data->student_id}}" class="checkbox1 student_id"></td>
                                <td class="text-center">{{nowdate($data->student->admission_date,'d-m-Y')}}</td>
                                <td class="text-center">{{$data->admission_no}}</td>
                                <td>{{$data->CourseSection()}}</td>
                                <td class="text-capitalize">{{$data->fullName()}}</td>
                                <td class="text-capitalize">{{$data->student->gender}}</td>
                                <td class="text-center">@if(isset($data->student->dob)){{nowdate($data->student->dob,'d-m-Y')}}@endif</td>
                                <td>@if(isset($data->student->dob)){{\Carbon\Carbon::parse($data->student->dob)->diff(date('Y-m-d',strtotime('-1 days',strtotime(Auth::user()->academicyear->start_date))))->format('%yy-%mm-%dd')}}@endif</td>
                                <td>{{$data->student->father_name}}</td>
                                <td>{{$data->student->mother_name}}</td>
                                <td>{!! \App\Helper\MobileNumberValidate::validate($data->student->contact_no) !!}</td>
                                <td class="wd-10p">{{$data->student->residence_address}}</td>
                                <td class="text-center">{{$data->CasteName()}}</td>
                                <td>{{$data->CategoryName()}}</td>
                                <td>{{$data->student->aadhar_card_no}}</td>
                                <td class="text-center">{{$data->TransportName()}}</td>

                                <td class="col-hide">
                                    <div class="container-fluid col-hide dropdown pd-t-3 pd-b-3 text-right">
                                        <button class="badge container-fluid pd-t-7 pd-b-7 border-primary tx-11 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black">Quick Action</button>
                                        <div class="dropdown-menu bg-light dropdown-menu-right shadow-lg tx-12" x-placement="bottom-start" style="position:absolute; will-change: transform; top: 0px; left: 0;  transform: translate3d(0px, 25px, 0px);">
                                            <li hidden class="dropdown-item" url="{{url('MasterAdmin/StudentInformation/StudentProfileView/'.$data->id.'/view')}}"><i class="fa fa-eye"></i> Preview Details</li>
                                            <a target="_blank" loader-disable="true" href="{{url('MasterAdmin/StudentInformation/EditStudentView/'.$data->student_id.'/view')}}"><li class="dropdown-item" url=""><i class="fa fa-edit"></i> Edit Details</li></a>
                                            <a target="_blank" loader-disable="true" href="{{url('MasterAdmin/StudentInformation/EditStudentView/'.$data->student_id.'/view')}}"><li class="dropdown-item" url=""><i class="fa fa-file-pdf"></i> Form Print</li></a>
                                            <a target="_blank" loader-disable="true" href="{{url('MasterAdmin/StudentInformation/EditStudentView/'.$data->student_id.'/view')}}"><li class="dropdown-item" url=""><i class="fa fa-download"></i> Form Download (.pdf)</li></a>
                                            <li class="dropdown-item tx-danger custom-model-btn tx-bold" url="{{url('MasterAdmin/StudentInformation/StudentAccount/'.$data->id.'/inactive')}}" model-title="Student Account Status Update" model-class="" model-title-info="Student Account Status Inactive Update"><i class="fa fa-trash"></i> Remove / Inactive Account</li>
                                           </div>
                                    </div>
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
               @endif
            </div>
        </div>
    </div>


@endsection
