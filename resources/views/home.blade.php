@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Dashboard
            </header>

            <div class="w-full p-6">
                <p class="text-gray-700">
                    You are logged in!
                </p>
            </div>
            @if(isset(Auth::user()->jefemedico_id))
                <div class="w-full flex">
                    <div class="w-1/3">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="w-1/2">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            @endif

        </section>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //CONSULTAS POR DÍA DEL MES
        let dias = [];

        for (let i = 0; i < {{ $diasDelMes }}; i++) {// PARA AGREGAR LOS DÍAS DE LA SEMANA AL GRÁFICO
            dias.push(i+1);
        }

        let consultasPorDia = [];

        for (let i = 0; i < {{ $diasDelMes }}; i++) {// PARA AGREGAR La cantidad de consultas por día del mes
            consultasPorDia.push(0);
        }
        @forelse($consultasPorFecha as $consulta)
            consultasPorDia[{{ $consulta->fecha - 1 }}] = {{ $consulta->cantidad }};
        @empty
        @endforelse
        console.log(consultasPorDia);
        let data = {
            labels: dias,
            datasets: [{
                label: '{{ $nombreMes }}',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: consultasPorDia,
            }]
        };
        let config2 = {
            type: 'line',
            data,
            options: {}
        };
        let myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );
        //PASTEL TIPOS DE CONSULTAS
        nombresTipos = ['General','Reconsulta','Domicilio','Emergencia'];
        @forelse($consultas1 as $consulta)
            nombresTipos.push("{{ $consulta->nombre_especialidad }}");
        @empty
        @endforelse

        cantidadTipos = [];
        for (let i = 0; i < {{ $totalTipos }}; i++) {
            cantidadTipos.push(0);
        }

        @forelse($consultas2 as $consulta)
            cantidadTipos[{{ $consulta->id - 1 }}] = {{ $consulta->cantidad }};
        @empty
        @endforelse

        @forelse($consultas1 as $consulta)
            cantidadTipos[{{ $consulta->id - 1 }}] = {{ $consulta->cantidad }};
        @empty
        @endforelse
        data = {
            labels: nombresTipos
            ,
            datasets: [{
                label: 'Cantidad de Tipos de Consultas',
                data: cantidadTipos,
                backgroundColor: ['rgb(26, 82, 118 )','rgb(40, 116, 166)','rgb(52, 152, 219)',
                                  'rgb(26, 188, 156)','rgb(19, 141, 117)','rgb(40, 180, 99)',
                                  'rgb(146, 43, 33)','rgb(176, 58, 46)','rgb(118, 68, 138)',
                                  'rgb(212, 172, 13)','rgb(244, 208, 63)','rgb(214, 137, 16)',
                                  'rgb(245, 176, 65)','rgb(179, 182, 183)','rgb(133, 146, 158)'
                                 ],
                hoverOffset: 10
            }]
        };
        config = {
            type: 'pie',
            data,
            options: {}
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</main>
@endsection
