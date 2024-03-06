<form action="{{url('MasterAdmin/Library/EditGenres/'.$librarygenre->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Genres <sup>*</sup> : </label>
                <input type="text" id="genre" name="genre" autocomplete="off"
                     value="{{$librarygenre->genre}}"  class="form-control input-sm" placeholder="Enter Genres" required="">

                <a target="_blank" loader-disable="true" href="{{asset('images/Genres-of-Books.jpg')}}"><span class="tx-9"><u>Genres Example See </u></span></a>
            </div>

            <div class="col-lg-6">
                <label>Alias <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="alias" name="alias" autocomplete="off"
                       value="{{$librarygenre->alias}}"  class="form-control input-sm" placeholder="Enter Alias">
            </div>

            <div class="col-lg-6">
                <label>Book Type <span class="text-gray">(Optional)</span> : </label>
                <select name="book_type" class="form-control">
                    <option>--Select---</option>
                    <option value="non-fiction" @if($librarygenre->book_type=="non-fiction") selected @endif>Non-Fiction</option>
                    <option value="fiction" @if($librarygenre->book_type=="fiction") selected @endif>Fiction</option>
                </select>

            </div>

            <div class="col-lg-6">
                <label>Audience <span class="text-gray">(Optional)</span> : </label>
                <select name="audience" id="audience" class="form-control">
                    <option value="">Please select audience</option>
                    @foreach($libraryaudience as $key=>$value)
                        <option value="{{$key}}" @if($librarygenre->audience==$key) selected @endif>{{$value}}</option>
                    @endforeach
                </select>

            </div>

            <div class="col-lg-12">
                <label class="mg-t-10">Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

