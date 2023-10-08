@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{__('monitoring.BaglogTitle')}}</li>
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
      
        <h2>{{__("monitoring.BaglogTitle")}}</h2>
        <div id="MonitoringTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>{{__("monitoring.BaglogCode")}}</th>
                    <th>{{__("common.ArrivalDate")}}</th>
                    <th>{{__("common.Quantity")}}</th>
                    <th>{{__("monitoring.MyleaCode")}}</th>
                    <th>{{__("common.UnderIncubation")}}</th>
                    <th>{{__("common.Notes")}}</th>
                    <th colspan="2">{{__("common.Action")}}</th>
                </tr>
                @foreach($Data as $item)
                <tr class="text-center">
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            {{$item['BaglogCode']}}
                        </button>
                        @include('Operator.Baglog.Partials.BaglogUsageDetail')
                    </td>
                    <td>{{$item['ArrivalDate']}}</td>
                    <td>{{$item['Quantity']}}</td>
                    <td>
                        @foreach ($item['Mylea'] as $data )
                            {{ $data['MyleaCode'] }} <br>
                        @endforeach
                    </td>
                    <td>{{$item['InStock']}}</td>
                    <td>{{$item['Notes']}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $item['id'] }}">
                            {{__("common.Update")}}
                        </button>
                        @include('Operator.Baglog.Partials.UpdateBaglogPartials')
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">
                            {{__("common.Delete")}}
                        </button>
                        @include('Operator.Baglog.Partials.DeleteBaglogConfirmation')
                    </td>
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
