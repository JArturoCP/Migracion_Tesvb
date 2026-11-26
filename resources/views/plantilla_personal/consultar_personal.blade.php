@extends('layouts.panel')
@section('title', 'Personal en Plantilla')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Consultar Personal por Departamento" :migas="['Plantilla de personal' => null]" />
    <form id="form_consultar" action="{{url("/departamentoplantilla/mostrar")}}" class="" role="form" method="POST">
        {{ csrf_field() }}
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                <div class="tw:mb-4">
                    <label for="deparamento">Departamentos del TESVB</label>
                    <select name="departamento" id="departamento" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                        <option>Selecciona departamento</option>
                        @foreach($jefaturas as $jefatura)
                            @if($jefatura->id_unidad_admin==$departamento)
                                <option value="{{$jefatura->id_unidad_admin}}" selected="selected">{{$jefatura->nom_departamento}}</option>
                            @else
                                <option value="{{$jefatura->id_unidad_admin}}" >{{$jefatura->nom_departamento}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                </div>

            </div>
        </div>
    </form>
              @if($ver == 1)
                  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                      <div class="tw:w-full tw:px-2">
                          <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="paginar_table">
                              <thead>
                              <tr>
                                  <th>Titulo</th>
                                  <th>Nombre</th>
                                  <th>Eliminar</th>

                              </tr>
                              </thead>
                              <tbody>
                              @foreach($plantillas as $plantilla)
                                  <tr>
                                      <td>{{$plantilla->titulo}}</td>
                                      <td>{{$plantilla->nombre}}</td>
                                      <td class="tw:text-center">
                                          <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $plantilla->id_personal }}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                                      </td>

                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
</div>
                      </div>
                  </div>
              @endif



    </main>
    <x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
                <div class="tw-modal-cuerpo tw:pt-14">
                    <form action="" method="POST" role="form" id="form_delete">
                        {{method_field('DELETE') }}
                        {{ csrf_field() }}
                        ¿Realmente deseas eliminar éste elemento?
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                    <input id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar"></input>
                </div>
                </form>
            </x-panel.modal>

    </main>
    <script type="text/javascript">
        $(document).ready( function() {
            $("#departamento").on('change',function(e){
                var id_cargo= $("#departamento").val();

                window.location.href='/departamento/plantillas/'+id_cargo ;
                //  }

            });
            $('#paginar_table').DataTable();
            $(".elimina").click(function(){
                var id=$(this).attr('id');
                $('#confirma_elimina').data('id',id);
                $('#modal_elimina').modal('show');
            });



            $("#confirma_elimina").click(function(event){
                var id_personal=($(this).data('id'));
                $("#form_delete").attr("action","/departamento/plantilla/"+id_personal)
                $("#form_delete").submit();
            });

        });
    </script>

</div>
@endsection
