<div class="modal fade" id="DeleteModal{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Delete Mylea Contamination </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete Mylea Contamination with ID {{ $item['id'] }} ?
        </div>
        <div class="modal-footer">
          <a href="{{route('MyleaContaminationDelete', ['id'=>$item['id'], 'details'=>$Details['id']])}}" class="btn btn-danger float-auto">Delete</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>