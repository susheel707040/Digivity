<form action="{{url('MasterAdmin/Finance/CreateFeeHeadMapWithInstallment')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <table class="col-lg-12 mg-t-10">
                    <tr>
                        <td class="wd-35p"><label><b>Fee Head <sup>*</sup> : </b></label></td>
                        <td>@include('components.Finance.fee-head-import')</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <table class="mg-t-10">
                    <tr>
                        <td><b>Pay Schedule <sup>*</sup> :</b></td>
                        <td class="pd-l-10"><input type="radio" class="pay_type" name="pay_type" value="lifetime"
                                                   checked></td>
                        <td class="pd-l-5">Lifetime</td>
                        <td class="pd-l-10"><input type="radio" class="pay_type" name="pay_type" value="annual"></td>
                        <td class="pd-l-5">Annual</td>
                        <td class="pd-l-10"><input type="radio" class="pay_type" name="pay_type" value="installment">
                        </td>
                        <td class="pd-l-5">Installment</td>
                        <td class="pd-l-10"><input type="radio" class="pay_type" name="pay_type" value="custom"></td>
                        <td class="pd-l-5">Custom</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <table class="tx-12 mg-t-10 table-small table-bordered">
                    <thead>
                    <tr class="bg-light ">
                        <td class="text-center"><input type="checkbox" value="" checked></td>
                        <td><b>Installment Name</b></td>
                        <td class="text-center"><b>Collect Date</b></td>
                        <td class="text-center"><b>Due Date</b></td>
                        <td class="text-center"><b>Apply Fine</b></td>
                        <td class="text-center"><b>Discount</b></td>
                        <td class="text-center"><b>Sequence</b></td>
                    </tr>
                    </thead>
                    <tbody id="lifetime-table" class="fee-head-body">
                    @foreach($feemonth['lifetime'] as $data)
                        @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Component.fee-head-table-body',['installment_name'=>'lifetime'])
                    @endforeach
                    </tbody>

                    <tbody id="annual-table" class="fee-head-body" style=" display:none; ">
                    @foreach($feemonth['annual'] as $data)
                        @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Component.fee-head-table-body',['installment_name'=>'annual'])
                    @endforeach
                    </tbody>

                    <tbody id="installment-table" class="fee-head-body" style=" display:none; ">
                    @foreach($feemonth['installment'] as $data)
                        @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Component.fee-head-table-body',['installment_name'=>'installment'])
                    @endforeach
                    </tbody>

                    <tbody id="custom-table" class="fee-head-body" style=" display:none; ">
                    @foreach($feemonth['custom'] as $data)
                        @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Component.fee-head-table-body',['installment_name'=>'custom'])
                    @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-15 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Save</button>
    </div>
</form>

<script type="text/javascript">
    $(".pay_type").on("change", function () {
        $(".fee-head-body").hide();
        $("#" + $(this).val() + "-table").show();
    })
</script>

