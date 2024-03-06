@php $row=0; @endphp
@foreach($userdata as $data)
    @php $row++; @endphp
<div class="id-card-main" style=" background-image:url('http://127.0.0.1:8000/storage/public/file/id-card-template.png'); background-repeat:no-repeat;  ">
    <table style="width:95%; margin:0 auto; font-size: 11px; margin-top:28%; ">
        <tr>
            <td></td><td></td><td>
                <img height="95px" style="float:right; border:2px solid #F06F4D;  " src="{{$data->ProfileImage()}}">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <img height="25px" style="width:100%; " src="https://barcode.tec-it.com/barcode.ashx?data={{$data->admission_no}}&code=Code39&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=&qunit=Mm&quiet=">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="title-name">{{$data->fullName()}}</div>
            </td>
        </tr>
        <tr>
            <td><b>Course</b></td><td><b>:</b></td><td><b>{{$data->course->course}} - 2020-21</b></td>
        </tr>
        <tr>
            <td><b>Father</b></td><td><b>:</b></td><td>{{$data->FatherName()}}</td>
        </tr>
        <tr>
            <td><b>Address</b></td><td><b>:</b></td><td style="font-size:10px; width:125px;  ">{{$data->Address()}}</td>
        </tr>
        <tr>
            <td><b>Contact No.</b></td><td><b>:</b></td><td>{{$data->student->contact_no}}</td>
        </tr>
    </table>
</div>
    @if($row==10)
        @php $row=0; @endphp
        <h1></h1>
    @endif
@endforeach
<style>
    @media print {
        h1 {page-break-after: always;}
    }
    .id-card-main{ margin-top:10px;  font-family: Arial, Helvetica, sans-serif;font-size: 22px; width:224px; height:382px;  margin:1px; background-size: contain; float: left;    }
.title-name{ width:98%; padding:.5%; text-align: center; font-size:1rem;  background-color:#EB7150; color:white; font-weight:bold;   }
</style>
