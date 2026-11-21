@extends('layouts.panel')
@section('title', 'Tipo de Personal')
@include('partials.panel.recursos_app', ['validacion' => true, 'datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="TIPOS DE PERSONALES" />

    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session('flash_notification.message') !!}
        </div>
    @endif

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-3xl" sin-relleno>
        <x-slot:acciones>
            <x-panel.boton data-toggle="modal" data-target="#modal_crea" tipo="primario" tamano="sm">
                <span class="fa fa-plus" aria-hidden="true"></span> Nuevo Tipo de Personal
            </x-panel.boton>
        </x-slot:acciones>

        <x-panel.tabla id="paginar_table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th class="tw:text-center">Editar</th>
                    <th class="tw:text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personales as $personal)
                <tr>
                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $personal->descripcion }}</td>
                    <td class="tw:text-center">
                        <a href="/generales/personales/{{ $personal->id_tipo_personal }}/edit" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Editar">
                            <span class="fa fa-cog em2" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="tw:text-center">
                        <a class="elimina tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50" id="{{ $personal->id_tipo_personal }}" title="Eliminar">
                            <span class="fa fa-trash em2" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

    @if(isset($edit))
        @section('modifica_personal')
        @include('generales.partialsg.partial_mo_personal')
        @show
    @endif
</main>

<!-- MODAL PARA ELIMINAR -->
<div id="modal_elimina" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="" method="POST" role="form" id="form_delete">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          ¿Realmente deseas eliminar éste elemento?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input id="confirma_elimina" type="button" class="btn btn-danger" value="Aceptar"></input>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal para crear-->
<form id="form_personal_crea" class="form" role="form" method="POST" action="/generales/personales">
<div class="modal fade" id="modal_crea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agregar Tipo de Personal</h4>
      </div>
      <div class="modal-body">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                      <label for="nombre_personal">Descripción</label>
                      <input type="text" class="form-control" id="caja-error" name="nombre_personal" placeholder="Nombre..." style="text-transform:uppercase">
                      @if($errors -> has ('nombre_personal'))
                          <span style="color:red;">{{ $errors -> first('nombre_personal') }}</span>
                         <style>
                          #caja-error
                          {
                            border:solid 1px red;
                          }
                          </style>
                      @endif
                    </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="guarda_personal" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
$(document).ready(function() {

    $(".elimina").click(function(){
        var id=$(this).attr('id');
        $('#confirma_elimina').data('id',id);
        $('#modal_elimina').modal('show');
    });

    $("#guarda_personal").click(function(event){
        $("#form_personal_crea").submit();
    });

    $("#form_personal_crea").validate({
        rules: {
            nombre_personal: {
                required: true,
            },
        },
    });

    $("#confirma_elimina").click(function(event){
        var id_personal=($(this).data('id'));
        $("#form_delete").attr("action","/generales/personales/"+id_personal);
        $("#form_delete").submit();
    });

});
</script>
@endsection
