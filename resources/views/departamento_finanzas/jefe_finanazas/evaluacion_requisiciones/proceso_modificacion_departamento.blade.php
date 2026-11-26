@extends('layouts.panel')
@section('title', 'Revisión de requisiciones')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <x-panel.encabezado :titulo="'Revisión de requisiciones del anteproyecto de presupuesto '.$year" :migas="['Finanzas' => null]" />


    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">
        <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
            <li>
                <a href="{{ url('/presupuesto_anteproyecto/revicion_requisiciones_anteproyecto') }}" >Revisar requisiciones</a></li>
            <li class="active"><a href="#">En proceso de Modificación</a></li>
            <li>
                <a href="{{ url('/presupuesto_anteproyecto/autorizados_mod_jefe_depart') }}" >Requisiciones revisadas</a>
            </li>




        </ul>
        <p class="tw:w-full">
            <br>
        </p>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_autorizar_doc_final" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No. </th>
                            <th>JEFE(A)</th>
                            <th>DEPARTAMENTO O JEFATURA</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach ($registros_modificaciones as $registro)

                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $registro->titulo }} {{ $registro->nombre}}</td>
                                <td>{{ $registro->nom_departamento }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <x-panel.modal id="autorizar_doc_finales" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorización de documentación</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_doc_finales">
                    </div>
                </div>

            </x-panel.modal>
    <!-- Modal -->
    <x-panel.modal id="autorizar_doc_finales_mod" tamano="xl" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Autorización de documentación modificada</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_doc_finales_mod">
                    </div>
                </div>

            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_autorizar_doc_final').DataTable( );
            $("#carrera").on('change',function(e){
                var id_carrera= $("#carrera").val();
                window.location.href='/residencia/revision_doc_finales/'+id_carrera ;
            });
            $("#table_autorizar_doc_final").on('click','.autorizar_documentos',function(){
                var id_liberacion_documentos=$(this).attr('id');
                $.get("/residencia/alumno_liberacion_final/doc/"+id_liberacion_documentos,function (request) {
                    $("#contenedor_doc_finales").html(request);
                    $("#autorizar_doc_finales").modal('show');
                });

            });
            $("#table_autorizar_doc_final").on('click','.autorizar_modificacion_documentos',function(){
                var id_liberacion_documentos=$(this).attr('id');
                $.get("/residencia/alumno_liberacion_final_mod/doc/"+id_liberacion_documentos,function (request) {
                    $("#contenedor_doc_finales_mod").html(request);
                    $("#autorizar_doc_finales_mod").modal('show');
                });

            });
        });
    </script>
</div>
@endsection