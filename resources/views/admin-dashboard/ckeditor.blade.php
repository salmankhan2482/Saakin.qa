@extends('admin-dashboard.layouts.master')
@section('content')

<div class="form-row">
    <div class="form-group col-md-12">
        <label>Description</label>
        
            <textarea type="text" rows="5" id="description" name="description" class="form-control" placeholder="Blog Description"></textarea>
        
    </div>
</div>

@endsection


@section('scripts')
<script type="text/javascript" src="{{ asset('admin/vendor/ckfinder/ckfinder.js') }}"></script>
<script>
    var editor = CKEDITOR.replace( 'description' );
CKFinder.setupCKEditor( editor );
</script>
@endsection