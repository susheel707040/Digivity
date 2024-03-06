<tr>
    <td class="text-center"><input name="{{$installment_name}}_id[]" value="{{$data}}" type="checkbox" checked></td>
    <td><input type="text" name="{{$installment_name}}_{{$data}}_name" class="form-control input-sm" placeholder="Installment Name"
               value="{{ucfirst($data)}}"></td>
    <td class="text-center"><input type="text" autocomplete="off" name="{{$installment_name}}_{{$data}}_start_date" class="form-control wd-85 date input-sm" placeholder="dd-mm-yyyy"></td>
    <td class="text-center"><input type="text" autocomplete="off" name="{{$installment_name}}_{{$data}}_end_date" class="form-control wd-85 date input-sm" placeholder="dd-mm-yyyy"></td>
    <td class="text-center">
      <table class="table-borderless">
          <tr>
              <td><input type="radio" value="yes" name="{{$installment_name}}_{{$data}}_fine_apply"></td><td class="pd-l-5">Yes</td>
              <td class="pd-l-10"><input type="radio" value="no" name="{{$installment_name}}_{{$data}}_fine_apply" checked></td><td class="pd-l-5">No</td>
          </tr>
      </table>
    </td>
    <td class="text-center p-0 m-0">
        <table cellpadding="0" cellspacing="0" class="p-0 m-0 table-borderless">
            <tr>
                <td class="pd-r-0">
                    <select name="{{$installment_name}}_{{$data}}_discount_type" class="form-control wd-70 input-sm">
                        <option value="f">Fixed</option>
                        <option value="p">%</option>
                    </select>
                </td>
                <td class="pd-r-0">
                    <input type="text" autocomplete="off" name="{{$installment_name}}_{{$data}}_discount" value="0" class="form-control wd-65 input-sm">
                </td>
            </tr>
        </table>
    </td>
    <td class="text-center">
        <select name="{{$installment_name}}_{{$data}}_sequence" class="form-control text-center input-sm">
            @for($i=1;$i<=50;$i++)
            <option @if($loop->iteration==$i) selected @endif>{{$i}}</option>
            @endfor
        </select>
      </td>
</tr>
