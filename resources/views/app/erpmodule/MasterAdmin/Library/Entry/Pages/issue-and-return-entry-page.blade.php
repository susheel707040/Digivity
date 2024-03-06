<form action="{{url('MasterAdmin/Library/LibraryBookEntry')}}" method="POST">
    {{csrf_field()}}
<div class="col-lg-12 bd-1 bd-b">
    @if(isset($user)&&$user=="student")
    @include('component.Student.student-short-detail-with-profile-image',['studentid'=>$memberid])
    @endif
</div>
<div class="col-lg-12 row m-0 pd-t-10 pd-b-10">
    <div class="col-lg-12 pd-l-5 pd-r-5">
        <input type="hidden" readonly="readonly" name="book_id" value="{{$book->id}}">
        <input type="hidden" readonly="readonly" name="entry_id" value="@if(isset($entryid)&&($entryid)){{$entryid}}@else{{time()."-".rand()}}@endif">
        <input type="hidden" readonly="readonly" name="library_id" value="">
        <input type="hidden" readonly="readonly" name="book_group_id" value="">
        <input type="hidden" readonly="readonly" name="entry_status" value="{{$operation}}">
        <table class="table bd-1 tx-11 bd mg-b-0 bg-light">
            <tr>
                <td><b>Library</b></td><td><b>:</b></td><td>{{$book->LibraryName()}}</td>
                <td><b>Item Category</b></td><td><b>:</b></td><td>{{$book->ItemCategoryName()}}</td>
                <td rowspan='4' style='width:140px;'><center><img height='120px' src="{{FileUrl($book->book_image)}}"></center></td>
            </tr>
            <tr>
                <td><b>Book No.</b></td><td><b>:</b></td><td>{{$book->book_no}}</td>
                <td><b>DDC No.</b></td><td><b>:</b></td><td>{{$book->ddc_no}}</td>
            </tr>
            <tr>
                <td><b>Barcode No.</b></td><td><b>:</b></td><td>{{$book->barcode_no}}</td>
                <td><b>Rack/Safe No.</b></td><td><b>:</b></td><td>{{$book->RackNo()}}</td>
            </tr>
            <tr>
                <td><b>Book</b></td><td><b>:</b></td><td>{{$book->book_title}}</td>
                <td><b>Author</b></td><td><b>:</b></td><td>{{$book->AuthorName()}}</td>
            </tr>
        </table>
    </div>
    <div class="col-lg-3 pd-l-5 pd-r-5">
        <label>{{ucwords($operation)}} Date <sup>*</sup>:</label>
        <input type="text" placeholder="dd-mm-yyyy" name="entry_date" value="{{nowdate('','d-m-Y')}}" class="form-control1 date">
        <input type="hidden" id="return_days" readonly="readonly" value="{{$book->ReturnDays()}}">
    </div>
    <div class="col-lg-2 pd-l-5 pd-r-5" @if($operation=="return") hidden @endif>
        <label>Return Date <sup>*</sup>:</label>
        <input type="text" placeholder="dd-mm-yyyy" name="end_date" value="@if($operation=="return"){{nowdate('','d-m-Y')}}@else{{nowdate(\Carbon\Carbon::now()->addDays(7)->toDateString(),'d-m-Y')}}@endif" class="form-control1 date">
    </div>
    <div class="col-lg-6 pd-l-5 pd-r-5">
        <label>Remark <span class="text-gray">(Optional)</span>:</label>
        <textarea placeholder="Enter Remark" name="remark" class="form-control1"></textarea>
    </div>

</div>

<div class="modal-footer pd-x-20 pd-y-15">
    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn @if($operation=="return") btn-danger @elseif($operation=="renew") btn-info @else btn-primary @endif float-right"> <i class="fa fa-plus"></i> {{ucwords($operation)}} Book</button>
</div>
</form>

