@extends('layouts.panel')
@section('title', 'Historial de documentación ambiental')

@push('cabeza')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
        #periodoss_ver[v-cloak] { display: none; }
    </style>
@endpush

@section('content')
    <x-panel.encabezado
        titulo="HISTORIAL DE DOCUMENTACIÓN AMBIENTAL"
        :migas="['Procedimiento Ambiental' => url('/ambiental/enviar_documentacion')]"
    />

    <div id="periodoss_ver" class="tw:space-y-6" x-ignore v-cloak>
        <x-panel.tarjeta titulo="Consultar historial por periodo">
            <div class="tw:max-w-md">
                <x-panel.select
                    id="personal"
                    etiqueta="Elegir periodo"
                    v-validate="'required'"
                    v-model="periodo.id_periodo"
                    v-on:change="seleccion_periodo();"
                >
                    <option disabled selected hidden :value="0">Selecciona una opción</option>
                    <option v-for="periodo in periodos" :value="periodo.id_periodo_amb">@{{ periodo.nombre_periodo_amb }}</option>
                </x-panel.select>
            </div>
        </x-panel.tarjeta>

        <x-panel.tarjeta titulo="Resultados del historial">
            <template v-if="!estadover && !periodo.id_periodo">
                <x-panel.vacio titulo="Selecciona un periodo para consultar su historial" />
            </template>

            <template v-if="estadover && !procedimientos.length">
                <x-panel.vacio titulo="Sin registros para el periodo seleccionado" />
            </template>

            <template v-if="estadover && procedimientos.length">
                <x-panel.tabla id="tabla_envio">
                    <thead>
                        <tr>
                            <th scope="col">Procedimiento</th>
                            <th scope="col">Encargado</th>
                            <th scope="col">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="procedimiento in procedimientos" :key="procedimiento.id_procedimiento">
                            <td>@{{ procedimiento.nom_procedimiento }}</td>
                            <td>@{{ procedimiento.nombre }}</td>
                            <td v-if="procedimiento.estado_envio_doc == 0">No ha enviado su documentación</td>
                            <td v-if="procedimiento.estado_envio_doc == 1">Envio su documentación al departamento</td>
                            <td v-if="procedimiento.estado_envio_doc == 2">En estado de modificacion</td>
                            <td v-if="procedimiento.estado_envio_doc == 3">Envio su documentación al departamento</td>
                            <td v-if="procedimiento.estado_envio_doc == 4">
                                <x-panel.boton variante="exito" tamano="sm" v-on:click="abrirdocumentos_ver(procedimiento);">
                                    Documentación
                                </x-panel.boton>
                            </td>
                        </tr>
                    </tbody>
                </x-panel.tabla>
            </template>
        </x-panel.tarjeta>
    </div>
@endsection

@push('scripts')
    <script>
        new Vue({
            el:"#periodoss_ver",

            data(){
                return {
                    periodo: {
                        id_periodo:0,
                        nombre_periodo_amb:"",
                        fecha_an :0,
                        fecha_mes:0,
                    },
                    tituloModal_periodo:" ",
                    //lo inicialisamos el array
                    periodos:[],
                    procedimientos:[],


                    activo:"",
                    estadover:false,
                    modal_per_act:0,
                    modal_per_desact:0,
                    id_periodo:0,
                    id_documentacion_encar:0,



                }
            },
            methods:{
                //meetodo para mostrar tabla
                async Periodos() {
                    //llamar datos al controlador
                    const resultado = await axios.get('/ambiental/ver_periodos/tabla');
                    this.periodos = resultado.data;



//TNotify.alert(this.periodos[0].id_periodo_amb);
                    //aqui se guarda el arreglo que traemos
                },

                async seleccion_periodo(){


                    const resultado = await axios.get('/ambiental/ver_procedimiento_encargado/'+this.periodo.id_periodo);
                    this.procedimientos = resultado.data;
                    this.estadover=true;
                },
                async abrirdocumentos_ver(data={}) {
                    this.id_documentacion_encar=data.id_documentacion_encar;
                    window.location.href = '/ambiental/ver_doc_encargado_dep_aut/'+this.id_documentacion_encar;
                },




            },
            //funciones para cuando se cargue la vista
            async created(){
                //disparar la funcion

                this.Periodos();


            },
        })
    </script>
@endpush
