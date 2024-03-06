<div class="modal fade" id="addRouteRelation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered container-fluid" role="document">
        <div class="modal-content" >
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-plus fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1"><b>Add New Route Relation</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0">Route Relation With Route, Route Stop, Vehicle, Driver</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->
            <form action="{{url('MasterAdmin/Transport/CreateRouteRelation')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
            {{csrf_field()}}
            <div id="ModelLoadData" class="modal-body pd-sm-t-0 pd-sm-b-0 pd-sm-x-5">
                <table class="table table-bordered mg-t-10 mg-b-5 tx-12">
                    <thead class="bg-gray-100">
                    <tr>
                        <th>Route <sup>*</sup></th>
                        <th class="wd-20p">Route Stop <sup>*</sup></th>
                        <th class="wd-10p">Morning Time</th>
                        <th class="wd-10p">Afternoon Time</th>
                        <th class="wd-15p">Vehicle</th>
                        <th>Driver</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            <select name="route_id" id="route_id" class="form-control input-sm" required="">
                                <option value="">---Select---</option>
                                @foreach(routelist() as $data)
                                    @if(request()->route('routeid')==$data->id)
                                    <option value="{{$data->id}}" selected>{{$data->route}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="route_stop_id" id="route_stop_id" class="form-control input-sm" required="">
                                <option value="">---Select---</option>
                                @foreach(routestoplist() as $data)
                                    <option value="{{$data->id}}" >{{$data->route_stop}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="morning_time" id="morning_time" placeholder="hh:mm:ss" autocomplete="off" placeholder="" class="form-control timepicker input-sm">
                        </td>
                        <td>
                            <input type="text" name="afternoon_time" id="afternoon_time" placeholder="hh:mm:ss" autocomplete="off" placeholder="" class="form-control timepicker input-sm">
                        </td>
                        <td>
                            <select name="vehicle_id" id="vehicle_id" class="form-control input-sm">
                                <option value="">---Select---</option>
                                @foreach(vehiclelist() as $data)
                                    <option value="{{$data->id}}">{{$data->registration_no }} ({{$data->vehicle_name}})</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="driver_id" name="driver_id" class="form-control input-sm">
                                <option value="">---Select---</option>
                            </select>
                        </td>
                        <td class="wd-10p text-center">
                            <button type="button" class="btn btn-danger btn-xs"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" class="p-0 m-0">
                            <ul class="nav nav-line tx-12 pd-t-0 mg-t-0 pd-l-5 " id="myTab5" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" style=" padding: 10px 0px;" id="home-tab5" data-toggle="tab" href="#home5" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-rupee-sign"></i> <b>Transport Fee/Rent/Fare </b></a>
                                </li>
                                <li class="pd-l-40">
                                    <table class="pd-l-20 table-borderless">
                                        <tr>
                                            <td><b>All Instalment Amount :</b></td>
                                            <td><input type="text" placeholder="Enter Amount" value="0" class="form-control all-instalment-amt input-sm wd-80"></td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>

                            <table class="table table-borderless mg-t-10 ">
                                @if(isset($feeheadinstalment))
                                <tr>
                                    @foreach($feeheadinstalment->feeheadinstalment as $data)
                                        <td class="text-capitalize"><b>{{$data->print_name}}: <input type="hidden" name="instalment_id[]" value="{{$data->instalment_id}}" hidden></b></td>
                                        <td class="p-0 m-0"><input type="text" name="fee_amt_{{$data->instalment_id}}_id[]" class="form-control all-instalment-input wd-50 input-sm text-center" value="0"></td>
                                    @endforeach
                                </tr>
                                @else
                                    {{recordnofound(1)}}
                                @endif
                            </table>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer pd-x-20 pd-y-15">
                <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
            </div>
        </form>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<script type="text/javascript">
    $(".all-instalment-amt").on('keyup',function(){
        $(".all-instalment-input").val($(this).val());
    });
</script>

