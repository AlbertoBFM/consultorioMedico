<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        *{
            font-family: Helvetica, sans-serif;
        }
        h1{
            font-size: 3rem;
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
<h1>REPORTES MENSUALES</h1>
@isset($medicosEspecialistas)
        @isset($medicosGenerales)
            @php
                $salariosG = 0;
                $salariosE = 0
            @endphp

            @forelse($medicosGenerales as $medico)
                @php $salariosG += $medico->salarios->Salario @endphp
            @empty
            @endforelse

            @forelse($medicosEspecialistas as $medico)
                @php $salariosE += $medico->salario / 2 @endphp
            @empty
            @endforelse
        @endisset
@endisset
<p>GASTOS EN SALARIOS: {{ $salariosG + $salariosE }} Bs.</p>
<p>GANANCIAS DE CONSULTAS: {{ $ganancias - $salariosE }} Bs.</p>
<p>UTILIDAD: {{ ($ganancias - $salariosE) - $salariosG }}</p>
    <!-- LISTA -->
<table class="table" id="emp">
    <thead class="table-dark">
        <tr>
            <th>{{ __("CI") }}</th>
            <th>{{ __("APELLIDOS") }}</th>
            <th>{{ __("NOMBRES") }}</th>
            <th>{{ __("FECHA DE  NACIMIENTO") }}</th>
            <th>{{ __("CELULAR") }}</th>
            <th>{{ __("ESPECIALIDAD") }}</th>
            <th>{{ __("SALARIO") }}</th>
            <th>{{ __("TURNO") }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($medicosGenerales as $medico)
            <tr>
                <td>{{ $medico->ci }}</td>
                <td>{{ $medico->apellidos }}</td>
                <td>{{ $medico->nombres }}</td>
                <td>{{ $medico->f_nac }}</td>
                <td>{{ $medico->cel }}</td>
                <td>
                @isset($medico->especialidades->nombre_especialidad)
                    {{ $medico->especialidades->nombre_especialidad }}
                @else
                    {{ __("Sin Especialidad") }}
                @endisset
                </td>
                <td>{{ $medico->salarios->Salario }}</td>
                <td>{{ $medico->turnos->turnos }}</td>
            </tr>
        @empty
            <tr>
                <td>
                    {{ __("NINGUNA CONSULTA DE MÉDICOS GENERALES") }}
                </td>
            </tr>
        @endforelse
        @forelse($medicosEspecialistas as $medico)
            <tr>
                <td>{{ $medico->ci }}</td>
                <td>{{ $medico->apellidos }}</td>
                <td>{{ $medico->nombres }}</td>
                <td>{{ $medico->f_nac }}</td>
                <td>{{ $medico->cel }}</td>
                <td>
                @isset($medico->especialidades->nombre_especialidad)
                    {{ $medico->especialidades->nombre_especialidad }}
                @else
                    {{ __("Sin Especialidad") }}
                @endisset
                </td>
                <td>{{ $medico->salario / 2 }}</td>
                <td>{{ $medico->turnos->turnos }}</td>
            </tr>
        @empty
            <tr>
                <td>
                    {{ __("NINGUNA CONSULTA DE MÉDICOS ESPECIALISTAS") }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
