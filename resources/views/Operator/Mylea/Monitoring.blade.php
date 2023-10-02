@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mylea Monitoring</li>
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

        @include('Partials.LangOption')

        <h2>{{__("monitoring.MyleaTitle")}}</h2>
        <div id="MonitoringTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>{{__("monitoring.ProductionCode")}}</th>
                    <th>{{__("common.ProductionDate")}}</th>
                    <th>{{__("common.TotalTray")}}</th>
                    <th>{{__("common.Contamination")}}</th>
                    <th>{{__("common.Harvest")}}</th>
                    <th>{{__("common.FinishGood")}}</th>
                    <th>{{__("common.InStock")}}</th>
                    <th colspan="4">{{__("common.Action")}}</th>
                </tr>
                @foreach($Data as $item)
                <tr class="text-center">
                    <td>{{ $item['MyleaCode'] }}</td>
                    <td>{{ $item['ProductionDate'] }}</td>
                    <td>{{ $item['TotalTray'] }}</td>
                    <td>{{ $item['TotalContamination'] }}</td>
                    <td>{{ $item['TotalHarvest'] }}</td>
                    <td>{{ $item['TotalFinishGood'] }}</td>
                    <td>{{ $item['TotalTray'] - ($item['TotalContamination'] + $item['TotalHarvest']) }}  </td>
                    {{-- <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                            Update
                        </button>
                        @include('Operator.Baglog.Partials.UpdateBaglogPartials')
                    </td> --}}
                    {{-- <td><a href="{{route('BaglogMonitoringDelete', ['id'=>$item['id'],])}}">Delete</a></td> --}}
                    <td><a href="{{route('MyleaContaminationForm', ['id'=>$item['id'],])}}">{{__("common.Contamination")}}</a></td>
                    <td><a href="{{route('MyleaContaminationData', ['id'=>$item['id'],])}}">{{__("monitoring.ContaminationData")}}</a></td>
                    <td><a href="{{route('MyleaHarvestForm', ['id'=>$item['id'],])}}">{{__("common.Harvest")}}</a></td>
                    <td><a href="{{route('MyleaHarvestData', ['id'=>$item['id'],])}}">{{__("monitoring.HarvestData")}}</a></td>
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
