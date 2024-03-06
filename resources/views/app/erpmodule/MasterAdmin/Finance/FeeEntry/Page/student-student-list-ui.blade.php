<div class="col-lg-12">
<table class="table table-bordered mg-t-15">
    <thead class="bg-light">
    <tr>
        <th>Sl.No.</th>
        <th>A/C Ledger No.</th>
        <th>Admission No.</th>
        <th>Student</th>
        <th>Class/Course</th>
        <th>Father Name</th>
        <th>Contact No.</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($student as $data)
    <tr>
        <td class="text-center">{{$loop->iteration}}</td>
        <td class="text-center"><b>{{$data->ac_ledger_no}}</b></td>
        <td class="text-center">{{$data->admission_no}}</td>
        <td>{{$data->fullName()}}</td>
        <td>{{$data->CourseSection()}}</td>
        <td>{{$data->FatherName()}}</td>
        <td>{{$data->student->contact_no}}</td>
        <td class="text-center"><a href="{{url('MasterAdmin/Finance/FeeCollection/'.$data->student_id.'/'.$payuptomonth.'/0/search')}}"><button type="button" class="btn btn-primary"><i class="fa fa-rupee-sign"></i> Pay Fee</button></a></td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
