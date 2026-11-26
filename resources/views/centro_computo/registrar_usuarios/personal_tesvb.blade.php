@extends('layouts.panel')
@section('title', 'Centro de Computo')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Correos electronicos del personal TESVB" :migas="['Centro de cómputo' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <p class="tw:w-full"><br></p>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <button class="eliminar_usuarios tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Eliminacion de usuarios sin datos</button>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <p class="tw:w-full"><br></p>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes"  id="tabla">
                    <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Estado de registro terminado</th>
                        <th>Eliminar</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($usuario_no_reg as $usuario)
                        <tr>
                            <td>{{ $usuario['email'] }}</td>
                            @if($usuario['info_ok'] == 0)
                                <td>Sin datos</td>
                            @else
                                <td>Con datos</td>
                            @endif

                            <td><button class="iduser tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $usuario['id'] }}">Eliminar</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes"  id="tabla_reg">
                    <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Estado de registro terminado</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($usuario_reg as $usuar)
                        <tr>
                            <td>{{ $usuar['email'] }}</td>
                            @if($usuar['info_ok'] == 0)
                                <td>Sin datos</td>
                            @else
                                <td>Con datos</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <p class="tw:w-full"><br></p>
        </div>
    </main>
    <x-panel.modal id="modal_user" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">ELIMINAR USUARIO</h4>
                </div>
                <form  action="{{url("/centro_computo/eliminacion_user_sin_reg")}}" class="" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_user">
                        </div>
                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Eliminar</button>
                    </div>
                </form>
            </x-panel.modal>

    <x-panel.modal id="modal_eliminar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">ELIMINAR USUARIOS</h4>
                </div>
                <form  action="{{url("/centro_computo/eliminacion_user_per_sin_reg")}}" class="" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo">
                        <p>¿Seguro que quieres eliminar los correos electronicos sin datos?</p>
                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </form>
            </x-panel.modal>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
            $('#tabla_reg').DataTable();
            $("#tabla").on('click','.iduser',function() {
                var id = $(this).attr('id');
                $.get("/centro_computo/eliminar_user_sin_reg/"+id,function (request) {
                    $("#contenedor_user").html(request);
                    $("#modal_user").modal('show');
                });
            });
            $(".eliminar_usuarios").click(function (){
                $("#modal_eliminar").modal('show');
            });
        });
    </script>

</div>
@endsection