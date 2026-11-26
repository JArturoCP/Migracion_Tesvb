@extends('layouts.panel')
@section('title', 'Registro Riesgos')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2" id="contRegistroRiesgo" x-ignore data-carga-axios>

        <x-panel.encabezado titulo="Registro de riesgos" :migas="['Riesgos y oportunidades' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            
            <div class="tw:w-full tw:lg:w-full tw:px-2" >
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Unidad administrativa</th>
                        <th>Selección</th>
                        <th>Descripción</th>
                        <th>Riesgo</th>
                        <th>Nivel de decisión del riesgo</th>
                        <th>Fecha</th>
                        <th>Clasificación del riesgo</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr v-for="registroRiesgo in tablaRiesgos">
                            <td>@{{registroRiesgo.numero}}</td>
                            <td>@{{(registroRiesgo.unidad_admin[0])?registroRiesgo.unidad_admin[0].nom_departamento:''}}</td>
                            <td>@{{(registroRiesgo.seleccion[0])?registroRiesgo.seleccion[0].des_seleccion:''}}</td>
                            <td>@{{registroRiesgo.descip_riesgo}}</td>
                            <td>@{{(registroRiesgo.riesgos[0])?registroRiesgo.riesgos[0].des_riesgo:''}}</td>
                            <td>@{{(registroRiesgo.nivel_decision[0])?registroRiesgo.nivel_decision[0].des_nivel_des:''}}</td>
                            <td>@{{registroRiesgo.fecha }}</td>
                            <td>@{{(registroRiesgo.clasificacion_riesgo[0])?registroRiesgo.clasificacion_riesgo[0].des_cl:''}}</td>

                            <td>
                                <a href="{{--{{url('/riesgos/registroriesgos/'.$riesgo->id_reg_riesgo)}}--}}" class="modificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{--{{ $riesgo->id_reg_riesgo }}--}}"><span class="fa fa-indent " aria-hidden="true"></span></a>
                            </td>

                            <td>
                                <a class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{--{{ $riesgo->id_reg_riesgo}}--}}"><span class="fa fa-trash " aria-hidden="true"></span></a>
                            </td>
                        </tr>


                    </tbody>
                </table>
</div>
            </div>
        </div>
    </main>
    <div>
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Registrar riesgo" data-target="#modal_registrar_riesgo" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>
    <x-panel.modal id="modal_registrar_riesgo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel" x-ignore data-carga-axios>
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Evaluación de Riesgos</h5>
                    
                </div>
                <form id="form_registrar_riesgo" class="" role="form" method="POST" @submit.prevent="onSubmit" action="{{url('api/riesgos/registroriesgos/')}}">
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <div :class="['form-group', allerros.unidad_administrativa ? 'has-error' : '']">
                            <label for="unidad_administrativa" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Unidad Administrativa</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="unidad_administrativa" id="unidad_administrativa" v-model="form.unidad_administrativa">
                                <option disabled value="">Seleccione una opción</option>
                                @foreach($unidad_administrativa as $unidad)
                                <option value="{{$unidad->id_unidad_admin}}">{{$unidad->nom_departamento}}</option>
                                @endforeach
                            </select>
                            <div v-if="allerros.unidad_administrativa" :class="['alert alert-danger']">@{{ allerros.unidad_administrativa[0] }}</div>
                        </div>
                        <div :class="['form-group', allerros.seleccion_riesgo ? 'has-error' : '']">
                            <label for="seleccion_rieso" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Alineación a Estrategias, Objetivos,
                                o Metas Institucionales</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="seleccion_riesgo" id="seleccion_rieso" v-model="form.seleccion_riesgo">
                                <option value="" disabled>Seleccione una opción</option>
                                @foreach($seleccion_riesgo as $seleccion)
                                    <option value="{{$seleccion->id_seleccion}}">{{$seleccion->des_seleccion}}</option>
                                @endforeach
                            </select>
                            <div v-if="allerros.seleccion_riesgo" :class="['alert alert-danger']">@{{ allerros.seleccion_riesgo[0] }}</div>

                        </div>
                        <div :class="['form-group', allerros.descripcion_riesgo ? 'has-error' : '']">
                            <label for="descripcion_riesgo" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Riesgo</label>
                            <input type="text" id="descripcion_riesgo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Escribe riesgo" v-model="form.descripcion_riesgo" v-on:keyup="autoComplete" >
                            <div class="tw:border-t tw:border-gray-100 tw:dark:border-gray-800 tw:px-5 tw:py-4" v-if="results.length">
                                <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800">
                                    <li class="tw:block tw:px-4 tw:py-3" v-for="result in results" v-on:click="setRiesgo(result.des_riesgo)">
                                        @{{ result.des_riesgo }}
                                    </li>
                                </ul>
                            </div>
                            <div v-if="allerros.descripcion_riesgo" :class="['alert alert-danger']">@{{ allerros.descripcion_riesgo[0] }}</div>

                        </div>

                        <div>
                            <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"></textarea>
                            <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Nivel de decisión del riesgo</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="" id="tipo_periodo">
                                <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                                <option value="">Estratégico</option>
                                <option value="">Directivo</option>
                                <option value="">Operativo</option>
                            </select>
                            <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Clasificación del riesgo</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="" id="tipo_periodo">
                                <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                                <option value="">Administrativo</option>
                                <option value="">De corrupción</option>
                                <option value="">De seguridad</option>
                                <option value="">De servicios</option>
                            </select>

                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </form>
            </x-panel.modal>

    <script>
        const app = new Vue({
            el: '#modal_registrar_riesgo',
            data(){
                return {
                    results: [],
                    form: {
                        unidad_administrativa : '',
                        seleccion_riesgo : '',
                        descripcion_riesgo:'',
                    },
                    allerros: [],
                }
            },
            methods: {
                autoComplete(){
                    this.results = [];
                    if(this.form.descripcion_riesgo.length > 2){
                        axios.get('/api/searchriesgo',{params: {query: this.form.descripcion_riesgo}}).then(response => {
                            this.results = response.data;
                        });
                    }
                },
                setRiesgo(riesgo)
                {
                    this.form.descripcion_riesgo=riesgo;
                    this.results=[];
                },
                onSubmit(){
                    dataform = new FormData();
                    dataform.append('unidad_administrativa', this.form.unidad_administrativa);
                    dataform.append('seleccion_riesgo', this.form.seleccion_riesgo);
                    dataform.append('descripcion_riesgo', this.form.descripcion_riesgo);
                    this.allerros = [];
                    axios.post('{{url('api/riesgos/registroriesgos/')}}', dataform).then( response => {
                        this.form.unidad_administrativa='';
                        this.form.seleccion_riesgo='';
                        this.form.descripcion_riesgo='';

                        swal('Se ha insertado correctamente');
                        $("#modal_registrar_riesgo").modal("hide");

                    } ).catch((error) => {
                        this.allerros = error.response.data;


                    });
                }
            }
        });
        const loadRiesgo = new Vue({
            el: '#contRegistroRiesgo',
            data(){
                return {
                    tablaRiesgos:[],
                }
            },
            beforeMount(){
                // TNotify.alert("ok")
                axios.get('/api/riesgos/registroriesgos')
                    .then(response => {
                       // console.log(response);
                        this.tablaRiesgos = response.data;
                    })
                    .catch(function () {
                        swal('No se puede conectar al servidor');
                    });
            },
        });
    </script>

</div>
@endsection


