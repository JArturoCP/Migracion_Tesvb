@extends('layouts.panel')
@section('title', 'Centro de Computo')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">


        <x-panel.encabezado titulo="Usuarios" :migas="['Centro de cómputo' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <p class="tw:w-full"><br></p>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="tabla">
                    <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Fecha de creacion</th>
                        <th>Fecha de modificación</th>
                        <th>modificar</th>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->email }}</td>
                            <td>{{  $usuario->created_at}}</td>
                            <td>{{$usuario->updated_at}}</td>
                            <td class="tw:text-center">
                                <button class="iduser tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $usuario->id }}">Modificar</button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>

    </main>
    <x-panel.modal id="modal_user" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">USUARIO</h4>
                </div>
                <form  action="{{url("/centro_computo/modificar_usuario_per/")}}" class="" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_user">
                        </div>
                    </div>

                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Agregar</button>
                </div>
                </form>
            </x-panel.modal>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
            $("#tabla").on('click','.iduser',function() {
                var id = $(this).attr('id');
                $.get("/centro_computo/ver_usuario_per/"+id,function (request) {
                    $("#contenedor_user").html(request);
                    $("#modal_user").modal('show');
                });
            });
        });
    </script>
</div>
@endsection