@extends('layouts.app')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{__('form.BaglogInputForm')}}</li>
        </ol>
    </nav>
    <div class="row bg-white p-4 rounded">
        <div class="alertDiv">
            @if (session()->has('StatusSubmit') && (session('StatusSubmit') == 'Data submitted'))
                <div class="alert alert-success" role="alert">
                    {{session('StatusSubmit')}}
                </div>
            @elseif(session()->has('StatusSubmit'))
                <div class="alert alert-danger" role="alert">
                    {{session('StatusSubmit')}}
                </div>
            @endif
        </div>
        <h2>{{__('form.BaglogInputForm')}}</h2>
        <form action="{{route('BaglogSubmit')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="ArrivalDate" class="form-label">{{__('common.ArrivalDate')}}</label>
              <input type="date" class="form-control" id="ArrivalDate" name="ArrivalDate" required>
            </div>
            <div class="mb-3">
              <label for="Quantity" class="form-label">{{__('common.Quantity')}}</label>
              <input type="number" class="form-control" id="Quantity" name="Quantity" required>
            </div>
            <div class="mb-3">
                <label for="Notes" class="form-label">{{__('common.Notes')}}</label>
                <input type="text" class="form-control" id="Notes" name="Notes">
            </div>
            <button type="submit" class="btn btn-primary">{{__('common.Submit')}}</button>
        </form>          
    </div>
</div>
@endsection
