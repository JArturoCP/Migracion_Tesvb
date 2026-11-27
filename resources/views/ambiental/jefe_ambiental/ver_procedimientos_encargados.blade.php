@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <div id="reg_proc" x-ignore>
        <main class="tw:w-full tw:lg:w-full tw:px-2">


            <x-panel.encabezado :titulo="'Solicitud de documentación de los procedimientos del periodo {{ nom_periodo }}'" :migas="['Gestión ambiental' => null]" />
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <p>
                        <span class="fa fa-arrow-right"></span>
                        <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/ambiental/ver_periodos")}}">Periodos Ambiental</a>
                        <span class="fa fa-chevron-right"></span>
                        <span>Procedimientos Registrados </span>

                    </p>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Procedimiento</th>
                            <th>Encargado</th>
                            <th>Solicitar Documentación</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="procedimiento in procedimientos" :key="procedimiento.id_procedimiento">
                            <td>@{{ procedimiento.i }}</td>
                            <td>@{{ procedimiento.nombre_procedimiento }}</td>
                            <td>@{{ procedimiento.nombre_encargado }}</td>
                            <td v-if="procedimiento.estado_doc == 0" > <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="agregar_solicitud(procedimiento);" >Agregar</button></td>
                            <td v-if="procedimiento.estado_doc == 1" > <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="agregar_solicitud(procedimiento);" >Ver solicitud </button></td>

                        </tr>


                        </tbody>
                    </table>
</div>
                </div>
            </div>


        </main>
        @include('ambiental.jefe_ambiental.activar_periodo')
        @include('ambiental.jefe_ambiental.desactivar_periodo')
    </div>
    <script>
        new Vue({
            el:"#reg_proc",

            data(){
                return {
                    periodo: {
                        nombre_periodo_amb:"",
                        fecha_an :0,
                        fecha_mes:0,
                    },
                    tituloModal_periodo:" ",
                    //lo inicialisamos el array
                    procedimientos:[],
                    period:[],


                    activo:"",
                    estadoguardar:false,
                    modal_per_act:0,
                    modal_per_desact:0,
                    id_periodo:0,
                    nom_periodo:"",
                    id_encargado:0,



                }
            },
            methods:{
                //meetodo para mostrar tabla
                async Procedimientos() {
                    //llamar datos al controlador

                    const resultado=await axios.get('/ambiental/buscar_encargados_procedimientos/{{$id_periodo}}');
                    this.procedimientos=resultado.data;


                    const periodo = await axios.get('/ambiental/datos_periodo/{{$id_periodo}}');
                    this.period = periodo.data;
                    this.nom_periodo = this.period[0].nombre_periodo_amb;


//TNotify.alert(this.periodos[0].id_periodo_amb);
                    //aqui se guarda el arreglo que traemos
                },


                async agregar_solicitud(data={}) {
                    this.id_encargado=data.id_encargado;

                    window.location.href = '/ambiental/ver_proc_encargado_doc/'+ {{$id_periodo}}+'/'+this.id_encargado;
                },

            },
            //funciones para cuando se cargue la vista
            async created(){
                //disparar la funcion
                this.Procedimientos();


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
