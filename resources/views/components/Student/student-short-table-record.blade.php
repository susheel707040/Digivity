<table cellspacing="0" cellpadding="0" class="table tx-12 mg-t-15 mg-b-0 bd-2 table-bordered">
    <tbody class="bg-light">
    <tr>
        <th class="wd-10p"><b>Admission No. </b></th><th class="wd-20p">{{$student->admission_no}}</th>
        <th class="wd-10p"><b>Student Name  </b></th><th class="wd-25p text-capitalize">{{$student->student->first_name}} {{$student->student->middle_name}} {{$student->student->last_name}}</th>
        <th class="wd-10p"><b>Course - Section  </b></th><th class="wd-25p text-capitalize">{{$student->course->course}} - {{$student->section->section}}</th>
    </tr>
    <tr>
        <th class="wd-10p"><b>Father Name  </b></th><th class="wd-25p text-capitalize">{{$student->student->father_name}}</th>
        <th class="wd-10p"><b>Mother Name </b></th><th class="wd-25p text-capitalize">{{$student->student->mother_name}}</th>
        <th class="wd-10p"><b>Mobile No. </b></th><th class="wd-25p">{{$student->student->contact_no}}</th>
    </tr>
    </tbody>
</table>
