@extends('layouts.MasterLayout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">User Map With Module</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-check-square"></i> User Map With ERP Module</b></div>
            <div class="panel-body pd-b-0 row">
                <div id="search-body" class="col-lg-12 pd-t-20 pd-b-20 nav-line">
                    <table class="col-lg-8 mx-auto">
                        <tr>
                            <td class="wd-5p"><b>Role <sup>*</sup></b></td>
                            <td><b>:</b></td>
                            <td>
                                <select id="roleid" class="form-control input-sm" required="">
                                    <option value="">---Select---</option>
                                    @if(!is_null($role))
                                    @foreach($role as $data)
                                        <option value="{{$data->id}}"
                                                @if(request()->route('roleid')==$data->id) selected @endif>{{$data->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </td>
                            <td class="pd-l-20"><b>User</b></td>
                            <td class="pd-l-5"><b>:</b></td>
                            <td class="pd-l-10">
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="0">---Select---</option>
                                    @foreach($user as $data)
                                    <option value="{{$data->id}}" @if(request()->route('userid')==$data->id) selected @endif>{{$data->fullName()}} ({{$data->username}} - {{$data->RoleName()}})</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="wd-25p pd-l-20">
                                <button type="button" id="ContinueBtn" class="btn btn-outline-success">Continue <i
                                        class="fa fa-angle-right"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row p-0 m-0">
            @if(request()->route('roleid'))
                <form class="row p-0 m-0" action="{{url('MasterAdmin/GlobalSetting/CreateUserModule')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="role_id" value="{{request()->route('roleid')}}">
                    <input type="hidden" name="user_id" value="{{request()->route('userid')}}">
                <div class="col-lg-10 pd-10">
                    <div class="d-flex bg-white">
                        <div class="flex-1">
                            <div class="card">
                                <div class="card-header bg-gray-100"><i class="fa fa-desktop"></i> Web Application
                                    Modules
                                    <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox1"> Select All</span>
                                </div>
                                <div class="card-body pd-10 pd-t-20 pd-b-20 tx-13 m-0 flex-fill">
                                    @if(!is_null($getwebapp))
                                    @foreach($getwebapp as $module)
                                       <div class="col-6 pd-b-2 pd-t-2 pd-l-10 pd-r-10 float-left text-uppercase">
                                           <div class="container-fluid  bg-gray-100 rounded-5 bd bd-1 pd-l-10 pd-t-5 pd-b-5">
                                                <table class="col-lg-12 p-0 m-0 ">
                                                   <tr>
                                                       <td><input type="checkbox" name="web_app_module[]" class="checkbox1" value="{{$module}}" @if(in_array($module,isset($existwebappmodule[$module]) ? [$existwebappmodule[$module]['module_id']] :[])) checked @endif></td>
                                                       <td><input type="text" class="form-control bd-0 pd-b-0 pd-t-0 bg-gray-100" name="web_app_module_{{$module}}_text" value="{{isset($existwebappmodule[$module]) ? $existwebappmodule[$module]['module_text'] : ucwords(\Illuminate\Support\Str::replaceArray('-',[' '],$module))}}"></td>
                                                       <td><input type="text" class="form-control bd-0 bg-success-light wd-30 text-center" name="web_app_{{$module}}_sequence" value="{{isset($existwebappmodule[$module]) ? $existwebappmodule[$module]['module_sequence'] : $loop->iteration}}"></td>

                                                   </tr>
                                               </table>
                                           </div>

                                       </div>
                                    @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="divider-text divider-vertical"><b>and</b></div>
                        <div class="flex-1">
                            <div class="card">
                                <div class="card-header bg-gray-100"><i class="fa fa-mobile-alt"></i> Mobile & Tablet
                                    Application Modules
                                    <span class="float-right"><input id="" type="checkbox"  class="CheckAll" value="checkbox2"> Select All</span>
                                </div>

                                <div class="card-body pd-10 pd-t-20 pd-b-20 tx-13 m-0 flex-fill">
                                    @if(!is_null($getmobileapp))
                                    @foreach($getmobileapp as $key=>$modules)
                                        <span class="float-left mg-l-10 mg-b-5 pd-b-3 bd-2 bd-b" style=" width:95%; "><input type="checkbox" name="mobile_app_module[]" value="{{$key}}" checked hidden> <b>{{ucwords(\Illuminate\Support\Str::replaceArray('-',[' '],$key))}}</b></span>
                                        @foreach($modules as $module)
                                        <div class="col-6 pd-b-2 pd-t-2 pd-l-10 pd-b-10 pd-r-10 float-left text-uppercase">
                                            <div class="container-fluid  bg-gray-100 rounded-5 bd bd-1 pd-l-10 pd-t-5 pd-b-5">
                                                <table class="col-lg-12 p-0 m-0 ">
                                                    <tr>
                                                        <td><input type="checkbox" name="mobile_app_{{$key}}_module[]" class="checkbox2" value="{{$module}}" @if(in_array($module,isset($existmobileappmodule[$key][$module]) ? [$existmobileappmodule[$key][$module]['module_id']] :[])) checked @endif></td>
                                                        <td><input type="text" class="form-control bd-0 bg-gray-100" name="mobile_app_module_{{$module}}_text" value="{{isset($existmobileappmodule[$key][$module]) ? $existmobileappmodule[$key][$module]['module_text'] : ucwords(\Illuminate\Support\Str::replaceArray('-',[' '],$module))}}"></td>
                                                        <td><input type="text" class="form-control bd-0 bg-success-light wd-30 text-center" name="mobile_app_{{$module}}_sequence" value="{{isset($existmobileappmodule[$key][$module]) ? $existmobileappmodule[$key][$module]['module_sequence'] : $loop->iteration}}"></td>

                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                            @endforeach
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 vhr">
                    <button type="submit" class="btn btn-outline-primary btn-block mg-t-10"> <i class="fa fa-check"></i>  Update</button>
                </div>
                </form>
            @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#ContinueBtn").click(function () {
                if ($("#roleid").val()) {
                    return window.location.assign("/MasterAdmin/GlobalSetting/UserMapWithModule/" + $("#roleid").val() + "/"+$("#user_id").val()+"/continue");

                }
                return window.location.assign('/MasterAdmin/GlobalSetting/UserMapWithModule');
            });
        });
    </script>

@endsection
