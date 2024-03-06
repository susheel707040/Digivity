<div class="row p-0 m-0">
<div class="col-lg-7 pd-l-0 pd-r-10">
    <form class="booksearch" >
        <div class="col-lg-12 p-0 bd-1 bd-b">
            <table cellspacing="0" cellpadding="0" class="table-receipt table-borderless">
                <tr>
                    <td class="border-0"><b>Book No.</b></td>
                    <td class="p-0 border-0 wd-150"><b>Search By :</b></td>
                    <td class="p-0 border-0"><b>Search Keyword :</b></td>
                    <td class="wd-100 border-0 p-0"><b>Result</b></td>
                </tr>
                <tr>
                    <td class="border-0 pd-r-5"><input type="text" name="book_no" id="BookNo" placeholder="Search Book No." autocomplete="off" class="form-control bg-warning-light"></td>
                    <td class="border-0 pd-r-5">@include('components.Library.search-by-import')</td>
                    <td class="border-0 pd-r-5"><input type="text" formid="#BookSearch" name="search" autocomplete="off" id="Keyword" placeholder="Search Here" class="form-control"></td>
                    <td class="pd-r-5 border-0">@include('components.GlobalSetting.pagination-import')</td>
                    <td class="text-right border-0"><button type="button" class="btn btn-primary btn-search rounded-50"><i class="fa fa-search"></i> Search</button></td>
                </tr>
                <tr>
                    <td colspan="3" class="border-0 p-0"><a target="_blank" loader-disable="true" href=""><span class="tx-primary"><u><i class="fa fa-search"></i> Advance Search</u></span></a></td>
                </tr>
            </table>
        </div>
    </form>
    <div id="data" class="col-lg-12 jsondata p-0 m-0">
    </div>
</div>
<div class="col-lg-5 pd-r-0 vhr">
    <div class="card">
        <div class="card-header bg-gray-100"><b><i class="fa fa-user-graduate"></i> Student Details</b></div>
        <div class="card-body pd-l-10 pd-r-10 pd-b-5 pd-t-0 pd-b-0 m-0 flex-fill">
            @if(isset($selectuserid)&&($selectuserid))
            @include('components.Student.student-short-detail-with-profile-image',['studentid'=>$selectuserid])
            @endif
        </div>
    </div>

    <div class="card mg-t-10">
        <div class="card-header bg-gray-100"><b><i class="fa fa-book"></i> Current Book Issue History</b>
        <table class="float-right">
            <tr>
                <td><b>Return Book : (0)</b></td>
                <td class="pd-l-10 tx-danger"><b>Total Penalty : 0.00</b></td>
            </tr>
        </table>
        </div>
        <div class="card-body pd-5 m-0 flex-fill">
            <table class="table table-bordered tx-11 bd-1 bd mg-b-0">
                <thead class="bg-light">
                <tr>
                    <th class="text-center"><b>Book No.</b></th>
                    <th class="wd-30p"><b>Book</b></th>
                    <th class="text-center"><b>Date</b></th>
                    <th><b>Renew</b></th>
                    <th class="text-right"><b>Penalty</b></th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($bookentrylist)&&(count($bookentrylist)>0))
                @foreach($bookentrylist as $data)
                <tr>
                    <td class="text-center"><b>{{$data->BookNo()}}</b></td>
                    <td class="tx-11"><b>{{$data->BookName()}}</b></td>
                    <td class="text-center tx-10">
                        <span>{{nowdate($data->entry_date,'d-M-Y')}}</span><br/>
                        <span class="badge-danger badge pd-t-2 pd-b-2">{{nowdate($data->end_date,'d-M-Y')}}</span>
                    </td>
                    <td class="text-center">0</td>
                    <td class="text-right">0.00</td>
                    <td class="text-center">
                        @php
                            $b_selectuser=0; $b_selectuserid=0;
                                 if($data->student_id){
                                    $b_selectuser="student";
                                    $b_selectuserid=$data->student_id;
                                 }elseif($data->staff_id){
                                    $b_selectuser="staff";
                                    $b_selectuserid=$data->staff_id;
                                 }elseif($data->library_account_id){
                                    $b_selectuser="member";
                                    $b_selectuserid=$data->library_account_id;
                                 }
                        @endphp
                        <button type="button" onclick="CustomModelEvent('/MasterAdmin/Library/IssueBook/{{$b_selectuser}}/{{$b_selectuserid}}/book/{{$data->id}}/renew/{{$data->entry_id}}','Renew Book','Renew Student/Staff Book/Item','modal-lg');" class="btn-info p-1 shadow-sm rounded-5 m-0 btn-xs"><i class="fa fa-redo"></i></button>
                        <button type="button" onclick="CustomModelEvent('/MasterAdmin/Library/IssueBook/{{$b_selectuser}}/{{$b_selectuserid}}/book/{{$data->id}}/return/{{$data->entry_id}}','Return Book','Return Student/Staff Book/Item','modal-lg');" class="btn-danger p-1 shadow-sm rounded-5 m-0 btn-xs"><i class="fa fa-reply"></i></button>
                    </td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-danger text-center"><h6 class="m-0 p-0 tx-12 text-danger"> Record No Found!</h6></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>


</div>
</div>


<script type="text/javascript">
    @if(isset($selectuserid)&&($selectuserid))
    var selectuserid="{{$selectuserid}}";
    @else
    var selectuserid="0";
    @endif
    @if(isset($selectuser)&&($selectuser))
    var selectuser="{{$selectuser}}";
    @else
    var selectuser="0";
    @endif

    $(".btn-search").click(function () {
        var search=$("#Keyword").val();
        if(search!=0) {
            bookresultajax(selectuserid,selectuser);
            return false;
        }
        $("#Keyword").focus();
        $(".jsondata").html("");
      });
    $("#Keyword").keyup(function () {
        if ($(this).val() != 0) {
            bookresultajax(selectuserid,selectuser);
            return false;
        }
        $(".jsondata").html("");
       });
    $("#BookNo").keyup(function () {
        if ($(this).val() != 0) {
            bookresultajax(selectuserid,selectuser);
            return false;
        }
        $(".jsondata").html("");
        });
    function bookresultajax(selectuserid,selectuser) {
        loader2('block');
        $(".jsondata").html("");
        var url="{{url('/MasterAdmin/Library/BookSearch')}}/"+selectuserid+"/"+selectuser+"";
        formrequestajax('form.booksearch', url, 'POST').success(function(data){
        if(data!=0) {
            $(".jsondata").html(data);
            loader2('none');
            return false;
        }
        $(".jsondata").html("<h3 class='text-danger text-center'>Sorry, Record no found!</h3>");
        }).fail(function(sender, message, details){
            $(".jsondata").html("<h3 class='text-danger text-center'>Sorry, something went wrong!</h3>");
            loader2('none');
            return false;
        });
    }
</script>


