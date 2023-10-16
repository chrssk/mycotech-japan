<div class="modal fade" id="UpdateModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">{{__("form.ContaminationData")}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('MyleaContaminationUpdate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$item['id']}}">
                    <div class="mb-3">
                      <label for="BaglogCode" class="form-label">{{__("monitoring.BaglogCode")}}</label>
                      <select name="BaglogID" class="form-select" id="BaglogCode" required>
                        @foreach ($UsedBaglog as $data)
                            <option value="{{$data['BaglogID']}}" {{ $data['BaglogID'] == $item['BaglogID'] ? 'selected' : '' }}>
                                {{ $data['BaglogCode'] }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="ContaminationDate" class="form-label">{{__("common.ContaminationDate")}}</label>
                      <input type="date" class="form-control" id="ContaminationDate" name="ContaminationDate" value="{{$item['ContaminationDate']}}" required>
                    </div>
                    <div class="mb-3">
                      <label for="Contamination" class="form-label">{{__("common.Contamination")}}</label>
                      <input type="number" class="form-control" id="Total" name="Total" value="{{$item['Total']}}" required>
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

