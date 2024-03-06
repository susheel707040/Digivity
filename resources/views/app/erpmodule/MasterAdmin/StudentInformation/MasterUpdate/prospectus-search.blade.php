<form class="prospectussearch" action="{{url('MasterAdmin/StudentInformation/ProspectusAutoSearch')}}" method="POST">
<div class="col-lg-12 row pd-l-0 pd-r-0 m-0 pd-b-10 bd-1 bd-b pd-t-10">
    <div class="col-lg-2">
        <lable><b>Pros. No. :</b></lable>
        <input type="text" name="pros_no" placeholder="Search Pros. No." class="form-control1">
    </div>
    <div class="col-lg-1 pd-l-0 pd-r-5">
        <lable><b>From Date :</b></lable>
        <input type="text" name="from_Date" class="form-control1 date" placeholder="dd-mm-yyy">
    </div>
    <div class="col-lg-1 pd-l-5 pd-r-0">
        <lable><b>To Date :</b></lable>
        <input type="text" name="to_Date" class="form-control1 date" placeholder="dd-mm-yyy">
    </div>
    <div class="col-lg-2">
        <lable><b>Class/Course :</b></lable>
        @include('component.course-import')
    </div>
    <div class="col-lg-2">
        <lable><b>Student Name :</b></lable>
        <input type="text" name="first_name" class="form-control1" placeholder="Search Student Name">
    </div>
    <div class="col-lg-2">
        <lable><b>Father Name :</b></lable>
        <input type="text" name="father_name" class="form-control1" placeholder="Search Father Name">
    </div>
    <div class="col-lg-2">
        <button type="button" id="searchbtn" class="btn btn-primary  btn-xs mg-t-15 rounded-5"><i class="fa fa-search"></i> Get Result</button>
    </div>
</div>
</form>
<div id="jsondata" class="col-lg-12">
  <table class="table table_detail table-bordered mg-t-10">
      <thead class="bg-light">
      <tr>
          <th>Sl.No.</th>
          <th>Pros No.</th>
          <th>Date</th>
          <th>Student Name</th>
          <th>Father Name</th>
          <th>Contact No.</th>
          <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <tr>
          <td colspan="7" class="text-center text-danger">Sorry, Record No Found!</td>
      </tr>
      </tbody>
  </table>
</div>

<script type="text/javascript">
    $("#searchbtn").click(function () {
        loader('block');
        $("#jsondata").html("Please Wait Few Second....");
        var result=formrequest('form.prospectussearch', '{{url('/MasterAdmin/StudentInformation/ProspectusAutoSearch')}}', 'POST');
        $("#jsondata").html(result);
        loader('none');
    });
</script>
