@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('MyleaMonitoring')}}">{{__('monitoring.MyleaTitle')}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('MyleaHarvestData', ['id' => $MyleaID])}}">{{__('monitoring.HarvestData')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{__('form.FinishGoodForm')}}</li>
      </ol>
  </nav>
    <div class="row bg-white p-4 rounded">

        <h2>{{__('form.FinishGoodForm')}}</h2>
        <form action="{{route('FinishGoodSubmit')}}" method="POST">
            @csrf
            <div class="mb-3">
              <input type="hidden" class="form-control" id="HarvestID" name="HarvestID" value="{{ $HarvestID }}">
            </div>
            <div class="mb-3">
              <label for="FinishGoodDate" class="form-label">{{__('common.FinishGoodDate')}}</label>
              <input type="date" class="form-control" id="FinishGoodDate" name="FinishGoodDate" required>
            </div>
            <div class="mb-3">
              <label for="Total" class="form-label">{{__('common.Total')}}</label>
              <input type="number" class="form-control" id="Total" name="Total" required>
            </div>
            <button type="submit" class="btn btn-primary">{{__('common.Submit')}}</button> 
        </form>          
    </div>
</div>
@endsection
