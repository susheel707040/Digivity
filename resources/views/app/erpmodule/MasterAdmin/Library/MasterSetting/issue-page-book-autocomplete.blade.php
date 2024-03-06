<table class="table table-bordered tx-11">
    <thead class="bg-light">
    <tr>
        <th class="text-center">Book No.</th>
        <th>Book Info</th>
        <th>Book Title</th>
        <th>Other Info</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookresult as $data)
    <tr>
        <td class="text-center">{{$data->book_no}}</td>
        <td>
            <span class="badge p-0 m-0"><b>Accession No. : </b> {{$data->accession_no}} </span><br/>
            <span class="badge p-0 m-0"><b>DDC No. : </b> {{$data->ddc_no}}</span><br/>
            <span class="badge p-0 m-0"><b>Barcode No. : </b> {{$data->barcode_no}}</span>
        </td>
        <td class="bg-success-light tx-12 wd-40p"><b>{{$data->book_title}}</b><br/>
            <span class="tx-10 m-0 p-0"><b>Author : </b> {{$data->AuthorName()}}</span><br/>
            <span class="tx-10 m-0 p-0"><b>Publisher : </b> {{$data->publisher}}</span><br/>
            <span class="tx-10 p-0 mg-t-0 mg-b-0"><b>Year : </b> {{$data->year}}</span>
            <span class="tx-10 p-0 mg-t-0 mg-b-0 mg-l-10"><b>Edition : </b> {{$data->edition}}</span>
            <span class="tx-10 p-0 mg-t-0 mg-b-0 mg-l-10"><b>Location : </b> {{$data->shelf_no}}/{{$data->RackNo()}}</span>
        </td>
        <td class="text-center">
          <a  onclick="CustomModelEvent('/MasterAdmin/Library/EditBook/{{$data->id}}/view','Edit Book','Edit Book Detail','modal-xl');" class="badge mg-b-10 tx-12 text-primary cursor-pointer"><u><i class="fa fa-pen"></i>Edit Details</u></a>
          <a  onclick="CustomModelEvent('/MasterAdmin/Library/Book/{{$data->id}}/view','Book Preview','Book Preview','modal-lg');" class="badge tx-12 text-danger cursor-pointer"><u><i class="fa fa-search"></i>Preview</u></a>
        </td>
        <td class="text-center" style="width:130px; ">
            @if(isset($data->entry_id)&&($data->entry_id))
            @php
                $b_selectuser=0; $b_selectuserid=0;
                    if(isset($data->libraryentryrecord)&&($data->libraryentryrecord)){
                     if($data->libraryentryrecord->student_id){
                        $b_selectuser="student";
                        $b_selectuserid=$data->libraryentryrecord->student_id;
                     }elseif($data->libraryentryrecord->staff_id){
                        $b_selectuser="staff";
                        $b_selectuserid=$data->libraryentryrecord->staff_id;
                     }elseif($data->libraryentryrecord->library_account_id){
                        $b_selectuser="member";
                        $b_selectuserid=$data->libraryentryrecord->library_account_id;
                     }
                    }
            @endphp
            <button onclick="CustomModelEvent('/MasterAdmin/Library/IssueBook/{{$b_selectuser}}/{{$b_selectuserid}}/book/{{$data->id}}/renew/{{$data->entry_id}}','Renew Book','Renew Student/Staff Book/Item','modal-lg');" class="btn btn-info btn-xs rounded-50"><i class="fa fa-redo"></i> Renew</button>
            <button onclick="CustomModelEvent('/MasterAdmin/Library/IssueBook/{{$b_selectuser}}/{{$b_selectuserid}}/book/{{$data->id}}/return/{{$data->entry_id}}','Return Book','Return Student/Staff Book/Item','modal-lg');" class="btn btn-danger btn-xs mg-t-5 rounded-50"><i class="fa fa-reply"></i> Return</button>
            @else
            @if($selectuser&&$selectuserid)
            <button onclick="CustomModelEvent('/MasterAdmin/Library/IssueBook/{{$selectuser}}/{{$selectuserid}}/book/{{$data->id}}/issue/0','Issue New Book','Issue Student/Staff New Book/Item','modal-lg');" class="btn btn-success btn-xs rounded-50"><i class="fa fa-plus"></i> Book Issue</button>
            @else <span class="text-danger tx-11">Please First Select<br/>(Student/Staff/Member)</span> @endif
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
