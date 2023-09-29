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

        <h2>Mylea {{ $Details->MyleaCode }} Harvest Data</h2>
        <div id="ContaminationTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>No</th>
                    <th>Baglog Code</th>
                    <th>Harvest Date</th>
                    <th>Harvest</th>
                    <th>Total Finish Good</th>
                    <th>Notes</th>
                    <th colspan="4">Action</th>
                </tr>
                @foreach($Data as $item)
                <tr class="text-center">
                    <td> {{ $item['id']}} </td>
                    <td> {{ $item['BaglogCode']}} </td>
                    <td> {{ $item['HarvestDate']}} </td>
                    <td> {{ $item['Total']}} </td>
                    <td> {{ $item['TotalFinishGood']}} </td>
                    <td> {{ $item['Notes']}} </td>
                    {{-- <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                            Update
                        </button>
                        @include('Operator.Baglog.Partials.UpdateBaglogPartials')
                    </td> --}}
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DeleteModal{{$item['id']}}">
                            Delete
                        </button>
                        @include('Operator.Mylea.Partials.DeleteHarvestConfirm') 
                    </td>
                    <td><a href="{{route('FinishGoodForm', ['id'=>$item['id'],])}}">Finish Good</a></td>
                    <td><a href="{{route('FinishGoodData', ['id'=>$item['id'],])}}">Finish Good Data</a></td>
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
