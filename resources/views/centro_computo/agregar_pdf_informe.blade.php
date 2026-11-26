@extends('layouts.panel')
@section('title', 'agregar informe')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<x-panel.encabezado titulo="Informes de titulación" :migas="['Centro de cómputo' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="version_actual">
            <thead>
            <tr>
                <th>No. CUENTA</th>
                <th>NOMBRE DE ALUMNO(A)</th>
                <th>CARRERA</th>
                <th>VER PDF</th>
                <th>MODIFICAR PDF</th>

            </tr>
            </thead>
            <tbody>

            @foreach($titulados as $titulado)
            <tr>
                <th>{{$titulado->no_cuenta}}</th>
                <td>{{$titulado->apaterno}} {{$titulado->amaterno}} {{$titulado->nombre_al}}</td>

                <td>{{$titulado->carrera}}</td>
                <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('/titulacion/'.$titulado->pdf_reporte_titulacion)}}')">Ver </button></td>
                <td><button type="button" class="editar_reporte tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id="{{ $titulado->id_alumno }}">Modificar</button></td>

            </tr>
            @endforeach



            </tbody>
        </table>
</div>
    </div>
</div>

{{--Modal de modificar--}}
<x-panel.modal id="modal_modificar_reporte" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                
                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Editar PDF</h4>
            </div>
            <form id="form_modificacion_reporte" class="" action="{{url("/titulacion/modificar_datos_estudiante_computo/")}}" role="form" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="tw-modal-cuerpo">

                    <div id="contenedor_modificar_reporte">
                    </div>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    <button  id="guardar_modificacion_reporte" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  >Guardar modificación</button>
                </div>
            </form>
        </x-panel.modal>


<script type="text/javascript">


    $(document).ready(function(){
        $('#version_actual').DataTable();

        $("#version_actual").on('click','.editar_reporte',function(){
            var id_alumno = $(this).data('id');
            $.get("/titulacion/editar_reporte_titulacion_centro/"+id_alumno,function (request) {
                $("#contenedor_modificar_reporte").html(request);
                $("#modal_modificar_reporte").modal('show');
            });

        });
        $("#guardar_modificacion_reporte").click(function(event) {


                        var file = $("#file").val();
                        if(file == ''){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona el PDF del documento",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }else{

                            $("#form_modificacion_reporte").submit();
                            $("#guardar_modificacion_reporte").attr("disabled", true);
                            swal({
                                type: "success",
                                title: "Modificación exitosa",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }

        });



    });

</script>


</div>
@endsection
