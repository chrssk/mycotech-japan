<div class="modal fade" id="deleteConfirmationModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmationModalLabel">{{__("form.DeletePostTreatment")}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          @if(session()->get('lang_code')=='jp')
            {{__('form.PostTreatment') }}ID{{ $item['id'] }}{{__('form.CommonConfirmation')}} ?
            @elseif (session()->get('lang_code')=='id')
            {{__('form.DeletePostTreatmentConfirmation')}} {{ $item['id'] }} ?
          @else
            {{__('form.DeletePostTreatmentConfirmation')}} {{ $item['id'] }} ?
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.Close')}}</button>
          <a class="btn btn-danger" href="{{route('PostTreatmentDelete', ['id'=>$item['id'],])}}">{{__("common.Delete")}}</a>
        </div>
      </div>
    </div>
  </div>
</div>
