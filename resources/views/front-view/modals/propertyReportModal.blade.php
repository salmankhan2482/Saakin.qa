<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="emailAgentModalLabel" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content email-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailAgentModalLongTitle">Report this Property</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('property-reports.store') }}">
          @csrf
          <input type="hidden" name="property_id" value=" {{ $property->id ?? '' }} ">
            <div class="form-group">
              <label class="mb-2" for="">Message</label>
              <textarea class="form-control" rows="6" name="message" required>Hi, I found your property with ref: On saakin.qa. Please contact me. Thank you.</textarea>
            </div>

            <div class="text-center mt-3">
              <button type="submit" class="text-center btn btn-primary">Send</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>