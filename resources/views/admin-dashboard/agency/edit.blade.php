@extends('admin-dashboard.layouts.master')
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	 @if(Session::has('flash_message'))
        <div class="alert alert-success">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
		    {{ Session::get('flash_message') }}
		</div>
	@endif
<div class="container-fluid">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    
                    <h4 class="card-title">Edit Agency</h4>
                    <a href="{{route('agencies.index')}}">
                        <button type="button" class="btn btn-rounded btn-info "><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['agencies.update', $data['agency']->id], 'method'=>'PUT','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'add_agency','role'=>'form','enctype' => 'multipart/form-data')) !!}

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" >Agency Name:*</label>
                                    <input type="text" name="name" id="name"  value="{{ $data['agency']->name }}" class="form-control" required >
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label >Phone: * </label>
                                    <input type="text" name="phone" id="phone" value="{{ $data['agency']->phone }}" class="form-control">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label >Whatsapp: * 
                                        <small style="font-size: 11px; color:#F00">
                                            (whatsapp number will be number only, no space, no plus sign)
                                        </small>
                                    </label>
                                    <input type="text" name="whatsapp" id="whatsapp" value="{{ $data['agency']->whatsapp }}" class="form-control">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label >Email * 
                                        <small style="font-size: 11px; color:#F00">
                                            (It will be agency login id)
                                        </small>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{$data['agency']->email}}" class="form-control">
                                    <input type="hidden" name="oldemail" value="{{ $data['agency']->email }}">

                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label >Password *</label>
                                    
                                    <span class="d-flex">
                                        <input type="text" name="password" id="passwordgenerator"   
                                        class="form-control" >
                                
                                        <button type="button" class="btn btn-success btn-xs ml-1 " onclick="makeid(10);">
                                            Generate Password
                                        </button>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label >Go Master Access Code</label>
                                    <input type="text" name="access_code" id="access_code"  value="{{ $data['agency']->access_code }}" 
                                        class="form-control">
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label >Group Code</label>
                                    <input type="text" name="group_code" id="group_code"  value="{{$data['agency']->group_code}}" 
                                        class="form-control">
                                </div>
                            
                                <div class="form-group col-md-12">
                                    <label>Head Office*</label>
                                    <textarea type="text" name="head_office" id="head_office" rows="4" class="form-control">{{$data['agency']->head_office}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>Detail</label>
                                    <textarea type="text" name="detail" id="detail" rows="7" class="form-control">{{$data['agency']->agency_detail}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-5">
                                    <label >Agency Photo</label>
                                    <input type="file" name="image" id="image" class="form-control" value="{{$data['agency']->name}}">
                                </div>
                                <div class="form-group col-md-1">
                                    <img src="{{asset('upload/agencies/'.$data['agency']->image)}}" alt="{{$data['agency']->name}}" width="80" />
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label >{{trans('words.meta_title')}}</label>
                                    <input type="text" value="{{ $data['agency']->meta_title }}" name="meta_title" id="meta_title" class="form-control">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label >{{trans('words.meta_description')}}</label>
                                    <textarea type="text" name="meta_description" id="meta_description" rows="4" class="form-control">{{ $data['agency']->meta_description }}</textarea>
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label >{{trans('words.meta_keyword')}}</label>
                                    <textarea type="text" name="meta_keyword" id="meta_keyword" rows="4" class="form-control">{{ $data['agency']->meta_keyword }}</textarea>
                                </div>  
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Status *
                                        <small style="font-size: 11px; color:#F00">
                                            (Unpublish option will disable all Respective Properties)
                                        </small>
                                    </label>
                                    <select type="text" name="status" class="form-control">
                                        <option value="1" {{ $data['agency']->status == 1 ? 'selected' : '' }}>Publish</option>
                                        <option value="0" {{ $data['agency']->status == 0 ? 'selected' : '' }}>Unpublish</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-rounded btn-success" id="add_new_Agency">
                                        {{ trans('words.save') }}
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('.agency_image').imageUploader({
                maxFiles: 1,
                imagesInputName: 'agency_image',
                extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
                mimes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],

            });
        })
        $('#add_agency').validate({
            rules :{
                "name" : {
                    required : true
                },  "phone" : {
                    required: true
                }
                ,  "head_office" : {
                    required : true
                }, "agency_image" : {
                        required : true
                    },
                "email" : {
                    required : true,
                    email: true
                }
            },
            messages :{
                "name" : {
                    required : 'Enter Agency Name'
                },"phone" : {
                    required : 'Enter Phone Number'
                },"email" : {
                    required : 'Enter Email'
                },"head_office" : {
                    required : 'Enter Address'
                },"agency_image" : {
                    required : 'upload Image'
                }
            }


        });

        $('#add_new_Agency').click(function () {
            if($('#add_agency').valid()){
                $('#add_agency').submit();
            }
        })

        function makeid(length) 
        {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%()*&';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            
            $('#passwordgenerator').val(result);
        }


    </script>
@endsection
