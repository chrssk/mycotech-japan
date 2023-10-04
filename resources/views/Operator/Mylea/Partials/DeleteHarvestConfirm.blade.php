<div class="modal fade" id="DeleteModal{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">  {{__('form.DeleteMyleaHarvest')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{__('form.DeleteMyleaHarvestConfirmation')}}{{ $item['id'] }} ?
        </div>
        <div class="modal-footer">
          <a href="{{route('MyleaHarvestDelete', ['id'=>$item['id'], 'details'=>$Details['id']])}}" class="btn btn-danger float-auto">{{__('common.Delete')}}</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.Close')}}</button>
        </div> 
      </div>
    </div>
  </div>