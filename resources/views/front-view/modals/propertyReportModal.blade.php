<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content email-content" style="padding: 15px; margin-top:15px !important;">
      <div class="modal-header" style="padding: 10px !important; border-bottom:0px;">
        <h5 class="modal-title" id="exampleModalLongTitle">
          Report this Property
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('property-reports.store') }}">
        @csrf
        <input type="hidden" name="property_id" value=" {{ $property->id ?? '' }} ">
        <div class="form-group">
          <label for="">Message</label>
          <textarea class="form-control" rows="6" name="message" required placeholder="Hi, I found your property with ref: On saakin.com. Please contact me. Thank you."></textarea>
        </div>

        <div class="row">
          <div class="col-md-12 modal-footer d-flex justify-content-center" style="margin-top:15px !important;">
            <button type="submit" class="text-center btn btn-primary">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
