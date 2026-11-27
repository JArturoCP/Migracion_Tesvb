@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <div id="periodoss" x-ignore data-carga-axios>
        <main class="tw:w-full tw:lg:w-full tw:px-2">


            <x-panel.encabezado titulo="Periodos de ambiental" :migas="['Gestión ambiental' => null]" />

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">
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
                            <td  v-if="periodo.estado_periodo == 0"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModal_activar(periodo);" >Activar</button></td>
                                <td  v-if="periodo.estado_periodo == 2"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModal_activar(periodo);" >Activar nuevamente</button></td>
                            </template>
                            <template v-if="activo > 0 ">
                                <td  v-if="periodo.estado_periodo == 1"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModal_desactivar(periodo);" >Desactivar</button> Periodo Activo</td>
                                <td  v-if="periodo.estado_periodo == 1"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="solicitud_documentacion(periodo);" >Solicitud de Documentación</button></td>

                                <td  v-if="periodo.estado_periodo == 0"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" :disabled="true">Se encuentra activo un periodo</button></td>
                                <td  v-if="periodo.estado_periodo == 2"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" :disabled="true">Se encuentra activo un periodo</button></td>

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

</div>
@endsection
