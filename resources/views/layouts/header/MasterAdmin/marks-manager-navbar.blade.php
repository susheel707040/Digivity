<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('MasterAdmin/MarksManager/index')}}"><i class="fa fa-chart-line"></i> Marks Manager Analytics</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> Exam Entry <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url(('MasterAdmin/MarksManager/ExamSubjectWiseMarksEntry'))}}" class="dropdown-item">Subject Wise Marks Entry</a>
            <a href="{{url('MasterAdmin/MarksManager/StudentExamMarksEntry')}}" class="dropdown-item">Student Wise Marks Entry</a>
            <a href="" class="dropdown-item">Student Attendance Entry</a>
            <a href="" class="dropdown-item">Subject Remark Entry</a>
            <a href="" class="dropdown-item">Exam Term Remark Entry</a>
            <a href="{{route('exam.marks.import')}}" class="dropdown-item">Exam Marks Import</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-file"></i> Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/MarksManager/Report/GenerateStudentReportCard')}}" class="dropdown-item">Generate Report Card</a>
            <a href="" class="dropdown-item" hidden>Miscellaneous Report </a>
            <a href="" class="dropdown-item" hidden>Generate Award List</a>
            <a href="" class="dropdown-item" hidden>Subjects Wise Performance Report</a>
            <a href="" class="dropdown-item" hidden>Teachers Performance Report</a>
            <a href="" class="dropdown-item" hidden>Subject Entry Sheet</a>
            <a href="{{url('MasterAdmin/MarksManager/ExamHallTicket')}}" class="dropdown-item">Student Exam Hall Ticket</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/MarksManager/DefineSubjectGroup')}}" class="dropdown-item">Define Subject Group</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineSubject')}}" class="dropdown-item">Define Subject</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineExamActivities')}}" class="dropdown-item">Define Subject Activities</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineExamSubjectSkillGroup')}}" class="dropdown-item">Define Subject Skills Group</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineExamSubjectSkill')}}" class="dropdown-item">Define Subject Skills</a>
            <a href="{{url('MasterAdmin/MarksManager/SubjectMapWithCourse')}}" class="dropdown-item">Subject Map With Class/Course</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineExamType')}}" class="dropdown-item">Define Exam Type</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineExamTerm')}}" class="dropdown-item">Define Exam Term</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineExamAssessment')}}" class="dropdown-item">Define Exam Assessment</a>
            <a href="{{url('MasterAdmin/MarksManager/DefineExamGradeSystem')}}" class="dropdown-item">Define Grading System</a>
            <a href="{{url('MasterAdmin/MarksManager/ExamConfiguration')}}" class="dropdown-item">Classwise Exam Configuration</a>
            <a href="" class="dropdown-item">Define Remark Type</a>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> Online Exam <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> Online Exam Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/MarksManager/DefineOnlineExam')}}" class="dropdown-item">Define Online Exam</a>
            <a href="{{url('MasterAdmin/MarksManager/SetOnlineExamQuestion')}}" class="dropdown-item"> Set Online Exam Question</a>
        </div>
    </li>

</ul>
