@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/StudentInformation/index')}}">Student Information</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Student Generate Transfer Certificate (TC)</li>
        </ol>
    </nav>

@endsection
