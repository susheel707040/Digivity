@extends('layouts.MasterLayout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Manage Books/Items</li>
            <li class="breadcrumb-item active" aria-current="page">Define Books/Items</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Books/Items List</b></div>
            <div class="panel-body pd-b-0 row">

                <form action="{{url('MasterAdmin/Library/DefineBooks')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-lg-12 row m-0 p-0">
                        <div class="row">
                          <div class="col-lg-7">
                            <div class="row">
                             <div class="col-lg-3 pd-l-5 pd-r-5">
                                 <label><b>Library :</b></label>
                                 @include('components.Library.library-import',['selectid'=>request()->get('library_id')])
                             </div>
                             <div class="col-lg-3 pd-l-5 pd-r-5">
                                 <label><b>Category :</b></label>
                                 @include('components.Library.library-category-import',['selectid'=>request()->get('item_category_id')])
                             </div>
                             <div class="col-lg-4 pd-l-5 pd-r-5">
                                 <label><b>Author :</b></label>
                                 @include('components.Library.library-author-import',['class'=>'form-control select-search','selectid'=>request()->get('author_id')])
                             </div>
                            </div>
                           </div>

                           <!-- <div class="col-lg-5 ">
                            <div class="row">
                             <div class="col-lg-4 pd-l-5 pd-r-5">
                                 <label><b>Racks :</b></label>
                                 @include('components.Library.library-racks-import',['class'=>'form-control1 select-search','selectid'=>request()->get('racks')])
                             </div>
                            </div>        -->
                        </div>

                        <div class="row">
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                                 <label><b>Tag :</b></label>
                                 @include('components.Library.library-tag-import',['class'=>'form-control select-search','selectid'=>request()->get('tag_id')])
                             </div>
                             <div class="col-lg-3 pd-l-5 pd-r-5">
                                 <label><b>Genres :</b></label>
                                 @include('components.Library.library-genres-import',['class'=>'form-control select-search','selectid'=>request()->get('genre_id')])
                             </div>
                             </div>
                            </div>
                        </div>

                        <div class="row m-0 p-0">
                             <div class="col-lg-2 spd-l-5 pd-r-5  p-0">
                                 <label><b>Book No. :</b></label><br>
                                 <input type="text" name="book_no" value="{{request()->get('book_no')}}" class="form-control" placeholder="For Search">
                             </div>

                             <div class="col-lg-2 pd-l-5 pd-r-5">
                                 <label><b>Accession No. :</b></label><br>
                                 <input type="text" name="accession_no" value="{{request()->get('accession_no')}}" class="form-control" placeholder="For Search">
                             </div>


                             <div class="col-lg-2 pd-l-5 pd-r-5">
                                 <label><b>DDC No. <i class="tx-10 fa fa-info-circle"></i> :</b></label><br>
                                 <input type="text" name="ddc_no" value="{{request()->get('ddc_no')}}" class="form-control" placeholder="For Search">
                             </div>

                             <div class="col-lg-3 pd-l-5 pd-r-5">
                                  <label><b>Barcode No. :</b></label><br>
                                  <input type="text" name="barcode_no" value="{{request()->get('ddc_no')}}" class="form-control" placeholder="For Search">
                              </div>

                              <div class="col-lg-2 pd-l-5 pd-r-5">
                                  <label><b>Book Title :</b></label><br>
                                  <input type="text" name="book_search" value="{{request()->get('book_search')}}" class="form-control" placeholder="Enter Book Title For Search">
                              </div>


                              <div class="col-lg-3 pd-l-5 pd-r-5">
                                  <label><b>Edition :</b></label><br>
                                  <input type="text" name="edition" value="{{request()->get('edition')}}" class="form-control" placeholder="For Search">
                              </div>
                        </div>


                            <div class="row m-0 pd-t-5 pd-l-0">
                                <div class="col-lg-3 pd-l-5 pd-r-5">
                                    <label><b>Order By :</b></label><br>
                                    <select class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="book_no">Book No.</option>
                                        <option value="book_title">Book Title</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 pd-l-5 pd-r-5">
                                    <label><b>Pagination :</b></label><br>
                                    @include('components.GlobalSetting.pagination-import',['default'=>100,'selectid'=>request()->get('pagination')])
                                </div>


                                <div class="col-lg-3">
                                    <button type="submit" class="btn mg-t-20 btn-primary rounded-50"><i class="fa fa-search"></i> Get Result</button>
                                </div>
                             </div>
                         </div>
                  </form>


                <div class="col-lg-12 bd-1 bd-t pd-t-10 pd-l-0 pd-r-0 mg-t-20 text-right">
                    <a href="{{url('MasterAdmin/Library/CreateNewBook')}}"><button type="button" class="btn btn-primary float-left"><i class="fa fa-book-open"></i> Add New Books/Items</button></a>
                    <a href="{{url('MasterAdmin/Library/ImportBulkBook')}}"><button type="button" class="btn btn-info mg-l-20 float-left"><i class="fa fa-file-import"></i> Import Bulk Books/Items</button></a>
                    <button type="button" id="generate-barcode" class="btn btn-dark mg-l-20 float-left"><i class="fa fa-barcode"></i> Generate Barcode</button>
                    @include('layouts.actionbutton.action-button-verticle')
                </div>

                <div class="col-lg-12 p-0">
                    <table id="example2" class="table datatable tx-11 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox_1"></th>
                            <th class="text-center">S.No.</th>
                            <th class="text-center">Book No.</th>
                            <th class="wd-200">Book Info</th>
                            <th class="bg-success-light">Book Title</th>
                            <th>Bill Number</th>
                            <th>No. of Copy</th>
                            <th class="text-center">Library Remark</th>
                            <th class="text-center wd-100 col-hide">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($book as $data)
                            <tr>
                                <td class="text-center"><input type="checkbox" class="checkbox_1 book_id" name="book_id" value="{{$data->id}}"></td>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$data->book_no}}</td>
                                <td>
                                    <span class="p-0 m-0"><b>Accession No. :</b></span> {{$data->accession_no}}<br/>
                                    <span class="p-0 m-0"><b>DDC No. :</b></span> {{$data->ddc_no}}<br/>
                                    <span class="p-0 m-0"><b>Barcode No. :</b></span> {{$data->barcode_no}}<br/>
                                </td>
                                <td class="bg-success-light">
                                    <span class="tx-13"><b>{{ucwords($data->book_title)}}</b></span><br/>
                                    <span class="tx-10"><b>Author :</b> {{$data->AuthorName()}}</span>  <span class="tx-10"><b>Edition :</b> {{$data->edition}}</span><br/>
                                    <span class="tx-10"><b>Publisher :</b> {{ucwords($data->publisher)}}</span>
                                </td>
                                <td>{{$data->bill_no}}</td>
                                <td>{{$data->no_of_copy}}</td>
                                <td>{{$data->remark}}</td>
                                <td class="col-hide">
                                    <div class="container-fluid col-hide dropdown pd-t-3 pd-b-3 text-right">
                                        <button class="badge container-fluid pd-t-7 pd-b-7 border-primary tx-11 dropdown-toggle" style="color:black" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quick Action</button>
                                        <div class="dropdown-menu bg-light dropdown-menu-right shadow-lg tx-12" x-placement="bottom-start" style="position:absolute; will-change: transform; top: 0px; left: 0;  transform: translate3d(0px, 25px, 0px);">
                                            <li class="dropdown-item custom-model-btn" model-title="Book Preview" model-class="modal-xl" model-title-info="Book Preview" url="{{url('MasterAdmin/Library/Book/'.$data->id.'/view')}}"><i class="fa fa-eye"></i> Preview Details</li>
                                            <li class="dropdown-item custom-model-btn" model-title="Edit Book" model-class="modal-xl" model-title-info="Edit Book Detail" url="{{url('MasterAdmin/Library/EditBook/'.$data->id.'/view')}}"><i class="fa fa-edit"></i> Edit Details</li>
                                            <li hidden class="dropdown-item" url=""><i class="fa fa-hand-paper"></i> Inactive</li>
                                            <li hidden class="dropdown-item" url=""><i class="fa fa-trash"></i> Remove</li>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    @include('layouts.Models.barcode-model-import',['db_model'=>\App\Models\MasterAdmin\Library\Book::class,'db_model_search'=>[]])

    <script type="text/javascript">
        var i=0;
        $("#generate-barcode").click(function (){
            var bookids = [];
            $('.book_id:checked').each(function () {
                bookids[i++] = $(this).val();
            });

            if(bookids==0){
                swal("Opps!", "Please select atleast one book for generate barcode!", "error");
                return false;
            }else{
                $("#db_ids").val(bookids);
                $("#BarcodeModels").modal('show');
            }
        });
    </script>

@endsection
