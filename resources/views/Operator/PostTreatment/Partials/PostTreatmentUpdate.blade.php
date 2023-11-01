<div class="modal fade" id="updateModal{{$item['id']}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">{{$item['StartDate']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="PostTreatmentUpdateForm">
                <form id="PostTreatmentForm" action="{{route('PostTreatmentUpdate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$item['id']}}">
                    <div class="mb-3">
                      <label for="StartDate" class="form-label">{{__('common.StartDate')}}</label>
                      <input type="date" class="form-control" id="StartDate" name="StartDate" value="{{$item['StartDate']}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="Reject" class="form-label">{{__('common.Reject')}}</label>
                        <input type="number" class="form-control" id="Reject" name="Reject" value="{{$item['Reject']}}">
                    </div>
                    <div class="mb-3">
                        <label for="FinishGood" class="form-label">{{__('common.FinishedGoods')}}</label>
                        <input type="number" class="form-control" id="FinishGood" name="FinishGood" value="{{$item['FinishGood']}}">
                    </div>
                    <div class="mb-3">
                        <label for="Notes" class="form-label">{{__('common.Notes')}}</label>
                        <input type="text" class="form-control" id="Notes" name="Notes" value="{{$item['Notes']}}">
                    </div>
                 </form> 
            </div>
            {{$item['details']->sum('Total')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.Close')}}</button>
            <button onclick="submitForm({{$item['details']->sum('Total')}})" class="btn btn-primary" >{{__('common.Submit')}}</button> 

        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function submitForm(max){
        reject = document.querySelector('#Reject').value;
        finishGood = document.querySelector('#FinishGood').value;
        if((finishGood + reject) <= max) {
            document.forms['PostTreatmentForm'].submit();
        }
        else {
            alert("Value mismatch");
        }
    }
  </script>
