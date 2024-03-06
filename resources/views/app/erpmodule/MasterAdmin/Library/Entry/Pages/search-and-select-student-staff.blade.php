<div class="col-lg-12 m-0 pd-l-0 pd-r-0 pd-b-0">
    <table class="tx-13 tx-danger p-0 m-0">
        <tr>
            <td><input type="radio" value="student" name="issue_for" class="issue_for" checked></td><td class="pd-l-5"><b>Student</b></td>
            <td class="pd-l-15"><input type="radio" value="staff" class="issue_for" name="issue_for"></td><td class="pd-l-5"><b>Staff</b></td>
        </tr>
    </table>
</div>
<form action="{{url('MasterAdmin/Library/IssueBook')}}" method="POST">
    {{csrf_field()}}
<div id="student-search" class="col-lg-12 pd-l-0 pd-r-0 pd-b-0 m-0 row" >
 <div class="col-lg-2 pd-l-0 pd-b-20">
     <label>Class/Course :</label>
     @include('components.course-import',['class'=>'form-control','selectid'=>request()->get('course_id')])
 </div>
 <div class="col-lg-2">
    <label>Section :</label>
    @include('components.section-import',['class'=>'form-control','selectid'=>request()->get('section_id')])
 </div>
    <div class="col-lg-2">
    <label>Admission Number :</label>
    <input type="text" name="admission_no" value="{{request()->get('admission_no')}}" placeholder="Enter Admission No." class="form-control">
    </div>
    <div class="col-lg-4">
    <label>Student :</label>
    @include('components.student-list-import',['class'=>'form-control select-search','selectid'=>request()->get('student_id')])
    </div>
    <div class="col-lg-2">
    <button class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
    </div>
</div>
</form>

<div id="staff-search" class="col-lg-12 pd-l-0 pd-r-0 pd-b-20 m-0 row " style=" display: none;">
    <div class="col-lg-2 pd-l-0 ">
        <label>Staff Type :</label>
        @include('components.Staff.staff-type-import',['class'=>'form-control','selectnull'=>1])
    </div>
    <div class="col-lg-2 pd-l-0">
        <label>Department :</label>
        @include('components.Staff.department-import',['class'=>'form-control','selectnull'=>1])
    </div>
    <div class="col-lg-2 pd-l-0">
        <label>Designation :</label>
        @include('components.Staff.designation-import',['class'=>'form-control','selectnull'=>1])
    </div>
    <div class="col-lg-2 pd-l-0">
        <label>Staff/Employee No. :</label>
        <input type="text" placeholder="Enter Staff/Employee No." class="form-control">
    </div>
    <div class="col-lg-4">
        <label>Staff/Employee :</label>
        @include('components.staff-import',['class'=>'form-control select-search','selectnull'=>1])
    </div>
</div>
@if(isset($student)&&($student))
@include('app.erpmodule.MasterAdmin.Library.Entry.Import.search-student-list',['student'=>$student])
@endif

<script type="text/javascript">
    function OpenAccount(studentid){
        loader('block');
        if(studentid!=0) {
            return window.location.assign('/MasterAdmin/Library/IssueBook/' + studentid + '/student/search');
        }
        return window.location.assign('/MasterAdmin/Library/IssueBook');
    }

    $(".issue_for").on("change",function () {
        var value=$(this).val();
        $("#staff-search,#student-search").hide()
        $("#"+value+"-search").show()
    });
</script>
