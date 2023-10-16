<div class="modal fade" id="UpdateModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">{{__("monitoring.HarvestData")}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('MyleaHarvestUpdate')}}" method="POST">
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
                      <label for="HarvestDate" class="form-label">{{__("common.HarvestDate")}}</label>
                      <input type="date" class="form-control" id="HarvestDate" name="HarvestDate" value="{{$item['HarvestDate']}}" required>
                    </div>
                    <div class="mb-3">
                      <label for="Harvest" class="form-label">{{__("common.Harvest")}}</label>
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

