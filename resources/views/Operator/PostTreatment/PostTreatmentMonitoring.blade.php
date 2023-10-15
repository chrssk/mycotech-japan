@extends('layouts.app')

@section('content')
<style>
    td {
        vertical-align : middle;
        text-align:center;
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Post Treatment Monitoring</li>
        </ol>
    </nav>
    <div class="row bg-white p-4 rounded">
        <div class="alertDiv">
            @if(session()->has('Success'))
                <div class="alert alert-success" role="alert">
                    {{session('Success')}}
                </div>
            @elseif(session()->has('Error'))
            <div class="alert alert-danger" role="alert">
                {{session('Error')}}
            </div>
            @endif
        </div>
        {{$Data}}
        <table class="table">
            <tr>
                <th>Post Treatment Date</th>
                <th>Reject</th>
                <th>Finished Goods</th>
                <th>Notes</th>
                <th>Mylea Code</th>
                <th>Harvest Date</th>
                <th>Under Post Treatment</th>

            </tr>
            @foreach ($Data as $item)
                <tr>
                    <td rowspan="{{count($item['details'])+1}}">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal{{$item['id']}}">{{$item['StartDate']}}</a>
                        @include('Operator.PostTreatment.Partials.PostTreatmentUpdate')
                    </td>
                    <td rowspan="{{count($item['details'])+1}}">@if($item['Reject'] == "") 0 @else {{$item['Reject']}} @endif</td>
                    <td rowspan="{{count($item['details'])+1}}">@if($item['FinishGood'] == "") 0 @else {{$item['FinishGood']}} @endif</td>
                    <td rowspan="{{count($item['details'])+1}}">@if($item['Notes'] == "") 0 @else {{$item['Notes']}} @endif</td>
                </tr>
                @foreach ($item['details'] as $detail)
                <tr>
                    <td>{{$detail['MyleaCode']}}</td>
                    <td>{{$detail['HarvestDate']}}</td>
                    <td>{{$detail['Total']}}</td>
                </tr>
                @endforeach
            @endforeach
        </table>
                  
    </div>
</div>
@endsection
