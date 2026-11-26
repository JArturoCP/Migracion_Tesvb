@extends('layouts.panel')
@section('title', 'Historiales de anteproyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Historiales de los anteproyectos de los presupuestos" :migas="['Finanzas' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Elige año del anteproyecto</label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_year" name="id_year" required>
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    @foreach($years as $year)
                                        <option value="{{$year->id_year}}" data-esta="{{$year->descripcion}}">{{$year->descripcion}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#id_year").on('change',function(e) {
                // TNotify.alert($("#grupos").val());
                var id_year=$("#id_year").val();

                window.location.href='/presupuesto_anteproyecto/inicio_historial_anteproyecto_year/'+id_year;



            });


        });

    </script>
</div>
@endsection