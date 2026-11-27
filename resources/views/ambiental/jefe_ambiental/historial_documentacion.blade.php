@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <div id="periodoss_ver" x-ignore>
        <main class="tw:w-full tw:lg:w-full tw:px-2">


            <x-panel.encabezado titulo="Historial de los procedimientos de ambiental" :migas="['Gestión ambiental' => null]" />




        </main>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                    <label for="personal">Elegir periodo</label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  v-validate="'required'" v-model="periodo.id_periodo"  v-on:change="seleccion_periodo();">
                        <option disabled selected hidden :value="0">Selecciona una opción</option>
                        <option v-for="periodo in periodos" :value="periodo.id_periodo_amb">@{{periodo.nombre_periodo_amb}}</option>
                    </select>
                </div>
            </div>
        </div>
        <template v-if="estadover == true">


        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>

                        <th>Procedimiento</th>
                        <th>Encargado</th>
                        <th>Ver</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="procedimiento in procedimientos" :key="procedimiento.id_procedimiento">
                        <td>@{{ procedimiento.nom_procedimiento }}</td>
                        <td>@{{ procedimiento.nombre }}</td>
                        <td v-if="procedimiento.estado_envio_doc == 0">No ha enviado su documentación</td>
                        <td v-if="procedimiento.estado_envio_doc == 1">Envio su documentación al departamento</td>
                        <td v-if="procedimiento.estado_envio_doc == 2">En estado de  modificacion</td>
                        <td v-if="procedimiento.estado_envio_doc == 3">Envio su documentación al departamento</td>
                        <td v-if="procedimiento.estado_envio_doc == 4">
                         <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirdocumentos_ver(procedimiento);" >Documentación</button>

                        </td>


                    </tr>


                    </tbody>
                </table>
</div>
            </div>
        </div>
        </template>

    </div>
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


                    const resultado = await axios.get('/ambiental/ver_procedimiento_periodo/'+this.periodo.id_periodo);
                    this.procedimientos = resultado.data;
                    this.estadover=true;
                },
                async abrirdocumentos_ver(data={}) {
                    this.id_documentacion_encar=data.id_documentacion_encar;
                    window.location.href = '/ambiental/ver_doc_encargado_aut/'+this.id_documentacion_encar;
                },




            },
            //funciones para cuando se cargue la vista
            async created(){
                //disparar la funcion

                this.Periodos();


            },
        })
    </script>
    <style>
        .mostrar{
            display: list-item;
            opacity: 1;
            background: rgba(44,38,75,0.849);
        }
    </style>

</div>
@endsection
