@extends('layouts.panel')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('title', 'Registro Riesgos')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2" id="contRegistroRiesgo">

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[25%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Registro de riesgos</h3>
                    </div>
                </div>
            </div>
            <div class="tw:w-full tw:lg:w-full tw:lg:ml-[0%] tw:px-2" >
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table class="table-responsive tw-tabla tw-tabla-bordes">
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
                                <a href="{{--{{url('/riesgos/registroriesgos/'.$riesgo->id_reg_riesgo)}}--}}" class="modificar" data-id="{{--{{ $riesgo->id_reg_riesgo }}--}}"><span class="fa em2 fa-indent" aria-hidden="true"></span></a>
                            </td>

                            <td>
                                <a class="elimina" data-id="{{--{{ $riesgo->id_reg_riesgo}}--}}"><span class="fa fa-trash em2" aria-hidden="true"></span></a>
                            </td>
                        </tr>


                    </tbody>
                </table>
</div>
            </div>
        </div>
    </main>
    <div>
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Registrar riesgo" data-target="#modal_registrar_riesgo" type="button" class="flotante tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>
    <div class="modal fade tw-modal-compat" id="modal_registrar_riesgo" x-ignore tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Evaluación de Riesgos</h5>
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_registrar_riesgo" class="" role="form" method="POST" @submit.prevent="onSubmit" action="{{url('api/riesgos/registroriesgos/')}}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div :class="['form-group', allerros.unidad_administrativa ? 'has-error' : '']">
                            <label for="unidad_administrativa" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Unidad Administrativa</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="unidad_administrativa" id="unidad_administrativa" v-model="form.unidad_administrativa">
                                <option disabled value="">Seleccione una opción</option>
                                @foreach($unidad_administrativa as $unidad)
                                <option value="{{$unidad->id_unidad_admin}}">{{$unidad->nom_departamento}}</option>
                                @endforeach
                            </select>
                            <div v-if="allerros.unidad_administrativa" :class="['alert alert-danger']">@{{ allerros.unidad_administrativa[0] }}</div>
                        </div>
                        <div :class="['form-group', allerros.seleccion_riesgo ? 'has-error' : '']">
                            <label for="seleccion_rieso" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Alineación a Estrategias, Objetivos,
                                o Metas Institucionales</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="seleccion_riesgo" id="seleccion_rieso" v-model="form.seleccion_riesgo">
                                <option value="" disabled>Seleccione una opción</option>
                                @foreach($seleccion_riesgo as $seleccion)
                                    <option value="{{$seleccion->id_seleccion}}">{{$seleccion->des_seleccion}}</option>
                                @endforeach
                            </select>
                            <div v-if="allerros.seleccion_riesgo" :class="['alert alert-danger']">@{{ allerros.seleccion_riesgo[0] }}</div>

                        </div>
                        <div :class="['form-group', allerros.descripcion_riesgo ? 'has-error' : '']">
                            <label for="descripcion_riesgo" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Riesgo</label>
                            <input type="text" id="descripcion_riesgo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Escribe riesgo" v-model="form.descripcion_riesgo" v-on:keyup="autoComplete" >
                            <div class="tw:border-t tw:border-gray-100 tw:px-5 tw:py-4" v-if="results.length">
                                <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200">
                                    <li class="tw:block tw:px-4 tw:py-3" v-for="result in results" v-on:click="setRiesgo(result.des_riesgo)">
                                        @{{ result.des_riesgo }}
                                    </li>
                                </ul>
                            </div>
                            <div v-if="allerros.descripcion_riesgo" :class="['alert alert-danger']">@{{ allerros.descripcion_riesgo[0] }}</div>

                        </div>

                        <div>
                            <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"></textarea>
                            <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Nivel de decisión del riesgo</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="" id="tipo_periodo">
                                <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                                <option value="">Estratégico</option>
                                <option value="">Directivo</option>
                                <option value="">Operativo</option>
                            </select>
                            <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Clasificación del riesgo</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="" id="tipo_periodo">
                                <option value="0" disabled="true" selected="true">Seleccione una opción</option>
                                <option value="">Administrativo</option>
                                <option value="">De corrupción</option>
                                <option value="">De seguridad</option>
                                <option value="">De servicios</option>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

@endsection


