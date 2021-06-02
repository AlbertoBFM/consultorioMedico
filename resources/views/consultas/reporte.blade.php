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
<h1>LISTA DE CONSULTAS</h1>
<table id="emp">
    <thead>
        <tr>
            <th>{{ __("MOTIVO DE LA CONSULTA") }}</th>
            <th>{{ __("MEDICO") }}</th>
            <th>{{ __("PACIENTE") }}</th>
            <th>{{ __("TIPO DE CONSULTA") }}</th>
            <th>{{ __("COSTO") }}</th>
            <th>{{ __("ATENDIDO") }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($consultas as $consulta)
            <tr>
                <td>{{ $consulta->motivo_consulta }}</td>
                <td>{{ $consulta->medico->ci }}</td>
                <td>{{ $consulta->paciente->ci }}</td>
                <td>
                    @isset($consulta->tipos->especialidades->nombre_especialidad)
                        {{ $consulta->tipos->especialidades->nombre_especialidad }}
                    @else
                        @if($consulta->tipo_id == 1)
                            {{ __("General") }}
                        @elseif($consulta->tipo_id == 2)
                            {{ __("Reconsulta") }}
                        @elseif($consulta->tipo_id == 3)
                            {{ __("Domicilio") }}
                        @elseif($consulta->tipo_id == 4)
                            {{ __("Emergencia") }}
                        @endif
                    @endisset
                </td>
                <td>{{ $consulta->tipos->precio_consulta }}</td>
                <td>{{ $consulta->atentido }}</td>
            </tr>
        @empty
            <tr>
                <td class="border-solid border-2 border-gray-500 px-4 py-2" colspan="5">
                    {{ __("LISTA DE MÉDICOS VACIA") }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
