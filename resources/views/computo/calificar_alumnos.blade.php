@extends('layouts.panel')
@section('title', 'Inicio')
@include('partials.panel.recursos_app', ['datatables' => true, 'validacion' => true])
@section('content')
<div class="tw-pantalla">

    <x-panel.encabezado titulo="Calificar estudiantes" :migas="['Cómputo' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="version_actual">
                <thead>
                <tr>
                    <th>No. CUENTA</th>
                    <th>NOMBRE DE ALUMNO(A)</th>
                    <th>CARRERA</th>
                    <th>CARGA ACADEMICA</th>
                    <th>CALIFICAR ESTUDIANTE</th>

                </tr>
                </thead>
                <tbody>

                @foreach($alumnos as $consulta3)
                    <tr>
                        <th>{{$consulta3->cuenta}}</th>
                        <td>{{$consulta3->nombre}} {{$consulta3->apaterno}} {{$consulta3->amaterno}}</td>

                        <td>{{$consulta3->carreras}}</td>
                        <td>
                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.open('{{ url('/revicion_control_escolar/'.$consulta3->id ) }}')"><span class="fa fa-list-alt em5" aria-hidden="true"></span></a>
                        </td>


                        <td class="tw:text-center" >
                            <a class="tw:text-brand-500 tw:hover:underline" href="#" onclick="window.open('{{ url('/computo/calificacion_al/'.$consulta3->id ) }}')"><span class="fa fa-pencil" aria-hidden="true"></span>Calificar</a>
                        </td>

                    </tr>
                @endforeach



                </tbody>
            </table>
</div>
        </div>
    </div>




    <script type="text/javascript">


        $(document).ready(function(){
            $('#no_aceptados').DataTable();
            $('#aceptados').DataTable();
            $('#version_actual').DataTable();
            $('#version_antigua').DataTable();
            $("#aceptados").on('click','.activar_periodo_carga',function(){
                var idof=$(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');

            });
            $("#aceptados").on('click','.baja',function(){
                var idof=$(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');

            });
            $("#version_actual").on('click','.baja',function(){
                var idof=$(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');

            });
            $("#version_antigua").on('click','.baja',function(){
                var idof=$(this).attr('id');
                $('#id_carga_a').val(idof);
                $('#modal_baja').modal('show');

            });
            $("#guardar_baja").click(function(event){
                $("#form_baja").submit();
            });
            $("#form_baja").validate({
                rules: {

                    estado: "required",
                    obser: "required",
                },
            });
            $("#guardar_agregado").click(function(event){
                $("#form_agregar").submit();
            });
            $("#form_agregar").validate({
                rules: {

                    estado: "required",
                },
            });
            $("#version_actual").on('click','.activar_periodo_carga',function(){
                var idof=$(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');

            });
            $("#version_antigua").on('click','.activar_periodo_carga',function(){
                var idof=$(this).attr('id');
                $('#id_carga').val(idof);
                $('#modal_agregar').modal('show');

            });

            $(".desactivar_periodo_carga").click(function(event){
                var idof=$(this).attr('id');
                swal({
                    title: "¿Desactivar periodo de remplazar carga academica?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_modificar").attr("action","/desactivar/periodo_modificacion_carga/"+idof)
                            $("#form_modificar").submit();
                        }
                    });
            });



        });

    </script>


</div>
@endsection