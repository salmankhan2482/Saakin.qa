@extends('admin-dashboard.layouts.master')
@section('content')


    {{-- <div class="container">
        <div class="row">
            <div class="col-md-5 offset-md-5">
                <div class="card">
                    <div class="card-heading">
                        Agency Name Search
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form control" autocomplete="off" placeholder="Agency Name Search... ">
                                <div id="agency_list">

                            </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}


    {{-- <script>
        $(document).ready(function(){
            $("#name").on('keyup',function(){
                var value = $(this).val();
                $.ajax({
                    url:"{{route('showsearch')}}",
                    type:"GET",
                    data:{'name',value},
                    success:function(data){
                        $("#agency_list").html(data);
                    }
                });

            });
               $(document).on('click','li',function(){
                var value = $(this).text();
                $("#name").val(value);
                $("#agency_list").html("");

               });
        });
    </script> --}}

@endsection