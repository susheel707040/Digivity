<div class="col-lg-12 p-0 m-0 bd-t bd-1 mg-t-10 row">
    <table class="table table-bordered mg-t-5">
        <thead class="bg-light">
        <tr>
            <th class="text-center">Sl.No.</th>
            <th class="text-center">Profile</th>
            <th class="text-center">Admission No.</th>
            <th class="text-center">Class/Course-Section</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Contact No.</th>
            <th class="text-center">Last Entry Date </th>
            <th class="text-center">Current Issue Item</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($student as $data)
            <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center"><div class="avatar avatar-md mx-auto"><img src="{{url('uploads/student_profile_image/' .$data->profile_img)}}" class="rounded-circle" alt=""></div></td>
                <td class="text-center">{{$data->admission_no}}</td>
                <td class="text-center">{{$data->CourseSection()}}</td>
                <td>{{$data->fullName()}}</td>
                <td>{{$data->FatherName()}}</td>
                <td>{{$data->student->contact_no}}</td>
                <td></td>
                <td class="text-center text-danger tx-15"><b>(0)</b></td>
                <td class="text-center">
                    <button type="button" onclick="OpenAccount('{{$data->student_id}}')" class="btn btn-success tx-14 rounded-50"> Open Account <i class="fa fa-arrow-right"></i></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
