@if(Session::has('error_flash_message'))
<div class="alert alert-danger">
    {{ Session::get('error_flash_message') }}
</div>
@endif
@if(Session::has('flash_message_subscribe'))
<div class="alert alert-success">
    {{ Session::get('flash_message_subscribe') }}
</div>
@endif
{!! Form::open(array('url' => array('subscribe'),'name'=>'search_form','id'=>'newsletter-form','role'=>'form')) !!}
<meta name="_token" content="{!! csrf_token() !!}" />

<div class="input-group">
    <input type="text" class="form-control" name="email" id="email_id" placeholder="Your Email address.." required>
    <button class="btn btn-primary" type="submit">{{trans('words.submit')}}</button>
</div>
{!! Form::close() !!}