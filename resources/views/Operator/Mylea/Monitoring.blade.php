@extends('layouts.app')

@section('content')
<div class="container">
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

        <h2>Mylea Monitoring</h2>
        <div id="MonitoringTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>Production Code</th>
                    <th>Production Date</th>
                    <th>Total Tray</th>
                    <th>Contamination</th>
                    <th>Harvest</th>
                    <th>Finish Good</th>
                    <th>In Stock</th>
                    <th colspan="4">Action</th>
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
                    <td><a href="{{route('MyleaContaminationForm', ['id'=>$item['id'],])}}">Contamination</a></td>
                    <td><a href="{{route('MyleaContaminationData', ['id'=>$item['id'],])}}">Contamination Data</a></td>
                    <td><a href="{{route('MyleaHarvestForm', ['id'=>$item['id'],])}}">Harvest</a></td>
                    <td><a href="{{route('MyleaHarvestData', ['id'=>$item['id'],])}}">Harvest Data</a></td>
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
