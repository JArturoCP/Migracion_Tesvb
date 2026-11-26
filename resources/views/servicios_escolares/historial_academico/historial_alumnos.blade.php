@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Historial académico '.$nombre_carrera.' Estudiantes'" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="tablas_alumnos">
                        <thead>
                        <tr>
                            <th class="tw:text-center" >Número de cuenta</th>
                            <th class="tw:text-center" >Nombre del estudiante</th>
                            <th class="tw:text-center" >Historial académico</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($alumnos as $alumno)
                            <tr>
                                <th class="tw:text-center" >{{$alumno->cuenta}}</th>
                                <td class="tw:text-center" >{{$alumno->nombre}} {{$alumno->apaterno}} {{$alumno->amaterno}}</td>
                                <td class="tw:text-center" >
                                    <a href="#" class="id_alumno" id="{{ $alumno->id_alumno }}" ><span class="fa fa-book em5" aria-hidden="true"></span> Ver historial</a>
                                </td>
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
</div>

                </div>
            </div>
        </div>
    </div>
    <x-panel.modal id="modal_historial" tamano="md" sin-relleno>
                <form action="" method="POST"  role="form" id="form_termino_calificar_actuales">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo tw:pt-14">


                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <input  type="hidden" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_alumno_r" name="id_alumno_r" />

                                <label for="calificada">¿Ya están registradas en el sistema las calificaciones del periodo actual? <b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>

                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="selecciona una Opcion" id="calificada" name="calificada" required>
                                    <option disabled selected>Selecciona una opción</option>
                                        <option value="1">Sí</option>
                                        <option value="2">No</option>
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="confirma_historial" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                    </div>
                </form>
            </x-panel.modal>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablas_alumnos').DataTable();
        });
        $("#tablas_alumnos").on('click','.id_alumno',function(){
            var id=$(this).attr('id');
            $('#id_alumno_r').val(id);

                $("#modal_historial").modal('show');

        });
        $("#confirma_historial").click(function(event) {
            var id_alumno = $("#id_alumno_r").val();
            var calificada = $("#calificada").val();



            if (calificada != null) {
                var link="/servicios_escolares/historial_academico/alumno/"+id_alumno+"/"+calificada+"/";

                window.open(link);


            }
            else{
                swal({
                    position:"top",
                    type: "error",
                    title: "Debes seleccionar una respuesta ",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });

</script>
</div>
@endsection