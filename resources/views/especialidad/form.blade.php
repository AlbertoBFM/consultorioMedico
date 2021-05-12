<div class="w-full bg-gray-200 p-4 my-5">
    <div class="text-center">
        <h1 class="mb-5 text-4xl">{{ $title }}</h1>
    </div>
</div>
<form
    class="w-full max-w-sm"
    method="POST"
    action="{{ $route }}"
>
    @csrf
    @isset($update)
        @method("PUT")
    @else
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                    {{ __("Precio de Consulta") }}
                </label>
            </div>
            <div class="md:w-2/3">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    id="precio_consulta"
                    name="precio_consulta"
                    type="number"
                    placeholder="40"
                >
                @error("precio_consulta")
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
    @endisset
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                {{ __("Nombre Especialidad") }}
            </label>
        </div>
        <div class="md:w-2/3">
            <input
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                id="nombre_especialidad"
                name="nombre_especialidad"
                type="text"
                value="{{ old('nombre_especialidad') ?? $especialidad->nombre_especialidad }}"
                placeholder="Juancito Rodrigo"
            >
            @error("nombre_especialidad")
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                {{ $textButton }}
            </button>
        </div>
    </div>
</form>
