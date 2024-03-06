<table class="table table_detail table-bordered mg-t-10">
    <thead class="bg-light">
    <tr>
        <th class="text-center">Sl.No.</th>
        <th class="text-center">Pros No.</th>
        <th>Date</th>
        <th>Course</th>
        <th>Student Name</th>
        <th>Father Name</th>
        <th>Contact No.</th>
        <th>Address</th>
        <th>Transport</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($prospectus as $data)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$data->pros_no}}</td>
            <td>{{nowdate($data->admission_date,'d-M-Y')}}</td>
            <td>{{$data->CourseName()}}</td>
            <td>{{$data->fullName()}}</td>
            <td>{{$data->FatherName()}}</td>
            <td>{{$data->mobile_no}}</td>
            <td>{{$data->residence_address}}</td>
            <td>N/A</td>
            <td class="text-center">
                <a href="{{url('MasterAdmin/StudentInformation/StudentRegistration?pros_no='.$data->id.'')}}">
                <button class="btn btn-success">Confirm Admission <i class="fa fa-arrow-right"></i></button>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
