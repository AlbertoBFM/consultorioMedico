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
<h1>LISTA DE PACIENTES</h1>
<table id="emp">
    <thead>
        <tr>
            <th>{{__("Carnet de Identidad")}}</th>
            <th>{{__("Nombres")}}</th>
            <th>{{__("Apellidos")}}</th>
            <th>{{__("Fecha de Nacimiento")}}</th>
            <th>{{__("Sexo")}}</th>
            <th>{{__("Celular")}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pacientes as $paciente)
            <tr>
                <td>{{$paciente->ci}}</td>
                <td>{{$paciente->nombres}}</td>
                <td>{{$paciente->apellidos}}</td>
                <td>{{$paciente->f_nac}}</td>
                <td>{{$paciente->sexo}}</td>
                <td>{{$paciente->cel}}</td>
            </tr>
        @empty
            <tr class="border-solid border-2 border-gray-500 px-4 py-2" colspan="5">
                <td>
                    {{__("No hay nada que mostrar")}}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
