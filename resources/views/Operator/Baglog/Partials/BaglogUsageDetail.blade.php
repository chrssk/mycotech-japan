<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('monitoring.Baglog')}} {{$item['BaglogCode']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>{{__('monitoring.MyleaCode')}}</th>
                    <th>{{__('common.Quantity')}}</th>
                </tr>
                @foreach ($item['Mylea'] as $data)
                    <tr>
                        <td><a href="{{route('MyleaProductionDetails', ['id'=>$data['id'],])}}">{{$data['MyleaCode']}}</a></td>
                        <td>{{$data['TotalTray']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.Close')}}</button>
        </div>
      </div>
    </div>
  </div>