@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Student Information</li>
            <li class="breadcrumb-item " aria-current="page">Master Update</li>
            <li class="breadcrumb-item active" aria-current="page">Update Student Document Attachment</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-edit"></i> Student Bulk Update Details</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-t-10 pd-b-10 row m-0">
                        <div class="col-lg-2 pd-l-0 pd-r-0">
                            <label><b>Admission No. :</b></label>
                            <input type="text" autocomplete="off" placeholder="Admission No." value="{{request()->get('admission_no')}}" name="admission_no" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-0">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-3">
                            <label><b>Order By :</b></label>
                            @include('components.student-sort-by',['class'=>'form-control input-sm','id'=>'sortby','name'=>'sortby','required'=>'','selectid'=>request()->get('sortby'),'other'=>0])
                        </div>
                        <div class="col-lg-3">
                            <label><b>Document Attachment :</b></label>
                            @include('components.GlobalSetting.student-document-attachment-import',['selectid'=>request()->get('document_id')])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-0">
                            <button type="submit" class="btn mg-t-20 btn-primary">Search <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </form>

                @if(request()->get('_token'))
                    <div class="col-lg-12 p-0 bd-1 bd-t pd-t-10 pd-b-10 row m-0">
                        <div class="col-lg-12 mg-t-10">
                            <table class="table table-bordered bd-1 bd">
                                <thead class="bg-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Admission No.</th>
                                    <th>Course - Section</th>
                                    <th>Student Name</th>
                                    <th>Father's Name</th>
                                    @foreach($document as $data1)
                                     <th class="text-center">{{$data1->document_type}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student as $data)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$data->admission_no}}</td>
                                        <td>{{$data->CourseSection()}}</td>
                                        <td>{{$data->FullName()}}</td>
                                        <td>{{$data->FatherName()}}</td>
                                        @php
                                            $documentsubmit=[];
                                            try {
                                            $documentsubmit=collect($data->documentsubmit)->pluck('document_id')->toArray();
                                            }catch (\Exception $e){}
                                        @endphp
                                        @foreach($document as $data1)
                                        <td class="text-center">
                                        <span><input type="radio" class="document-submitted" data-studentid="{{$data->id}}" data-documentid="{{$data1->id}}" value="yes" name="document_status_{{$data1->id}}_{{$data->id}}" @if(in_array($data1->id,$documentsubmit)) checked @endif> Yes</span>
                                            <span class="pd-l-5"><input type="radio" class="document-submitted" data-studentid="{{$data->id}}" data-documentid="{{$data1->id}}" value="no" name="document_status_{{$data1->id}}_{{$data->id}}" @if(!in_array($data1->id,$documentsubmit)) checked @endif> No</span>
                                        </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
<script type="text/javascript">
    $(".document-submitted").click(function (){
       if(($(this).data('studentid'))&&($(this).data('documentid'))){
           if($(this).val()=="yes"){
             CustomModelEvent('/MasterAdmin/StudentInformation/StudentDocumentUpload/'+$(this).data('studentid')+'/'+$(this).data('documentid')+'','Student Document Attachment Submitted Report','Student Document Attachment Submitted','modal-lg');
           }else
           if($(this).val()=="no"){
               swal({
                   title: "Are you sure?",
                   text: "Once deleted, you will not be able to recover this student document file!",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
               }).then((willDelete) => {
                       if (willDelete) {
                           removedocument($(this).data('studentid'),$(this).data('documentid'));
                       } else {
                          return false;
                       }
                   });

           }
          }
     });
    function removedocument(studentid,documentids){
        loader('block');
        var result=formrequest('','/MasterAdmin/StudentInformation/RemoveStudentDocument/'+studentid+'/'+documentids+'','GET');
        if(result['result']==1){
            loader('none');
            Alert(result);
        }
    }
</script>

@endsection
