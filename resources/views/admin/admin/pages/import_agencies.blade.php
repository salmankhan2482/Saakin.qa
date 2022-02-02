<div class="progress">
    <div class="progress-bar" style="width:0%">0%</div>
</div>
<style>
    .progress{
        dislay :none;
        width: 30%;
        margin: 0 auto;
    }
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="importAgenciesLabel">Get Properties By Go-Master</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px ">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="message"></div>
            <form  method="post" id="importPropertiesform">
                @csrf
                <div class="form-group">
                    <label for="access_code">Access code</label>
                    <input class="form-control" name="access_code" type="text" value="{{isset($agency->access_code) ? ($agency->access_code) : ''}}">
                </div>
                <div class="form-group">
                    <label for="access_code">Group code</label>
                    <input class="form-control" name="group_code" type="text" value="{{isset($agency->access_code) ? ($agency->group_code) : ''}}">
                    <input class="form-control" name="user" type="hidden" value="{{auth()->id()}}">
                    <input class="form-control" name="agency_id" type="hidden" value="{{$agency->id}}">
                    <input class="form-control" id="total_chunks" type="hidden" value="">
                </div>
                <div class="form-group">
                    <label for="property_type">Property Type</label>
                    <select class="form-control" name="property_type">
                        <option value="">Select Type</option>
                        <option value="RentListings">Rent Listings</option>
                        <option value="SalesListings">Sales Listings</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="savegomaster">Import Properties</button>
                </div>
            </form>
        </div>

    </div>
</div>

