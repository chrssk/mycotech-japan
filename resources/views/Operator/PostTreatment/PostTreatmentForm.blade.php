@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{__('form.PostTreatmentForm')}}</li>
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

        <h2>{{__('form.PostTreatmentForm')}}</h2>
        <form action="{{route('PostTreatmentSubmit')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="StartDate" class="form-label">{{__('common.StartDate')}}</label>
              <input type="date" class="form-control" id="StartDate" name="StartDate" required>
            </div>
           <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>{{__('monitoring.MyleaCode')}}</th>
                    <th>{{__('common.Quantity')}}</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <select name="data[0][HarvestID]" class="form-select" id="HarvestID">
                            @if(count($Data) > 0)
                            @foreach ($Data as $item)
                                <option value="{{$item['id']}}">{{$item['MyleaCode']}} : {{$item['HarvestDate']}} ({{__('common.Available')}} : {{ $item['TotalHarvest'] }})  </option>
                            @endforeach
                            @endif
                        </select>
                    </td>
                    <td><input type="number" name="data[0][Total]" @if(count($Data) > 0)max="{{$item['TotalHarvest']}}"@endif  min="1" class="form-control" /></td>

                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary" @if(count($Data) == 0) disabled @endif>{{__('form.AddBaglog')}}</button></td>
                </tr>
            </table> 
            <button type="submit" class="btn btn-primary">{{__('common.Submit')}}</button> 
        </form>          
    </div>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
        $("#dynamicAddRemove").append('<tr><td>@if(count($Data) > 0)<select name="data['+ i +'][HarvestID]" class="form-select" id="">@foreach ($Data as $item)<option value="{{$item['id']}}">{{$item['MyleaCode']}} : {{$item['HarvestDate']}}  ({{__('common.Available')}} : {{ $item['TotalHarvest'] }}) </option>@endforeach</select>@endif</td><td><input type="number" @if(count($Data) > 0)max="{{$item['TotalHarvest']}}"@endif  min="1" name="data['+ i +'][Total]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">{{__('common.Delete')}}</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script> 
</div>
@endsection
