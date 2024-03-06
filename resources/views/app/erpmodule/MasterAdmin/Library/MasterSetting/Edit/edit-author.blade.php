<form action="{{url('MasterAdmin/Library/EditAuthor/'.$author->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Author <sup>*</sup> : </label>
                <input type="text" id="author" name="author" autocomplete="off"
                     value="{{$author->author}}"  class="form-control input-sm" placeholder="Enter Author" required="">
            </div>

            <div class="col-lg-6">
                <label>Alias <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="alias" name="alias" autocomplete="off"
                      value="{{$author->alias}}" class="form-control input-sm" placeholder="Enter Alias">
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{$author->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

