@section('scripts')
@parent
<!-- Modal -->
<div class="modal fade" id="{{ $id ??  'coursePreview'}}" tabindex="-1" aria-labelledby="{{ $id ??  'coursePreview'}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="coursePreviewLabel">{{$title}}</h5>
          <button type="button" id="modal_clode_btn" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{$content}}
        </div>
        {{-- <div class="modal-footer">
          <button type="button" id="modal_clode_btn1" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection

