@php $entrymode=['school'=>'School','bank'=>'Bank','online'=>'Online'] @endphp
<select  @if(isset($id)) id="{{$id}}" @else id="entry_mode" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="entry_mode" @endif >
    <option value="">---Select---</option>
    @foreach($entrymode as $id=>$value)
        <option value="{{$id}}"  @if(isset($selectid)&&($id==$selectid)) selected @endif>{{$value}}</option>
    @endforeach
</select>
