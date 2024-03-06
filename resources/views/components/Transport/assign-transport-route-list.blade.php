@php
    if (!isset($search)) {
        $search = [];
    }
@endphp
<select @if (isset($id)) id="{{ $id }}" @else id="transport_id" @endif
    @if (isset($class)) class="{{ $class }}" @else class="form-control input-sm" @endif
    @if (isset($required)) {{ $required }} @endif
    @if (isset($name)) name="{{ $name }}" @else name="transport_id" @endif
    data-parsley-error-message="Select Section">
    <option>---Select---</option>
    @foreach (routerelationlist() as $data)
    @if ($data->vehicle) {{-- Check if vehicle exists --}}
        <option value="{{ $data->id }}" @if (isset($selectid) && $selectid == $data->id) selected @endif>
            {{ $data->route->route }} - {{ $data->routestop->route_stop }} -
            {{ $data->vehicle->registration_no }} ({{ $data->vehicle->vehicle_name }})
        </option>
    @endif
@endforeach
</select>
