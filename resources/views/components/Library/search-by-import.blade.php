@php
$search_by=['book_title'=>'Book Title','topic'=>'Topic','book_no'=>'Book Number','accession_no'=>'Accession Number','ddc_no'=>'DDC Number'
,'barcode_no'=>'Barcode Number','author'=>'Author Name','tag'=>'Tag Name','genre'=>'Genre Name','racks'=>'Racks','subject'=>'Subject','edition'=>'Edition','publisher'=>'Publisher','shelf_no'=>'Shelf Number'
,'location'=>'Location','source'=>'Source','bill_no'=>'Bill Number','remark'=>'Remark','current_issue'=>'Current Issue'];
@endphp
<select name="search_by" class="form-control">
    @foreach($search_by as $key=>$value)
        <option value="{{$key}}">{{$value}}</option>
    @endforeach
</select>
