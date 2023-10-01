@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('MyleaMonitoring')}}">Mylea Monitoring</a></li>
          <li class="breadcrumb-item active" aria-current="page">Contamination Form</li>
        </ol>
    </nav>
    <div class="row bg-white p-4 rounded">
        {{-- <div class="alertDiv">
            @if(session()->has('Success'))
                <div class="alert alert-success" role="alert">
                    {{session('Success')}}
                </div>
            @elseif(session()->has('Error'))
            <div class="alert alert-danger" role="alert">
                {{session('Error')}}
            </div>
            @endif
        </div> --}}

        <h2>Mylea {{ $MyleaDetails->MyleaCode }} Contamination Form</h2>
        <form action="{{route('MyleaContaminationSubmit')}}" method="POST">
            @csrf
            <div class="mb-3">
              <input type="hidden" class="form-control" id="MyleaID" name="MyleaID" value="{{ $MyleaDetails->id }}">
            </div>
            <div class="mb-3">
              <label for="ContaminationDate" class="form-label">Contamination Date</label>
              <input type="date" class="form-control" id="ContaminationDate" name="ContaminationDate" required>
            </div>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Baglog Code</th>
                    <th>Quantity</th>
                    <th>Notes</th>
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
                    <td><input type="text" name="data[0][Notes]" class="form-control" /></td>
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
        $("#dynamicAddRemove").append('<tr><td><select name="data['+ i +'][BaglogID]" class="form-select" id="BaglogCode">@foreach ($BaglogData as $item)<option value="{{$item['id']}}">{{$item['BaglogCode']}} In Stock :{{$item['InStock']}}</option>@endforeach</select></td><td><input type="number" name="data['+ i +'][Quantity]" class="form-control" /></td><td><input type="text" name="data['+ i +'][Notes]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</div>
@endsection
