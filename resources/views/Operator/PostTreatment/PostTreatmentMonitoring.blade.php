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
          <li class="breadcrumb-item active" aria-current="page">{{__('monitoring.PostTreatmentTitle')}}</li>
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

        <table class="table">
            <tr>
                <th>{{__('common.PostTreatmentDate')}}</th>
                <th>{{__('monitoring.MyleaCode')}}</th>
                <th>{{__('common.HarvestDate')}}</th>
                <th>{{__('common.UnderPostTreatment')}}</th>
                <th>{{__('common.Reject')}}</th>
                <th>{{__('common.FinishedGoods')}}</th>
                <th>{{__('common.Notes')}}</th>
                <th>{{__('common.Action')}}</th>
            </tr>
            @foreach ($Data as $item)
                @php $i = 0; @endphp
                @foreach ($item['details'] as $detail)
                    <tr>
                        @if ($i == 0)
                            <td rowspan="{{count($item['details'])+1}}">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal{{$item['id']}}">{{$item['StartDate']}}</a>
                                @include('Operator.PostTreatment.Partials.PostTreatmentUpdate')
                            </td>
                        @endif
                        <td>{{$detail['MyleaCode']}}</td>
                        <td>{{$detail['HarvestDate']}}</td>
                        <td>{{$detail['Total']}}</td>
                        @if ($i == 0)
                            <td rowspan="{{count($item['details'])+1}}">@if($item['Reject'] == "") 0 @else {{$item['Reject']}} @endif</td>
                            <td rowspan="{{count($item['details'])+1}}">@if($item['FinishGood'] == "") 0 @else {{$item['FinishGood']}} @endif</td>
                            <td rowspan="{{count($item['details'])+1}}">@if($item['Notes'] == "") - @else {{$item['Notes']}} @endif</td>
                            <td rowspan="{{count($item['details'])+1}}">
                                <a href="{{route('PostTreatmentDelete', ['id'=>$item['id']])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                            </td>
                        @endif
                    </tr>
                    @php $i++; @endphp
                @endforeach
                <tr>

                </tr>
            @endforeach

        </table>
                  
    </div>
</div>
@endsection
