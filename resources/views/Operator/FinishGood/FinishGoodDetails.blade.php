@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white p-4 rounded">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('MyleaMonitoring')}}">Mylea Monitoring</a></li>
              <li class="breadcrumb-item"><a href="{{route('MyleaHarvestData', ['id' => $MyleaID])}}">Mylea Harvest Data</a></li>
              <li class="breadcrumb-item active" aria-current="page">Finish Good Data</li>
            </ol>
        </nav>
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
        
        <h2>Mylea Harvest {{ $HarvestID }} Finish Good Data</h2>
        <div id="ContaminationTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>No</th>
                    <th>Finish Good Code </th>
                    <th>Finish Good Date</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                @foreach ($Data as $item )
                <tr class="text-center">
                  <td> {{ $item['id']}} </td>
                  <td> {{ $item['FinishGoodCode']}} </td>
                  <td> {{ $item['FinishGoodDate']}} </td>
                  <td> {{ $item['Total']}} </td>
                   <td>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DeleteModal{{$item['id']}}">
                          Delete
                      </button>
                      @include('Operator.FinishGood.Partials.DeleteFinishGoodConfirm') 
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
