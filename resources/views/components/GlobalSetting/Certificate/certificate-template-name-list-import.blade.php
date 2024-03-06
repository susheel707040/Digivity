<select @if(isset($id)) id="{{$id}}" @else id="certificate_title_slug" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="certificate_title_slug" @endif >
    <option value="">---Select---</option>
    @foreach(certificatetemplatenamelist() as $data)
        @if($data->certificate_title_slug)
        <option value="{{$data->certificate_title_slug}}" @if(isset($selectid)&&($data->certificate_title_slug==$selectid)) selected @endif>{{$data->certificate_title}}</option>
        @endif
    @endforeach
</select>



