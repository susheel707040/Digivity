@if(isset($receiptconfig)&&$receiptconfig->is_footer=="yes")
<table cellpadding="0" cellspacing="0" class="table-receipt table-footer table-borderless m-0 p-0 @if($receiptconfig->is_footer_line=='yes') bd-1 bd @endif"
style=" font-size:{{$receiptconfig->f_font_size}}; background:{{$receiptconfig->bg_color}};
    color:{{$receiptconfig->text_color}}; ">
    <tr>
        <td style="text-align:{{$receiptconfig->f_align}}; ">{!! $receiptconfig->footer_body !!}</td>
    </tr>
</table>
@endif
