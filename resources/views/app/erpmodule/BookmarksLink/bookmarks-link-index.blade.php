<form action="{{url('StoreBookmarksLink')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="ac_user_id" value="{{Auth::user()->id}}">
<div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
    <div class="row m-0">
     <div class="col-lg-8">
         <label>Bookmarks Category <sup class="text-gray">(Optional)</sup>  :</label>
         <div class="select-bookmarks-category" style="display:block; ">
         <div class="input-group">
             <select name="bookmarks_category_id" class="form-control">
                 <option value="">---Select---</option>
                 @if(isset($bookmarkcategory))
                     @foreach($bookmarkcategory as $data)
                         <option value="{{$data->id}}">{{$data->bookmarks_category}}</option>
                     @endforeach
                 @endif
             </select>
             <div class="input-group-append">
                 <button class="btn add-btn-bookmarks-category btn-primary" type="button" id="button-addon2"><i class="fa fa-plus"></i> Add New</button>
             </div>
         </div>
         </div>
         <div class="add-bookmarks-category" style="display:none; ">
             <div class="input-group">
                <input type="text" class="form-control" id="new_bookmarks_category" name="new_bookmarks_category" placeholder="Enter New Bookmarks Category">
                 <div class="input-group-append">
                     <button class="btn close-btn-bookmarks-category btn-primary" type="button" id="button-addon2"><i class="fa fa-times"></i> Close</button>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-4">
         <label>Position :</label>
         @include('component.position-import',['class'=>'form-control'])
     </div>
    <div class="col-lg-12">
        <label>Bookmarks Title <sup>*</sup> :</label>
        <input type="text" class="form-control" name="title" placeholder="Enter Bookmarks Title">
    </div>
        <div class="col-lg-6">
            <label>Icon <sup>*</sup> :</label>
            @include('component.font-awesome-dropdown-import')
        </div>
    <div class="col-lg-6">
        <label>Alias <sup class="text-gray">(Optional)</sup> :</label>
        <input type="text" class="form-control" name="alias" placeholder="Enter Bookmarks Alias">
    </div>
    <div class="col-lg-12">
        <label>Bookmarks Link URL <sup>*</sup> :</label>
        <input type="text" class="form-control" name="url" value="{{$url}}" placeholder="Enter Bookmarks Link URL">
    </div>
    <div class="col-lg-6">
        <label>Open Window <sup>*</sup> :</label>
        @php $opensource=['_self'=>'Same Tab','_blank'=>'New Tab','_parent'=>'Parent Window','_top'=>'Top Window']; @endphp
        <select class="form-control" name="open_window">
            @foreach($opensource as $key=>$value)
            <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label>Is Active <sup>*</sup> :</label>
        <table>
            <tr>
                <td><input type="radio" name="is_active" value="1" checked></td><td class="pd-l-5">Yes</td>
                <td class="pd-l-10"><input type="radio" name="is_active" value="0"></td><td class="pd-l-5">No</td>
            </tr>
        </table>
    </div>
    </div>
</div>
<div class="modal-footer pd-x-20 pd-y-15">
    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-check"></i> Submit</button>
</div>
</form>

<script type="text/javascript">
    $(".add-btn-bookmarks-category").click(function (){
        $("#new_bookmarks_category").val('');
        $(".add-bookmarks-category").css("display",'block');
        $(".select-bookmarks-category").css("display",'none');
    });
    $(".close-btn-bookmarks-category").click(function (){
        $("#new_bookmarks_category").val('');
        $(".add-bookmarks-category").css("display",'none');
        $(".select-bookmarks-category").css("display",'block');
    });
</script>
