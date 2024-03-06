<form action="{{url('MasterAdmin/Library/EditBook/'.$book->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-12 pd-l-10 pd-r-10 pd-b-20 row m-0">

                <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                    <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book"></i> Edit Book/Item Basic Details</b></div>
                    <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                        <div class="col-lg-4">
                            <label>Book Title <sup>*</sup> :</label>
                            <input type="text" value="{{$book->book_title}}" name="book_title" id="book_title" autocomplete="off" placeholder="Enter Book Title" class="form-control" required>
                        </div>

                        <div class="col-lg-2">
                            <label>Book No. <sup>*</sup> :</label>
                            <input type="text" value="{{$book->book_no}}" name="book_no" id="book_no" autocomplete="off" placeholder="Enter Book Number" class="form-control" required>
                        </div>

                        <div class="col-lg-2">
                            <label>Accession No.  :</label>
                            <input type="text" value="{{$book->accession_no}}" name="accession_no" id="accession_no" autocomplete="off" placeholder="Enter Accession No" class="form-control">
                        </div>

                        <div class="col-lg-2">
                            <label>DDC No. <span class="text-gray">(Optional)</span> :</label>
                            <input type="text" name="ddc_no" value="{{$book->ddc_no}}" id="ddc_no" autocomplete="off" placeholder="Enter DDC Number" class="form-control">
                        </div>

                        <div class="col-lg-2">
                            <label>Barcode No. <span class="text-gray">(Optional)</span> :</label>
                            <input type="text" value="{{$book->barcode_no}}" name="barcode_no" id="barcode_no" autocomplete="off" placeholder="Enter Barcode No." class="form-control">
                        </div>

                        <div class="col-lg-4">
                            <label>Book Search Keywords <span class="text-gray">(Optional)</span> :</label>
                            <textarea class="form-control" name="search_keyword" id="search_keyword" placeholder="Enter Book/Item Search Keyword">{{$book->search_keyword}}</textarea>
                        </div>

                        <div class="col-lg-2">
                            <label>No. of Copy <span class="text-gray">(Optional)</span> :</label>
                            <input type="text" value="{{$book->no_of_copy}}"  autocomplete="off" placeholder="Enter No. of Copy" class="form-control">
                        </div>

                        <div class="col-lg-2">
                            <label>Book Condition <sup>*</sup> :</label>
                            @include('components.Library.book-condition-import',['class'=>'form-control','selectid'=>$book->book_condition])
                        </div>

                        <div class="col-lg-2">
                            <label>Issuable <sup>*</sup> :</label>
                            <table>
                                <tr>
                                    <td><input name="issuable" type="radio" value="yes" @if($book->issuable=="yes") checked @endif></td><td class="pd-l-5">Yes</td>
                                    <td class="pd-l-10"><input name="issuable" value="no" type="radio" @if($book->issuable=="no") checked @endif></td><td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>


                <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                    <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book-open"></i>Edit Book/Item Advance Details</b></div>
                    <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                        <div class="col-lg-3">
                            <label>Library <sup>*</sup> :</label>
                            @include('components.Library.library-import',['class'=>'form-control','selectid'=>$book->library_id])
                        </div>

                        <div class="col-lg-3">
                            <label>Category <sup>*</sup> :</label>
                            @include('components.Library.library-category-import',['class'=>'form-control','selectid'=>$book->item_category_id])
                        </div>

                        <div class="col-lg-3">
                            <label>Racks <span class="text-gray">(Optional)</span> :</label>
                            @include('components.Library.library-racks-import',['class'=>'form-control','selectid'=>$book->racks])
                        </div>

                        <div class="col-lg-3">
                            <label>Author <span class="text-gray">(Optional)</span> :</label>
                            @include('components.Library.library-author-import',['class'=>'form-control','selectid'=>$book->author_id])
                        </div>

                        <div class="col-lg-3">
                            <label>Tag <span class="text-gray">(Optional)</span> :</label>
                            @include('components.Library.library-tag-import',['class'=>'form-control','selectid'=>$book->tag_id])
                        </div>

                        <div class="col-lg-3">
                            <label>Genres <span class="text-gray">(Optional)</span> :</label>
                            @include('components.Library.library-genres-import',['class'=>'form-control','selectid'=>$book->genre_id])
                        </div>

                        <div class="col-lg-3">
                            <label>Subject <span class="text-gray">(Optional)</span> :</label>
                            @include('components.subject-import',['class'=>'form-control','selectid'=>$book->subject_id])
                        </div>

                        <div class="col-lg-3">
                            <label>Edition :</label>
                            <input type="text" autocomplete="off" value="{{$book->edition}}" name="edition" placeholder="Enter Edition" class="form-control">
                        </div>

                        <div class="col-lg-3">
                            <label>Publisher :</label>
                            <input type="text" autocomplete="off" value="{{$book->publisher}}"  name="publisher" placeholder="Enter Publisher" class="form-control">
                        </div>

                        <div class="col-lg-3">
                            <label>Purchase Date :</label>
                            <input type="text" autocomplete="off" value="{{$book->purchase_date}}" name="purchase_date" placeholder="dd-mm-yyyy" class="date form-control">
                        </div>

                        <div class="col-lg-3">
                            <label>Shelf No. :</label>
                            <input type="text" autocomplete="off" value="{{$book->shelf_no}}" name="shelf_no" placeholder="Enter Shelf No" class="form-control">
                        </div>

                        <div class="col-lg-3">
                            <label>Price :</label>
                            <input type="text" autocomplete="off" value="{{$book->price}}" name="price" placeholder="Enter Price" class="form-control">
                        </div>

                        <div class="col-lg-3">
                            <label>Upload Scan Copy :</label>
                            <input type="file" name="scan_copy" id="scan_copy" autocomplete="off" class="form-control" onchange="previewImage()">
                            @if(isset($book->scan_copy))
                              <img id="preview" src="{{ url('uploads/Book_scan_copy_image/' . $book->scan_copy) }}" alt="Scan Copy" style="max-width: 100%; max-height: 50px;">
                           @endif
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
                            <input type="file" id="book_image" name="book_image" autocomplete="off" class="form-control" onchange="bookpreviewImage()">
                            @if(isset($book->scan_copy))
                            <img id="book_preview_img" src="{{ url('uploads/Book_image/' . $book->book_image) }}" alt="Scan Copy" style="max-width: 100%; max-height: 50px;">
                         @endif
                        </div>
                        <script>
                            function bookpreviewImage() {
                                var book_preview_img = document.getElementById('book_preview_img');
                                var file = document.getElementById('book_image').files[0];
                                var reader = new FileReader();

                                reader.onload = function () {
                                    book_preview_img.src = reader.result;
                                    book_preview_img.style.display = 'block';
                                }

                                if (file) {
                                    reader.readAsDataURL(file);
                                } else {
                                    book_preview_img.src = '#';
                                    prevbook_preview_imgiew.style.display = 'none';
                                }
                            }
                        </script>

                        <div class="col-lg-3">
                            <label>E. Book Url :</label>
                            <input type="text" autocomplete="off" value="{{$book->e_book_url}}" name="e_book_url" placeholder="Enter E. Book Url" class="form-control">
                        </div>

                        <div class="col-lg-3">
                            <label>Book Status <sup>*</sup> :</label>
                            @include('components.Library.book-status-import',['class'=>'form-control','selectid'=>$book->status])
                        </div>

                    </div>
                </div>

                <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                    <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book-open"></i>Edit Book/Item Purchase/Stock Details</b></div>
                    <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                        <div class="col-lg-4">
                            <label>Source/Vendor <span class="text-gray">(Optional)</span> :</label>
                            <input type="text" value="{{$book->source}}" name="source" id="source" autocomplete="off" placeholder="Enter Source/Vendor" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <label>Bill No. <span class="text-gray">(Optional)</span> :</label>
                            <input type="text" value="{{$book->bill_no}}" autocomplete="off" placeholder="Enter Bill No." name="bill_no" id="bill_no" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <label>Date <span class="text-gray">(Optional)</span> :</label>
                            <input type="text" value="{{$book->bill_date}}" autocomplete="off" name="bill_date" placeholder="dd-mm-yyyy" class="form-control date">
                        </div>
                        <div class="col-lg-2">
                            <label>Cost <span class="text-gray">(Optional)</span> :</label>
                            <input type="text" value="{{$book->cost}}" name="cost" autocomplete="off" value="0" placeholder="Enter Cost" class="form-control text-right">
                        </div>

                    </div>
                </div>

                <div class="col-lg-12 pd-l-0 pd-r-0 card mg-t-10 shadow-none rounded-0">
                    <div class="card-header bg-light rounded-0 "><b><i class="fa fa-book-open"></i>Edit Book/Item Other Details</b></div>
                    <div class="card-body row m-0 pd-l-0 pd-r-0 pd-t-0 pd-b-10">

                        <div class="col-lg-6">
                            <label>Topic <span class="text-gray">(Optional)</span> :</label>
                            <textarea class="form-control" name="topic" placeholder="Enter Topic">{{$book->topic}}</textarea>
                        </div>

                        <div class="col-lg-6">
                            <label>Remark <span class="text-gray">(Optional)</span> :</label>
                            <textarea class="form-control" name="remark" placeholder="Enter Remark">{{$book->remark}}</textarea>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>


