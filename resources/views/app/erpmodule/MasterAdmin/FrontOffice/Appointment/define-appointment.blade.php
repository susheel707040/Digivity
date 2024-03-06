@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Appointment')
@section('ModelTitleInfo','Manage New Appointment')
@section('EditModelTitle','Edit Appointment')
@section('EditModelTitleInfo','Modify Appointment')
@section('ModelSize','modal-xxl')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.FrontOffice.Appointment.Add.add-appointment')
@endsection
