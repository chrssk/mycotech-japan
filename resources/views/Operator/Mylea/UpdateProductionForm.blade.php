@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('monitoring.Home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{__('form.MyleaProductionForm')}}</li>
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
        
        <h2>{{__('form.MyleaProductionForm')}}</h2>
        <form action="{{route('MyleaProductionUpdate')}}" method="POST">
            @csrf
            <div class="mb-3">
              <input type="hidden" name="id" value="{{ $Data['id'] }}">  
              <label for="ProductionDate" class="form-label">{{__('common.ProductionDate')}}</label>
              <input type="date" class="form-control" id="ProductionDate" name="ProductionDate" value="{{ $Data['ProductionDate'] }}" required>
            </div>
            <div class="mb-3">
              <label for="TotalTray" class="form-label">{{__('common.TotalTray')}}</label>
              <input type="number" class="form-control" id="TotalTray" name="TotalTray" value="{{ $Data['TotalTray'] }}" required>
            </div>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>{{__('monitoring.BaglogCode')}}</th>
                    <th>{{__('common.Quantity')}}</th>
                    <th></th>
                </tr>
                @foreach ($DataBaglog as $index =>$dataBaglog2 )
                    <tr>
                        <td>
                            <select name="data[{{ $index }}][BaglogID]" class="form-select" id="BaglogCode">
                                @foreach ($BaglogData as $item)
                                    <option value="{{$item['id']}}"
                                        @if ($item['id'] == $dataBaglog2['BaglogID'])
                                            selected
                                        @endif
                                    >{{$item['BaglogCode']}} {{__('common.InStock')}} :{{$item['InStock']}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="data[{{ $index }}][Quantity]" class="form-control" value="{{ $dataBaglog2['Total'] }}"></td>
                        <td>
                            @if ($index > 0)
                                <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                            @else
                                <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">{{__('form.AddBaglog')}}</button>
                            @endif
                        </td>
                    </tr>        
                @endforeach

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
        $("#dynamicAddRemove").append('<tr><td><select name="data['+ i +'][BaglogID]" class="form-select" id="BaglogCode">@foreach ($BaglogData as $item)<option value="{{$item['id']}}">{{$item['BaglogCode']}} In Stock :{{$item['InStock']}}</option>@endforeach</select></td><td><input type="number" name="data['+ i +'][Quantity]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</div>
@endsection