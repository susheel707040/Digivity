@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">User</li>
            <li class="breadcrumb-item active" aria-current="page">User Permission</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-sitemap"></i> User Permission</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/User/UserPermission')}}" method="POST">
                    {{csrf_field()}}
                <div class="col-lg-12 row pd-l-0 pd-r-0 pd-t-10 pd-b-10 m-0">
                    <div class="col-lg-2">
                        <label>Role :</label>
                        @include('components.role-import',['class'=>'form-control','selectid'=>request()->get('role_id')])
                    </div>
                    <div class="col-lg-2">
                        <label>Username :</label>
                        <input type="text" name="username" value="{{request()->get('username')}}" placeholder="Enter Username" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <label>User :</label>
                        @include('components.User.user-list-import',['class'=>'form-control','selectid'=>request()->get('user_id')])
                    </div>
                    {{-- <div class="col-lg-2">
                        <label>Select Module :</label>
                        <select class="form-control">
                            <option>---Select---</option>
                        </select>
                    </div> --}}
                    <div class="col-lg-2">
                        <button class="btn btn-primary mg-t-20">Continue <i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
                </form>

                @if(isset($user))
                <form class="container-fluid" action="{{url('MasterAdmin/User/CreateUserPermission')}}" method="POST">
                {{csrf_field()}}
                    <input type="hidden" name="role_id" value="{{$user->role_id}}">
                    <input type="hidden" name="ac_user_id" value="{{$user->id}}">
                    <div class="col-lg-12 row p-0 m-0 bd-t bd-2">
                    <div class="col-lg-10">
                    <table class="table table-bordered mg-t-10">
                        <thead>
                        <tr>
                            <th colspan="4"><b>Username :</b> {{$user->username}}</th>
                            <th colspan="4"><b>Full Name :</b> {{$user->fullName()}}</th>
                            <th colspan="3"><b>Role :</b> {{$user->RoleName()}}</th>
                        </tr>
                        </thead>
                        <thead class="bg-light">
                        <tr>
                            <th>Sl.No.</th>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th>Navbar</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Models\Navbar::query()->whereNull('parent_id')->orderBy('sequence')->get() as $module)
                            <tr class="bg-light">
                                <td></td>
                                <td class="text-center"><input type="checkbox"></td>
                                <td colspan="4"><b>{{ucwords($module->value)}}</b></td>
                            </tr>
                            {{navlinks($module->key)}}
                        @endforeach
                        @foreach($getwebapp as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center"><input type="checkbox" name="web_app_module[]" class="checkbox1" value="{{$data}}"></td>
                                <td>
                                <table class="table-borderless">
                                    <tr>
                                        <td><input type="text" autocomplete="off" class="border-0" name="web_app_module_{{$data}}_text" value="{{ucwords(\Illuminate\Support\Str::replaceArray('-',[' '],$data))}}"></td>
                                        <td><input type="text" autocomplete="off" name="web_app_{{$data}}_sequence" class="border-0 bg-success-light wd-30 text-center rounded-5" value="{{$loop->iteration}}"></td>
                                    </tr>
                                </table>
                                </td>
                                <td>-----</td>
                                <td>-----</td>
                                <td><input type="checkbox" class="AddCheck" checked></td>
                                <td><input type="checkbox" class="ModifyCheck" checked></td>
                                <td><input type="checkbox" class="RemoveCheck" checked></td>
                                <td><input type="checkbox" class="ViewCheck" checked></td>
                                <td><input type="checkbox" class="ExportCheck" checked></td>
                                <td><input type="checkbox" class="PrintCheck" checked></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>

                    <div class="col-lg-2 text-center">
                        <button class="btn btn-primary mg-t-10 mg-b-20 btn-block btn-lg"><i class="fa fa-check"></i> Submit</button>
                        <button class="btn btn-danger btn-block btn-lg mg-t-20"><i class="fa fa-trash"></i> Remove</button>
                    </div>
                </div>
                </form>
                @endif
            </div>
        </div>
    </div>

    @php
    function navlinks($parentid){
     foreach (\App\Models\Navbar::query()->where('parent_id',$parentid)->orderBy('sequence')->get() as $navdata){
     $tr="<tr><td></td><td class='text-center'><input type='checkbox'></td><td>".ucwords(str_replace('.',' ',$navdata->value))."</td><td>";
     $operationhtml="";
     $operation=explode(",",$navdata->operation);
     if(is_array($operation)&&(count($operation)>0)){
         foreach ($operation as $operationid){
          if($operationid){
          $operationhtml.="<span class='pd-l-5'><input type='checkbox' value='$operationid'> ".ucwords(str_replace('.',' ',$operationid))."</span>";
          }
         }
     }
     $tr.=$operationhtml;
     $tr.="</td></tr>";
     echo $tr;
     navlinks($navdata->key);
     }
     }
    @endphp

@endsection
