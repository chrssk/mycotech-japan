@extends('layouts.app')

@section('content')
<div class="container">
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
                    <th>Arrival Date</th>
                    <th>Quantity</th>
                    <th>Mylea Production</th>
                    <th>In Stock</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach($Data as $item)
                <tr class="text-center">
                    <th>{{$item['ArrivalDate']}}</th>
                    <th>{{$item['Quantity']}}</th>
                    <th></th>
                    <th></th>
                    <th>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                            Update
                        </button>
                        @include('Operator.Baglog.Partials.UpdateBaglogPartials')
                    </th>
                    <th><a href="{{route('BaglogMonitoringDelete', ['id'=>$item['id'],])}}">Delete</a></th>
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
