<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!--<link rel="stylesheet" href="{{ asset('css/app.css')}}" >-->
	<link rel="stylesheet" href="css/app.css" >
    <title>Clientes</title>
</head>
<body>
    <table class="table table-sm table-striped">
        <thead class="thead-light">
            <tr class="text-center"> 
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente-> id }}</td>
                    <td>{{ $cliente-> nombre }}</td>
                    <td>{{ $cliente-> email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>