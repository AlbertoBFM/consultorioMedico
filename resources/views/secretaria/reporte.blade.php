<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: Helvetica, sans-serif;
        }
        h1{
            font-size: 2rem;
            width: 100%;
            text-align: center;
        }
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            text-align: center;
            width: 100%;
        }
        #emp td, #emp th{
            border:1px solid #ddd;
            padding: 8px;
        }
        #emp th{
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #233876;
            color:#fff;
        }
    </style>
</head>
<body>
<h1>LISTA DE SECRETARIAS</h1>
    <!-- LISTAS -->
<table id="emp">
    <thead>
        <tr>
            <th>{{ __("CI") }}</th>
            <th>{{ __("APELLIDOS") }}</th>
            <th>{{ __("NOMBRES") }}</th>
            <th>{{ __("FECHA DE  NACIMIENTO") }}</th>
            <th>{{ __("CELULAR") }}</th>
            <th>{{ __("SALARIO") }}</th>
            <th>{{ __("TURNO") }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($secretarias as $secretaria)
            <tr>
                <td>{{ $secretaria->ci }}</td>
                <td>{{ $secretaria->apellidos }}</td>
                <td>{{ $secretaria->nombres }}</td>
                <td>{{ $secretaria->f_nac }}</td>
                <td>{{ $secretaria->cel }}</td>
                <td>{{ $secretaria->salarios->Salario }}</td>
                <td>{{ $secretaria->turnos }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    {{ __("LISTA DE MÉDICOS VACIA") }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
