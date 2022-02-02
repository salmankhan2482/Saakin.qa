<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
</head>
<body>
  <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>1st Adress</th>
        <th>2nd Adress (City)</th>
        <th>Latitude</th>
        <th>Longitude</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $data)
          <tr>
            <td>
              {{$data->id}}
            </td>
            <td>
              {{$data->property_name}}
            </td>
            <td>
              {{$data->address ?? 'Null'}}
            </td>
            <td>
              {{$data->city ?? 'Null'}}
            </td>
            <td>
              {{$data->map_latitude ?? 'Null'}}
            </td>
            <td>
              {{$data->map_longitude ?? 'Null'}}
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

  <script>
    $(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting": [],

        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
  </script>
</body>
</html>
