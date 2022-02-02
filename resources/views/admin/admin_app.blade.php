<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{getcong('site_name')}} {{trans('words.admin')}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <img href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/style.css') }}">
    <link href="{{asset('assets/css/image-uploader.css')}}" type="text/css" rel="stylesheet" />
    <script src="{{ URL::asset('admin_assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site_assets/ckfinder/ckfinder.js') }}"></script>

    @php
    $settings = App\Settings::where("id",1)->get()->first();
    @endphp
    
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key={{$settings->google_map_key}}&callback=initMap&region=qa" type="text/javascript"></script>
    <style>
        li.parsley-required{
            list-style-type: none;
            color: red;
        }
        .bootstrap-tagsinput{
            height: auto;
        }

    .card-box {
    padding: 20px;
    box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.06), 0 1px 0px 0 rgba(0, 0, 0, 0.02);
    border-radius: 5px;
    margin-bottom: 20px;
    background-color: #ffffff;
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
    </style>
</head>

<body class="sidebar-push  sticky-footer">

<!-- BEGIN TOPBAR -->

@include("admin.topbar")

<!-- END TOPBAR -->

<!-- BEGIN SIDEBAR -->

@include("admin.sidebar")

<!-- END SIDEBAR -->
<div class="container-fluid">

    @yield("content")

    <div class="footer">
        <a href="{{ URL::to('admin/dashboard') }}" class="brand">
            {{getcong('site_name')}}
        </a>
        <ul>

        </ul>
    </div>
</div>


<div class="overlay-disabled"></div>


<!-- Plugins -->
<script src="{{ URL::asset('assets/js/jquery.validate.js') }}"></script>
<script src="{{ URL::asset('admin_assets/js/plugins.min.js') }}"></script>


<!-- Loaded only in index.html for demographic vector map-->
<script src="{{ URL::asset('admin_assets/js/jvectormap.js') }}"></script>
<script src="{{ URL::asset('admin_assets/js/jvectormap.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/js/image-uploader.js')}}"></script>
<!-- App Scripts -->
<script src="{{ URL::asset('admin_assets/js/scripts.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>

<script>
    function makeid(length) 
    {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%()*&';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) 
        {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        $('#passwordgenerator').val(result);
    }
    total_chunks='';
    $(function(){
       
        // bind change event to select
        //Users
        $('#plan_select').on('change', function () {
            var url = $(this).val(); // get selected value

            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });

        //Transactions
        $('#gateway_select').on('change', function () {
            var url = $(this).val(); // get selected value

            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });

    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });

    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
    $("#importPropertiesform").validate({
        // Specify validation rules
        rules: {
            access_code: "required",
            group_code: "required",
            property_type: "required",

        },
        // Specify validation error messages
        messages: {
            access_code: "Please enter accescode",
            group_code:"Please enter group code",
            property_type:"Please Select Property Type",


        },
    });
    $(document).on('click',"#savegomaster",function (e) {
        e.preventDefault()
        if($("#importPropertiesform").valid()){
            $.ajax({
                type: "POST",
                url: "{{url('api/get-agencies')}}",
                dataType : 'JSON',
                beforeSend: function () {

                    $('#savegomaster').html('Processing');
                },
                data: $("#importPropertiesform").serialize(),
                success: function (data) {
                    total_chunks=data.total_chunks;
                    $('#total_chunks').val(total_chunks);
                    xml_file_id=data.xml_file_id;
                    ImportAgencies(xml_file_id,1)/*First run the first chunk*/
                   
                }
            });
        }
    })

    function ImportAgencies(xml_record_id,chunk_id){
        total_chunks=$('#total_chunks').val();
        $('.progress-bar').css('display','block');
        new Promise(function(resolve, reject) {
            $.ajax({
                type: "POST",
                url: "{{url('api/import-agencies/chunks')}}",
                dataType: 'JSON',
                data: {
                    xml_record_id:xml_record_id,
                    chunk_id:chunk_id,
                    total_chunks:total_chunks,
                },
                success: function (data) {
                    if(data.status=='finished'){
                        $('#message').html("<div class='alert alert-success'>" + data.message + "</div>");
                        $('#savegomaster').html("Import Properties");
                        document.getElementById("importPropertiesform").reset();
                        setTimeout(function () {
                            $('#importAgencies').modal('hide');
                        }, 5000);
                        resolve();
                    }
                    else{
                        progress_percentage=parseInt((parseInt(data.next_chunk_id)/parseInt(total_chunks))*100);
                        $('.progress-bar').css('width',progress_percentage+'%');
                        ImportAgencies(xml_record_id, data.next_chunk_id,total_chunks);
                    }
                }
            });

        }).then(data => {
        });


    }
</script>

@yield('scripts-custom')

</body>

</html>

