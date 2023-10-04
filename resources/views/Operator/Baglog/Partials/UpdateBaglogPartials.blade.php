<div class="modal fade" id="updateModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">{{__("monitoring.Baglog")}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('BaglogMonitoringUpdate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$item['id']}}">
                    <div class="mb-3">
                      <label for="ArrivalDate" class="form-label">{{__("common.ArrivalDate")}}</label>
                      <input type="date" class="form-control" id="ArrivalDate" name="ArrivalDate" value="{{$item['ArrivalDate']}}" required>
                    </div>
                    <div class="mb-3">
                      <label for="Quantity" class="form-label">{{__("common.Quantity")}}</label>
                      <input type="number" class="form-control" id="Quantity" name="Quantity" value="{{$item['Quantity']}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="Notes" class="form-label">{{__("common.Notes")}}</label>
                        <input type="text" class="form-control" id="Notes" value="{{$item['Notes']}}" name="Notes">
                    </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__("common.Close")}}</button>
                    <button type="submit" class="btn btn-primary">{{__("common.Submit")}}</button>
                </form>  
            </div>
        </div>
    </div>
</div>

