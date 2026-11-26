@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Ambiental')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <div id="periodoss" x-ignore>
        <main class="tw:w-full tw:lg:w-full tw:px-2">


            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Periodos de ambiental </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="tabla_envio" class="table-responsive tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Periodo</th>
                            <th>Año</th>
                            <th>Mes</th>
                            <th>Acción</th>
                            <th>Solicitud de documentacion</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="periodo in periodos" :key="periodo.id_periodo_amb">
                            <td>@{{ periodo.id_periodo_amb }}</td>
                            <td>@{{ periodo.nombre_periodo_amb}}</td>
                            <td>@{{ periodo.fecha_an}}</td>
                            <td v-if="periodo.fecha_mes == 1">Enero</td>
                            <td v-if="periodo.fecha_mes == 2">Junio</td>
                            <template v-if="activo == 0 ">
                            <td  v-if="periodo.estado_periodo == 0"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" v-on:click="abrirModal_activar(periodo);" >Activar</button></td>
                                <td  v-if="periodo.estado_periodo == 2"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" v-on:click="abrirModal_activar(periodo);" >Activar nuevamente</button></td>
                            </template>
                            <template v-if="activo > 0 ">
                                <td  v-if="periodo.estado_periodo == 1"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" v-on:click="abrirModal_desactivar(periodo);" >Desactivar</button> Periodo Activo</td>
                                <td  v-if="periodo.estado_periodo == 1"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" v-on:click="solicitud_documentacion(periodo);" >Solicitud de Documentación</button></td>

                                <td  v-if="periodo.estado_periodo == 0"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" :disabled="true">Se encuentra activo un periodo</button></td>
                                <td  v-if="periodo.estado_periodo == 2"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" :disabled="true">Se encuentra activo un periodo</button></td>

                            </template>


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
            el:"#periodoss",

            data(){
                return {
                    periodo: {
                        nombre_periodo_amb:"",
                        fecha_an :0,
                        fecha_mes:0,
                    },
                    tituloModal_periodo:" ",
                    //lo inicialisamos el array
                    periodos:[],
                    activaciones:[],


                    activo:"",
                    estadoguardar:false,
                    modal_per_act:0,
                    modal_per_desact:0,
                    id_periodo:0,



                }
            },
            methods:{
                //meetodo para mostrar tabla
                async Periodos() {
                    //llamar datos al controlador
                    const resultado = await axios.get('/ambiental/ver_periodos/tabla');
                    this.periodos = resultado.data;
                    const contar = await axios.get('/ambiental/periodo_activado');
                    this.activaciones = contar.data;
                    this.activo = this.activaciones[0].contar;


//TNotify.alert(this.periodos[0].id_periodo_amb);
                    //aqui se guarda el arreglo que traemos
                },

                abrirModal_activar(data={}){

                    this.estadoguardar=false;
                    this.modal_per_act=1;
                    this.tituloModal_periodo="Activar periodo";
                    this.id_periodo=data.id_periodo_amb;
                    this.periodo.nombre_periodo_amb=data.nombre_periodo_amb;
                    this.periodo.fecha_an=data.fecha_an;
                    this.periodo.fecha_mes=data.fecha_mes;
                },
                abrirModal_desactivar(data={}){

                    this.estadoguardar=false;
                    this.modal_per_desact=1;
                    this.tituloModal_periodo="Desactivar periodo";
                    this.id_periodo=data.id_periodo_amb;
                    this.periodo.nombre_periodo_amb=data.nombre_periodo_amb;
                    this.periodo.fecha_an=data.fecha_an;
                    this.periodo.fecha_mes=data.fecha_mes;
                },
                cerrarModal_activar(){
                    this.modal_per_act=0;
                },
                cerrarModal_desactivar(){
                    this.modal_per_desact=0;
                },

                async guardar_periodo_activo (){

                    this.estadoguardar=true;
                    const resultado=await axios.post('/ambiental/guardar_periodo_activo/'+this.id_periodo);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.cerrarModal_activar();
                    this.Periodos();

                },
                async guardar_periodo_desactivo (){

                    this.estadoguardar=true;
                    const resultado=await axios.post('/ambiental/guardar_periodo_desactivo/'+this.id_periodo);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                    this.cerrarModal_desactivar();
                    this.Periodos();

                },
                async solicitud_documentacion(data={}) {
                    this.id_periodo=data.id_periodo_amb;
                    window.location.href = '/ambiental/ver_proc_ambiental/'+this.id_periodo;
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

@endsection
