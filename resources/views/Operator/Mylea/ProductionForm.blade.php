@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mylea Production Submit</li>
        </ol>
    </nav>
    <div class="row bg-white p-4 rounded">
        <div class="alertDiv">
            @if(session()->has('StatusSubmit'))
                <div class="alert alert-success" role="alert">
                    {{session('StatusSubmit')}}
                </div>
            @endif
        </div>
        <h2>Mylea Production Form</h2>
        <form action="{{route('MyleaProductionSubmit')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="ProductionDate" class="form-label">Production Date</label>
              <input type="date" class="form-control" id="ProductionDate" name="ProductionDate" required>
            </div>
            <div class="mb-3">
              <label for="TotalTray" class="form-label">Total Tray</label>
              <input type="number" class="form-control" id="TotalTray" name="TotalTray" required>
            </div>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Baglog Code</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <select name="data[0][BaglogID]" class="form-select" id="BaglogCode">
                            @foreach ($BaglogData as $item)
                                <option value="{{$item['id']}}">{{$item['BaglogCode']}} In Stock :{{$item['InStock']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="data[0][Quantity]" class="form-control" /></td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Baglog</button></td>
                </tr>
            </table> 
            <button type="submit" class="btn btn-primary">Submit</button> 
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
