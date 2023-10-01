@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Baglog Monitoring</li>
        </ol>
    </nav>
    <div class="row bg-white p-4 rounded">
        <div class="alertDiv">
            @if (session()->has('StatusUpdate'))
                <div class="alert alert-success" role="alert">
                    {{session('StatusUpdate')}}
                </div>
            @elseif(session()->has('StatusDeleted'))
                <div class="alert alert-danger" role="alert">
                    {{session('StatusDeleted')}}
                </div>
            @endif
        </div>

      
        <h2>Baglog Monitoring</h2>
        <div id="MonitoringTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>Baglog Code</th>
                    <th>Arrival Date</th>
                    <th>Quantity</th>
                    <th>Mylea Production Code</th>
                    <th>In Stock</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach($Data as $item)
                <tr class="text-center">
                    <td>{{$item['BaglogCode']}}</td>
                    <td>{{$item['ArrivalDate']}}</td>
                    <td>{{$item['Quantity']}}</td>
                    <td>
                        @foreach ($item['Mylea'] as $data )
                            {{ $data['MyleaCode'] }} <br>
                        @endforeach
                    </td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $item['id'] }}">
                            Update
                        </button>
                        @include('Operator.Baglog.Partials.UpdateBaglogPartials')
                    </td>
                    <td><a href="{{route('BaglogMonitoringDelete', ['id'=>$item['id'],])}}">Delete</a></td>
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
