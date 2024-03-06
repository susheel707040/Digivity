<div class="col-md-12 p-0 m-0">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-file-pdf"></i> Document Information</a>
        </li>
    </ul>
    <div class="col-lg-12 p-0">
        <table class="table table-bordered mg-t-20">
            <thead>
            <tr>
                <td class="text-center">#</td>
                <td class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1" checked></td>
                <td><b>Document Name</b></td>
                <td><b>Document Number (optional)</b></td>
                <td><b>Document Attachment</b></td>
            </tr>
            </thead>
            <tbody>
        @foreach(studentdocumenttypelist([]) as $data)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center"><input type="checkbox" class="checkbox1" name="document_id[]" value="{{$data->id}}" checked>
                    <input type="hidden" name="document_type_{{$data->id}}" value="{{$data->document_type}}">
                    </td>
                    <td>{{$data->document_type}}</td>
                    <td><input type="text" class="form-control input-sm" name="document_no_{{$data->id}}" placeholder="Enter Document Number" autocomplete="off"></td>
                    <td><input type="file" class="form-control input-sm" name="document_file_{{$data->id}}"></td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </div>
</div>
