<div class="col-md-12">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style="padding:5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-graduation-cap"></i> Qualification Information</a>
        </li>
    </ul>
</div>

<div class="col-md-12">
    <label>Staff/Employee Qualification <span class="text-gray">(Optional)</span> :</label><br/>
    @if(count(staffqualificationlist()))
        <span class="badge pd-5 tx-11 bd bd-2 bg-light mg-2 text-left pd-l-5 pd-r-5" style="color: black;"><input
                type="checkbox" id="CheckAll" value="checkbox2" class="CheckAll"> <b>Select All</b></span><br/>
        @foreach(staffqualificationlist() as $data)
            <span class="badge pd-5 tx-11 bd bd-1 border-success mg-2 text-left pd-l-5 pd-r-5" style="color: black;">
                 <input type="checkbox" name="qualification[]" class="checkbox2" value="{{$data->id}}">
                 <span class="pd-l-5">{{$data->qualification}}</span></span>
        @endforeach
    @endif
</div>

<div class="col-md-12">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style="padding:5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-language"></i> Skill and Knowledge Information</a>
        </li>
    </ul>

    <div class="col-lg-12 p-0 mg-t-10">
        @if(count(staffskillandknowledgelist()))
            <span class="badge pd-5 tx-11 bd bd-2 bg-light mg-2 text-left pd-l-5 pd-r-5" style="color: black;"><input
                    type="checkbox" id="CheckAll" value="checkbox1" class="CheckAll"> <b>Select All</b></span><br/>
            @foreach(collect(staffskillandknowledgelist())->whereIn("status","enable") as $data)
                <span class="badge pd-5 tx-11 bd bd-1 border-primary mg-2 text-left pd-l-5 pd-r-5" style="color: black;">
                 <input type="checkbox" name="skill_knowledge_id[]" class="checkbox1" value="{{$data->id}}">
                 <span class="pd-l-5">{{$data->skill_name}}</span></span>
            @endforeach
        @else
            <h6 class="text-danger text-center">Sorry, No define Skill and Knowledge <a href="{{url("MasterAdmin/Staff/DefineSkillAndKnowledge")}}"><button type="button" class="btn btn-primary btn-xs rounded-5"><i class="fa fa-plus"></i> Add</button></a></h6>
        @endif
    </div>
</div>


<div class="col-md-12">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding:5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-graduation-cap"></i> Work Experience
                Information</a>
        </li>
    </ul>

    <div class="row p-0 m-0">
        <div class="col-3 p-0 m-0">
            <label>Year <span class="text-gray">(Optional)</span> :</label>
            <select name="ex_year" id="ex_year" class="form-control input-sm">
                <option value="">---Select---</option>
                @for($i=0;$i<=50;$i++)
                    <option value="{{$i}}" @if(isset($staffrecord->ex_year)&&($staffrecord->ex_year==$i)) selected @endif>{{$i}} Year</option>
                @endfor
            </select>
        </div>
        <div class="col-3">
            <label>Month <span class="text-gray">(Optional)</span> :</label>
            <select name="ex_month" id="ex_month" class="form-control input-sm">
                <option value="">---Select---</option>
                @for($i=0;$i<=12;$i++)
                    <option value="{{$i}}" @if(isset($staffrecord->ex_month)&&($staffrecord->ex_month==$i)) selected @endif>{{$i}} Month</option>
                @endfor
            </select>
        </div>
        <div class="col-3">
            <label>Day <span class="text-gray">(Optional)</span> :</label>
            <select name="ex_day" class="form-control input-sm">
                <option>---Select---</option>
                @for($i=0;$i<=31;$i++)
                    <option value="{{$i}}" @if(isset($staffrecord->ex_day)&&($staffrecord->ex_day==$i)) selected @endif>{{$i}} Day</option>
                @endfor
            </select>
        </div>
        <div class="col-md-12 p-0 m-0">
            <label>Work Experience Description</label>
            <textarea class="form-control" name="ex_description"
                      placeholder="Enter Work Experience Description">@if(isset($staffrecord->ex_description)){{$staffrecord->ex_description}}@endif</textarea>
        </div>
    </div>
</div>
