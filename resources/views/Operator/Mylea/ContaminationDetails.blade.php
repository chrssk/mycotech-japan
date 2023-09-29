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

        <h2>Mylea {{ $Details->MyleaCode }} Contamination Data</h2>
        <div id="ContaminationTable" class="bg-white">
            <table class="table table-white" >
                <tr class="text-center">
                    <th>No</th>
                    <th>Baglog Code</th>
                    <th>Contamination Date</th>
                    <th>Total Contamination</th>
                    <th>Notes</th>
                    <th colspan="4">Action</th>
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
                            Delete
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
