<select name="" class="form-control input-sm">
    <option value="">---Select---</option>
    @foreach(timetablelist([]) as $data)
        <option value="{{$data->id}}">{{$data->timetable}}</option>
    @endforeach
</select>
