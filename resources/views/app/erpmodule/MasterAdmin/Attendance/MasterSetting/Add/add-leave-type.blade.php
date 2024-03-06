<form @if(isset($leavetype)&&($leavetype->id)) action="{{route('leavetype.update',['leavetype'=>$leavetype->id])}}" @else action="{{route('leavetype.store')}}" @endif method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Leave Type :</label>
                <input type="text" class="form-control" autocomplete="off" name="leave_type" @if(isset($leavetype)&&($leavetype)) value="{{$leavetype->leave_type}}" @endif placeholder="Enter Leave Type" required>
            </div>
            <div class="col-lg-3">
                <label>Alias/Symbol:</label>
                <input type="text" class="form-control" name="alias" @if(isset($leavetype)&&($leavetype)) value="{{$leavetype->alias}}" @endif placeholder="Enter Alias" required>
            </div>

            <div class="col-lg-3">
                <label>Sequence :</label>
                @php $sequence=0; if(isset($leavetype)){$sequence=$leavetype->sequence;} @endphp
                @include('components.position-import',['selectid'=>$sequence,'name'=>'sequence'])
            </div>

            <div class="col-lg-12">
                <label>Description :</label>
                <textarea class="form-control" name="description" placeholder="Enter Description">@if(isset($leavetype)&&($leavetype)) {{$leavetype->description}} @endif</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> @if(isset($leavetype)&&($leavetype)) <i class="fa fa-edit"></i> Update @else <i class="fa fa-plus"></i> Save @endif</button>
    </div>
</form>

