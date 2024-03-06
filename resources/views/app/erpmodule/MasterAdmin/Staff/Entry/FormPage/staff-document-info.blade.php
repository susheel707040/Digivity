<div class="col-md-12">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style="padding:5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-graduation-cap"></i> Staff Document Information</a>
        </li>
    </ul>
</div>

<div class="col-lg-12">
    <table class="table table-bordered mg-t-10">
        <thead >
        <tr class="bg-gray">
            <td class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1" ></td>
            <td>Document Name</td>
            <td>Attachment</td>
            <td class="text-center">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach(staffdocumentlist() as $data)
            <tr>
                <td class="text-center"><input type="checkbox" name="document_id[]" class="checkbox1" value="{{$data->id}}"></td>
                <td>{{$data->document_name}} <input type="hidden" name="document_name[]" value="{{$data->document_name}}"></td>
                <td>
                    <input type="file" name="document_file[]" class="col-lg-9 form-control">
                </td>
                <td class="text-center">
                    <button class="btn btn-danger btn-xs rounded-5"><i class="fa fa-trash"></i> Remove</button>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
