@extends('layouts.api-web-view-master-layout')
@section('content')
    <div class='col-12 p-2 tx-13'>
        <table cellpadding='0' cellspacing='0' class='table table-bordered bg-light-dark'>
            <tbody>
            <tr>
                <td colspan="2"><b>Result Date :</b> {{$form_date}} to {{$to_date}}</td>
            </tr>
            <tr>
                <td><b>Total Receipt :</b> <span class="badge badge-primary tx-13">{{count($feecollection)}}</span></td>
                <td><b>Total Concession :</b> <span class="badge badge-danger tx-13">{{numberformat($feecollection->sum('concession_total'),2)}}</span></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class='col-12 p-2'>
        <table class="table border table-bordered bg-light tx-12">
            <thead class="bg-light-dark ">
            <tr>
                <th>Student Detail</th>
                <th>Receipt Detail</th>
                <th class="text-right">Fine Concession</th>
                <th class="text-right">Concession Amount</th>
            </tr>
            </thead>
            <tbody class="bg-light">
            @foreach($feecollection as $data)
            <tr>
                <td style="width:38%;">
                    <span><b>Adm. No.:</b>{{$data->AdmissionNo()}}</span><br/>
                    <span><b>{{$data->fullName()}}</b> - <span class="tx-11">({{$data->CourseSection()}})</span></b></span><br/>
                    <span><b>S/O</b> {{$data->FatherName()}}</span>
                </td>
                <td style="width:22%;">
                    <span><b>Recpt. No:</b> <span class="tx-11">{{$data->receipt_id}}</span></span><br/>
                    <span><b>Recpt. Date:</b> <span class="tx-11">{{nowdate($data->receipt_date,"d-m-Y")}}</span></span>
                </td>
                <td class="text-right">{{numberformat($data->fine_concession,2)}}</td>
                <td class="text-right">{{numberformat($data->concession_total,2)}}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot class="bg-light-dark">
            <td colspan="2" class="text-right"><b>Total :</b></td>
            <td class="text-right"><b>{{numberformat($feecollection->sum('fine_concession'),2)}}</b></td>
            <td class="text-right"><b>{{numberformat($feecollection->sum('concession_total'),2)}}</b></td>
            </tfoot>
        </table>
    </div>

@endsection
