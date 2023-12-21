@extends('layouts.app')

@section('content')
<style>
    .card {
        height: 100%
    }
</style>
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
        <div id="SummaryNFilter">
            <div class="row">
                @include('Operator.Mylea.Partials.MonitoringSummary')
                @include('Operator.Mylea.Partials.MonitoringFilter')
            </div>
        </div>
       
        <h2 class="mt-2">{{__("monitoring.MyleaTitle")}}</h2>
        <div id="MonitoringTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>{{__("monitoring.ProductionCode")}}</th>
                    <th>{{__("common.ProductionDate")}}</th>
                    <th>{{__("common.TotalProductionTray")}}</th>
                    <th>{{__("common.UnderIncubation")}}</th>
                    <th>{{__("common.Contamination")}}</th>
                    <th>{{__("common.Harvest")}}</th>
                    <th colspan="4">{{__("common.Action")}}</th>
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
                    
                    <td><a href="{{route('MyleaProductionDetails', ['id'=>$item['id'],])}}" class="btn btn-primary">{{__("common.Update")}}</a></td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $item['id'] }}">
                            {{__("common.Delete")}}
                        </button>
                        @include('Operator.Mylea.Partials.DeleteMyleaConfirmation')
                    </td>
                    <td><a href="{{route('MyleaContaminationForm', ['id'=>$item['id'],])}}" class="btn btn-primary">{{__("form.ContaminationForm")}}</a></td>
                    <td><a href="{{route('MyleaHarvestForm', ['id'=>$item['id'],])}}" class="btn btn-primary">{{__("form.HarvestForm")}}</a></td>
                
                </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-center">
                @if (!isset($_GET['filter']))
                {!! $Data->links() !!}
                @endif
            </div>
        </div>        
    </div>
</div>
@endsection
