@php
   $edit_name = \App\SaveSearch::where('id',$search->id)->value('name');
@endphp

<div class="modal fade" id="editSaveSearchModalLabel" tabindex="-1" aria-labelledby="editSaveSearchModalLabel" 
  aria-hidden="true" role="dialog">

  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content email-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSaveSearchModalLabel">Edit Search Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control" id="search_name" name="search_name" aria-describedby="name" 
                    placeholder="* Search name" value="{{ $edit_name }}" required>
              </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 d-flex justify-content-end">
              <div class="form-group">
                  <button type="submit" id="save-search" class="btn btn-info">Save</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>