<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('PropertiesForPurpose', ['rent', 'rent']) }}">
        First Phase Rent
    </a>
    <br><br>
    <a href="{{ route('PropertiesForPurpose', ['buy', 'sale']) }}">
        First Phase Sale
    </a>
</body>
</html>