@extends('layouts.panel')
@section('title', 'Expediente')
@include('tutorias.partials.recursos_panel')
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Expediente', 'activa' => '/tutorias/inicioalu'])

    {{-- #principal: aquí monta Vue (datos: 1 = expediente lleno, 2 = por llenar). x-ignore: Alpine no lo procesa. --}}
    @if($alumno ==null)
        <div class="tw:mx-auto tw:max-w-2xl" id="principal" x-ignore>
            <x-panel.tarjeta :titulo="Session::get('nombre')" subtitulo="Expediente de Tutorías">
                <x-slot:acciones>
                    <x-panel.boton variante="peligro" tamano="sm" :href="url('/tutorias/pdf/all')" target="_blank" v-if="datos==1" title="Descargar expediente en PDF"><i class="fas fa-file-pdf"></i> PDF</x-panel.boton>
                </x-slot:acciones>
                <div class="tw:flex tw:flex-wrap tw:justify-center tw:gap-4 tw:py-4">
                    <x-panel.boton variante="exito" tamano="lg" href="AlumActualizar" v-if="datos==1"><i class="fas fa-folder tw:text-2xl"></i> Editar Expediente</x-panel.boton>
                    <x-panel.boton tamano="lg" href="Alum" v-if="datos==2"><i class="fas fa-folder tw:text-2xl"></i> Llenar Expediente</x-panel.boton>
                </div>
            </x-panel.tarjeta>
        </div>
    @else
        <div class="tw:mx-auto tw:max-w-2xl" id="principal" x-ignore>
            <x-panel.tarjeta :titulo="Session::get('nombre')" subtitulo="Expediente de Tutorías">
                <x-slot:acciones>
                    <x-panel.boton variante="peligro" tamano="sm" :href="url('/tutorias/pdf/all')" target="_blank" v-if="datos==1" title="Descargar expediente en PDF"><i class="fas fa-file-pdf"></i> PDF</x-panel.boton>
                </x-slot:acciones>
                <div class="tw:flex tw:flex-wrap tw:justify-center tw:gap-4 tw:py-4">
                    <x-panel.boton variante="exito" tamano="lg" href="AlumActualizar" v-if="datos==1"><i class="fas fa-folder tw:text-2xl"></i> Editar Expediente</x-panel.boton>
                    <x-panel.boton tamano="lg" href="Alum" v-if="datos==2"><i class="fas fa-folder tw:text-2xl"></i> Llenar Expediente</x-panel.boton>
                </div>

                <div class="tw:mt-2 tw:flex tw:flex-col tw:items-center tw:gap-4 tw:border-t tw:border-gray-100 tw:pt-6 tw:dark:border-gray-800" v-if="datos==1">
                    <div class="tw:text-center" style="color: #942a25">
                        @if($alumno->foto == 'image/jpeg')
                            <img src="{{ asset('Fotografias/'.$alumno->cuenta.'.jpeg') }}" class="tw:rounded-xl tw:border tw:border-gray-200 tw:object-cover tw:dark:border-gray-800" alt="Agrega tu foto, para poder imprimir tu expediente. Dar clic en Modificar Fototgrafia" width="136" height="200" />
                        @elseif($alumno->foto == 'image/png')
                            <img src="{{ asset('Fotografias/'.$alumno->cuenta.'.png') }}" class="tw:rounded-xl tw:border tw:border-gray-200 tw:object-cover tw:dark:border-gray-800" alt="Agrega tu foto, para poder imprimir tu expediente. Dar clic en Modificar Fototgrafia" width="136" height="200" />
                        @elseif($alumno->foto == 'image/jpg')

                            <img src="{{ asset('Fotografias/'.$alumno->cuenta.'.jpg') }}" class="tw:rounded-xl tw:border tw:border-gray-200 tw:object-cover tw:dark:border-gray-800" alt="Agrega tu foto, para poder imprimir tu expediente. Dar clic en Modificar Fototgrafia" width="136" height="200" />
                        @endif
                    </div>
                    <x-panel.boton variante="info" data-toggle="modal" data-target="#myModal">Modificar fotografia</x-panel.boton>
                </div>
            </x-panel.tarjeta>

            <x-panel.modal id="myModal" titulo="Modificar fotografia" tamano="lg" sin-relleno>
                <form class="form" id="form_solicitud_residencia" action="{{url("/computo/modificar_imagen/".$alumno->id_alumno)}}" role="form" method="POST" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="tw-modal-cuerpo">
                        <x-panel.input etiqueta="Seleccionar Foto" type="file" accept="image/jpeg,image/png" name="foto" id="foto" required />
                    </div>
                    <x-panel.modal-pie>
                        <x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton>
                        <x-panel.boton type="submit">Aceptar</x-panel.boton>
                    </x-panel.modal-pie>
                </form>
            </x-panel.modal>
        </div>
    @endif

<script>
    new Vue({
        el: "#principal",
        created: function () {
            this.getDatos();
        },
        data: {
            rut: "/tutorias/panel",
            datos:[],
        },
        methods: {
            getDatos: function () {
                axios.get(this.rut).then(response => {
                    this.datos = response.data;
                }).catch(error => {
                });
            },
        }
    });
</script>
@endsection
