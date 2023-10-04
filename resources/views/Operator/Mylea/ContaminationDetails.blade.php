@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('MyleaMonitoring')}}">{{__('monitoring.MyleaTitle')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{__('form.ContaminationData')}}</li>
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

        <h2>{{__('monitoring.Mylea')}} {{ $Details->MyleaCode }} {{__('form.ContaminationData')}}</h2>
        <div id="ContaminationTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>{{__('common.Number')}}</th>
                    <th>{{__('monitoring.BaglogCode')}}</th>
                    <th>{{__('common.ContaminationDate')}}</th>
                    <th>{{__('common.TotalContamination')}}</th>
                    <th>{{__('common.Notes')}}</th>
                    <th colspan="4">{{__('common.Action')}}</th>
                </tr>
                @foreach($Data as $item)
                <tr class="text-center">
                    <td> {{ $item['id']}} </td>
                    <td> {{ $item['BaglogCode']}} </td>
                    <td> {{ $item['ContaminationDate']}} </td>
                    <td> {{ $item['Total']}} </td>
                    <td> {{ $item['Notes']}} </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DeleteModal{{$item['id']}}">
                           {{__('common.Delete')}}
                        </button>
                        @include('Operator.Mylea.Partials.DeleteContaminationConfirm') 
                    </td>
                </tr>
               @endforeach
            </table>
            <div class="d-flex justify-content-center">
                {{-- {!! $Data->links() !!} --}}
            </div>
        </div>        
    </div>
</div>
@endsection
