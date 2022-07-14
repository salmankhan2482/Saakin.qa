<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IP Location</title>
</head>
<body>
    <div class="container">
        {!! Form::open(array('route' => 'view_ip_location', 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
        <input type="text" id="ip_location" name="ip_location" placeholder="Enter IP">
        <button type="submit">Submit</button>
        {!! Form::close() !!}
    </div>
</body>
</html>