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
        <form action="{{route('MyleaProductionSubmit')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="ProductionDate" class="form-label">{{__('common.ProductionDate')}}</label>
              <input type="date" class="form-control" id="ProductionDate" name="ProductionDate" required>
            </div>
            <div class="mb-3">
              <label for="TotalTray" class="form-label">{{__('common.TotalProduction')}}</label>
              <input type="number" class="form-control" id="TotalTray" name="TotalTray" required>
            </div>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>{{__('monitoring.BaglogCode')}}</th>
                    <th>{{__('common.Quantity')}}</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <select name="data[0][BaglogID]" class="form-select" id="BaglogCode0" onchange="SetMax(0)">
                            @foreach ($BaglogData as $item)
                                @if($item['InStock'] != 0)
                                    <option value="{{$item['id']}}">{{$item['BaglogCode']}} {{__('common.InStock')}} :{{$item['InStock']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="data[0][Quantity]"  id="Quantity0" min="1" class="form-control" /></td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">{{__('form.AddMylea')}}</button></td>
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
        var dat = <?php echo json_encode($BaglogData)?>;
        $( document ).ready(function() {
            SetMax(0);
        });
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><select name="data['+ i +'][BaglogID]" class="form-select" id="BaglogCode' + i  + '" onchange="SetMax('+ i +')">@foreach ($BaglogData as $item)<option value="{{$item['id']}}">{{$item['BaglogCode']}} {{__('common.InStock')}} :{{$item['InStock']}}</option>@endforeach</select></td><td><input type="number"  min="1" name="data['+ i +'][Quantity]" id="Quantity'+ i +'" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">{{__('common.Delete')}}</button></td></tr>');
            SetMax(i);
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });

        

        function SetMax(i) {
            name = "BaglogCode" + i;
            var e = document.getElementById("BaglogCode" + i);
            var value = e.options[e.selectedIndex].value;

            let obj = dat.find(o => o.id === parseInt(value));
            var max = obj.InStock;
            inputId = "#Quantity" + i;

            $(inputId).attr({
                "max" : max,
                "min" : 1
            });
        }
    </script>
</div>
@endsection
