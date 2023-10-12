@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{__('monitoring.MyleaTitle')}}</li>
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
        @include('Operator.Mylea.Partials.MonitoringSummary')
        <h2>{{__("monitoring.MyleaTitle")}}</h2>
        <div id="MonitoringTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>{{__("monitoring.ProductionCode")}}</th>
                    <th>{{__("common.ProductionDate")}}</th>
                    <th>{{__("common.TotalTray")}}</th>
                    <th>{{__("common.UnderIncubation")}}</th>
                    <th>{{__("common.Contamination")}}</th>
                    <th>{{__("common.Harvest")}}</th>
                    <th>{{__("common.TotalFinishGood")}}</th>
                    <th colspan="2">{{__("common.Action")}}</th>
                </tr>
                @foreach($Data as $item)
                <tr class="text-center">
                    <td>{{ $item['MyleaCode'] }}</td>
                    <td>{{ $item['ProductionDate'] }}</td>
                    <td>{{ $item['TotalTray'] }}</td>
                    <td>{{ $item['InStock']}}  </td>
                    
                    @if ($item['TotalContamination'] > 0)
                        <td><a href="{{route('MyleaContaminationData', ['id'=>$item['id'],])}}">{{ $item['TotalContamination'] }}</a></td>
                    @else
                        <td>{{ $item['TotalContamination'] }}</td>
                    @endif
                    
                    @if ($item['TotalHarvest'] > 0)
                        <td><a href="{{route('MyleaHarvestData', ['id'=>$item['id'],])}}">{{ $item['TotalHarvest'] }}</a></td>
                    @else
                        <td>{{ $item['TotalHarvest'] }}</td>
                    @endif

                    <td>{{ $item['TotalFinishGood'] }}</td>
                    <td><a href="{{route('MyleaProductionDetails', ['id'=>$item['id'],])}}" class="btn btn-primary">{{__("common.Update")}}</a></td>
                    <td><a href="{{route('MyleaContaminationForm', ['id'=>$item['id'],])}}" class="btn btn-primary">{{__("form.ContaminationForm")}}</a></td>
                    <td><a href="{{route('MyleaHarvestForm', ['id'=>$item['id'],])}}" class="btn btn-primary">{{__("form.HarvestForm")}}</a></td>
                
                </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-center">
                {!! $Data->links() !!}
            </div>
        </div>        
    </div>
</div>
@endsection
