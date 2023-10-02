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

        @include('Partials.LangOption')
      
        <h2>{{__("monitoring.BaglogTitle")}}</h2>
        <div id="MonitoringTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>{{__("monitoring.BaglogCode")}}</th>
                    <th>{{__("common.ArrivalDate")}}</th>
                    <th>{{__("common.Quantity")}}</th>
                    <th>{{__("monitoring.MyleaCode")}}</th>
                    <th>{{__("common.InStock")}}</th>
                    <th colspan="2">{{__("common.Action")}}</th>
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
                    <td>{{$item['InStock']}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $item['id'] }}">
                            {{__("monitoring.Update")}}
                        </button>
                        @include('Operator.Baglog.Partials.UpdateBaglogPartials')
                    </td>
                    <td><a href="{{route('BaglogMonitoringDelete', ['id'=>$item['id'],])}}">{{__("monitoring.Delete")}}</a></td>
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
