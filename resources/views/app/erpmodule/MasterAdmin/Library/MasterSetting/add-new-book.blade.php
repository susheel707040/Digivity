@extends('layouts.MasterLayout')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Manage Books/Items</li>
            <li class="breadcrumb-item active" aria-current="page">Add New Books/Items</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Add New Books/Items</b></div>
            <div class="panel-body pd-b-0 row  ">
                <form class="container-fluid row m-0 p-0" action="{{url('MasterAdmin/Library/StoreBook')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                <div class="col-lg-10 pd-l-0 pd-r-10 pd-b-20 row m-0">

                    <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                        <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book"></i> Book/Item Basic Details</b></div>
                        <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                            <div class="col-lg-4">
                                <label>Book Title <sup>*</sup> :</label>
                                <input type="text" name="book_title" id="book_title" autocomplete="off" placeholder="Enter Book Title" class="form-control" required>
                            </div>

                            <div class="col-lg-2">
                                <label>Book No. <sup>*</sup> :</label>
                                <input type="text" name="book_no" id="book_no" autocomplete="off" placeholder="Enter Book Number" class="form-control" required>
                            </div>

                            <div class="col-lg-2">
                                <label>Accession No.  :</label>
                                <input type="text" name="accession_no" id="accession_no" autocomplete="off" placeholder="Enter Accession No" class="form-control">
                            </div>

                            <div class="col-lg-2">
                                <label>DDC No. <span class="text-gray">(Optional)</span> :</label>
                                <input type="text" name="ddc_no" id="ddc_no" autocomplete="off" placeholder="Enter DDC Number" class="form-control">
                            </div>

                            <div class="col-lg-2">
                                <label>Barcode No. <span class="text-gray">(Optional)</span> :</label>
                                <input type="text" name="barcode_no" id="barcode_no" autocomplete="off" placeholder="Enter Barcode No." class="form-control">
                            </div>

                            <div class="col-lg-4">
                                <label>Book Search Keywords <span class="text-gray">(Optional)</span> :</label>
                                <textarea class="form-control" name="search_keyword" id="search_keyword" placeholder="Enter Book/Item Search Keyword"></textarea>
                            </div>

                            <div class="col-lg-2">
                                <label>No. of Copy <span class="text-gray">(Optional)</span> :</label>
                                <input type="text" id="no_of_copy" name="no_of_copy"  autocomplete="off" placeholder="Enter No. of Copy" class="form-control">
                            </div>

                            <div class="col-lg-2">
                                <label>Book Condition <sup>*</sup> :</label>
                                @include('components.Library.book-condition-import',['class'=>'form-control'])
                            </div>

                            <div class="col-lg-2">
                                <label>Issuable <sup>*</sup> :</label>
                                <table>
                                    <tr>
                                        <td><input name="issuable" type="radio" value="yes" checked></td><td class="pd-l-5">Yes</td>
                                        <td class="pd-l-10"><input name="issuable" value="no" type="radio"></td><td class="pd-l-5">No</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                        <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book-open"></i> Book/Item Advance Details</b></div>
                        <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                            <div class="col-lg-3">
                                <label>Library <sup>*</sup> :</label>
                                @include('components.Library.library-import',['class'=>'form-control','required'=>'required'])
                            </div>

                            <div class="col-lg-3">
                                <label>Category <sup>*</sup> :</label>
                                @include('components.Library.library-category-import',['class'=>'form-control','required'=>'required'])
                            </div>

                            <div class="col-lg-3">
                                <label>Racks <span class="text-gray">(Optional)</span> :</label>
                                @include('components.Library.library-racks-import',['class'=>'form-control'])
                            </div>

                            <div class="col-lg-3">
                                <label>Author <span class="text-gray">(Optional)</span> :</label>
                                @include('components.Library.library-author-import',['class'=>'form-control'])
                            </div>

                            <div class="col-lg-3">
                                <label>Tag <span class="text-gray">(Optional)</span> :</label>
                                @include('components.Library.library-tag-import',['class'=>'form-control'])
                            </div>

                            <div class="col-lg-3">
                                <label>Genres <span class="text-gray">(Optional)</span> :</label>
                                @include('components.Library.library-genres-import',['class'=>'form-control'])
                            </div>

                            <div class="col-lg-3">
                                <label>Subject <span class="text-gray">(Optional)</span> :</label>
                                @include('components.subject-import',['class'=>'form-control'])
                            </div>

                            <div class="col-lg-3">
                                <label>Edition :</label>
                                <input type="text" autocomplete="off" name="edition" placeholder="Enter Edition" class="form-control">
                            </div>

                            <div class="col-lg-3">
                                <label>Publisher :</label>
                                <input type="text" autocomplete="off" name="publisher" placeholder="Enter Publisher" class="form-control">
                            </div>

                            <div class="col-lg-3">
                                <label>Purchase Date :</label>
                                <input type="text" autocomplete="off" name="purchase_date" placeholder="dd-mm-yyyy" class="date form-control">
                            </div>

                            <div class="col-lg-3">
                                <label>Shelf No. :</label>
                                <input type="text" autocomplete="off" name="shelf_no" placeholder="Enter Shelf No" class="form-control">
                            </div>

                            <div class="col-lg-3">
                                <label>Price :</label>
                                <input type="text" autocomplete="off" value="0" name="price" placeholder="Enter Price" class="form-control">
                            </div>

                            <div class="col-lg-3">
                                <label>Upload Scan Copy :</label>
                                <input type="file" name="scan_copy" id="scan_copy" autocomplete="off" class="form-control" onchange="previewImage()">
                                <img id="preview" src="#" alt="Preview" style="max-width: 100%; max-height: 50px; display: none;">
                            </div>
                            <script>
                                function previewImage() {
                                    var preview = document.getElementById('preview');
                                    var file = document.getElementById('scan_copy').files[0];
                                    var reader = new FileReader();

                                    reader.onload = function () {
                                        preview.src = reader.result;
                                        preview.style.display = 'block';
                                    }

                                    if (file) {
                                        reader.readAsDataURL(file);
                                    } else {
                                        preview.src = '#';
                                        preview.style.display = 'none';
                                    }
                                }
                            </script>

                            <div class="col-lg-3">
                                <label>Book Image :</label>
                                <input type="file" name="book_image" id="book_image" autocomplete="off" class="form-control" onchange="book_image_previewImage()">
                                <img id="book_preview" src="#" alt="Preview" style="max-width: 100%; max-height: 50px; display: none;">
                            </div>
                            <script>
                                function book_image_previewImage() {
                                    var book_preview = document.getElementById('book_preview');
                                    var file = document.getElementById('book_image').files[0];
                                    var reader = new FileReader();

                                    reader.onload = function () {
                                        book_preview.src = reader.result;
                                        book_preview.style.display = 'block';
                                    }

                                    if (file) {
                                        reader.readAsDataURL(file);
                                    } else {
                                        book_preview.src = '#';
                                        book_preview.style.display = 'none';
                                    }
                                }
                            </script>

                            <div class="col-lg-3">
                                <label>E. Book Url :</label>
                                <input type="text" autocomplete="off" name="e_book_url" placeholder="Enter E. Book Url" class="form-control">
                            </div>

                            <div class="col-lg-3">
                                <label>Book Status <sup>*</sup> :</label>
                                @include('components.Library.book-status-import',['class'=>'form-control'])
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                        <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book-open"></i>Book/Item Purchase/Stock Details</b></div>
                        <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                            <div class="col-lg-4">
                                <label>Source/Vendor <span class="text-gray">(Optional)</span> :</label>
                                <input type="text" name="source" id="source" autocomplete="off" placeholder="Enter Source/Vendor" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label>Bill No. <span class="text-gray">(Optional)</span> :</label>
                                <input type="text" autocomplete="off" placeholder="Enter Bill No." name="bill_no" id="bill_no" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label>Date <span class="text-gray">(Optional)</span> :</label>
                                <input type="text" autocomplete="off" name="bill_date" placeholder="dd-mm-yyyy" class="form-control date">
                            </div>
                            <div class="col-lg-2">
                                <label>Cost <span class="text-gray">(Optional)</span> :</label>
                                <input type="text" name="cost" autocomplete="off" value="0" placeholder="Enter Cost" class="form-control text-right">
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                        <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book-open"></i> Book/Item Other Details</b></div>
                        <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                            <div class="col-lg-6">
                                <label>Topic <span class="text-gray">(Optional)</span> :</label>
                                <textarea class="form-control" name="topic" placeholder="Enter Topic"></textarea>
                            </div>

                            <div class="col-lg-6">
                                <label>Remark <span class="text-gray">(Optional)</span> :</label>
                                <textarea class="form-control" name="remark" placeholder="Enter Remark"></textarea>
                            </div>

                        </div>
                    </div>

                        </div>
                <div class="col-lg-2 vhr">
                    <button class="btn btn-outline-primary mg-t-20 btn-block rounded-50 btn-lg">Submit <i class="fa fa-check"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
