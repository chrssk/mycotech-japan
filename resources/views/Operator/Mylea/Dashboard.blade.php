@extends('layouts.app')

@section('content')
<style>
    td {
        text-align: center
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mylea Dashboard</li>
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
    </div>

    <div id="dashboard" class="bg-white">
        <h2>Dashboard</h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr>
                    <th rowspan="2" class="table-dark border-white sticky-header-left"></th>
                    <th colspan="3" class="text-center table-dark border-white">Q1</th>
                    <th colspan="3" class="text-center table-dark border-white">Q2</th>
                    <th colspan="3" class="text-center table-dark border-white">Q3</th>
                    <th colspan="3" class="text-center table-dark border-white">Q4</th>
                </tr>
                <tr>
                    <th class="table-dark border-white">Jan</th>
                    <th class="table-dark border-white">Feb</th>
                    <th class="table-dark border-white">Mar</th>
                    <th class="table-dark border-white">Apr</th>
                    <th class="table-dark border-white">May</th>
                    <th class="table-dark border-white">Jun</th>
                    <th class="table-dark border-white">Jul</th>
                    <th class="table-dark border-white">Aug</th>
                    <th class="table-dark border-white">Sep</th>
                    <th class="table-dark border-white">Oct</th>
                    <th class="table-dark border-white">Nov</th>
                    <th class="table-dark border-white">Dec</th>
                </tr>
                <tr>
                    <th class="title sticky-header-left bg-light">Total Mylea Production</th>
                    <td>{{$Data->where('ProductionDate', '01')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '02')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '03')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '04')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '05')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '06')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '07')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '08')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '09')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '10')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '11')->sum('TotalTray')}}</td>
                    <td>{{$Data->where('ProductionDate', '12')->sum('TotalTray')}}</td>
                </tr>
                <tr>
                    <th class="title sticky-header-left bg-light">Harvest Rate</th>
                    <td>@if($Data->where('ProductionDate', '01')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '01')->sum('TotalHarvest')/$Data->where('ProductionDate', '01')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '02')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '02')->sum('TotalHarvest')/$Data->where('ProductionDate', '02')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '03')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '03')->sum('TotalHarvest')/$Data->where('ProductionDate', '03')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '04')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '04')->sum('TotalHarvest')/$Data->where('ProductionDate', '04')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '05')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '05')->sum('TotalHarvest')/$Data->where('ProductionDate', '05')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '06')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '06')->sum('TotalHarvest')/$Data->where('ProductionDate', '06')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '07')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '07')->sum('TotalHarvest')/$Data->where('ProductionDate', '07')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '08')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '08')->sum('TotalHarvest')/$Data->where('ProductionDate', '08')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '09')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '09')->sum('TotalHarvest')/$Data->where('ProductionDate', '09')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '10')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '10')->sum('TotalHarvest')/$Data->where('ProductionDate', '10')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '11')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '11')->sum('TotalHarvest')/$Data->where('ProductionDate', '11')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                    <td>@if($Data->where('ProductionDate', '12')->sum('TotalTray') != 0){{round($Data->where('ProductionDate', '12')->sum('TotalHarvest')/$Data->where('ProductionDate', '12')->sum('TotalTray'), 2)*100}} @else 0 @endif%</td>
                </tr>
                <tr>
                    <th class="title sticky-header-left bg-light">Total Harvest</th>
                    <td>{{$Data->where('ProductionDate', '01')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '02')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '03')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '04')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '05')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '06')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '07')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '08')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '09')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '10')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '11')->sum('TotalHarvest')}}</td>
                    <td>{{$Data->where('ProductionDate', '12')->sum('TotalHarvest')}}</td>
                </tr>
                <tr>
                    <th class="title sticky-header-left bg-light">Finish Good</th>
                    <td>{{$FinishGood->where('date', '01')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '02')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '03')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '04')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '05')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '06')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '07')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '08')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '09')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '10')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '11')->sum('FinishGood')}}</td>
                    <td>{{$FinishGood->where('date', '12')->sum('FinishGood')}}</td>
                </tr>
            </table>
    </div>
    
</div>
@endsection
