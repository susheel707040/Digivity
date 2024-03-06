@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Collection Setting</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/Finance/UpdateFeeCollectionSetting')}}" method="POST">
    {{csrf_field()}}
        <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-cog"></i> Fee Collection Setting</b></div>
            <div class="panel-body pd-10 pd-b-10 row m-0">
                <div class="col-lg-10 row m-0 p-0">
                <div class="col-lg-2">
                    <label>Fee Collection Status <sup>*</sup>:</label>
                    <select name="fee_collection_status" class="form-control">
                        <option value="enable">Enable</option>
                        <option value="disable">Disable</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Entry Mode Setting <sup>*</sup> :</label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="entry_mode" value="school" checked></td><td class="pd-l-5">School</td>
                            <td class="pd-l-10"><input type="checkbox" value="bank" name="entry_mode" checked></td><td class="pd-l-5">Bank</td>
                            <td class="pd-l-10"><input type="checkbox" value="online" name="entry_mode" checked></td><td class="pd-l-5">Online</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-3">
                    <label>Default Entry Mode <sup>*</sup> :</label>
                    <table>
                        <tr>
                            <td><input type="radio" name="default_entry_mode" value="school" checked></td><td class="pd-l-5">School</td>
                            <td class="pd-l-10"><input type="radio" name="default_entry_mode" value="bank"></td><td class="pd-l-5">Bank</td>
                            <td class="pd-l-10"><input type="radio" name="default_entry_mode" value="online"></td><td class="pd-l-5">Online</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                        <label>Sibling Fee Collection Entry <sup>*</sup> :</label>
                        <table>
                            <tr>
                                <td><input type="radio" name="sibling_collection_mode" value="yes" checked></td><td class="pd-l-5">Yes</td>
                                <td class="pd-l-10"><input type="radio" name="sibling_collection_mode" value="no"></td><td class="pd-l-5">No</td>
                            </tr>
                        </table>
                </div>
                </div>
                <div class="col-lg-2 vhr">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-check"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
    </form>



@endsection
