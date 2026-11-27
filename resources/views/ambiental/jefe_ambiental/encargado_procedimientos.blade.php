@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <div id="encargados_procedimiento" x-ignore data-carga-axios>
        <main class="tw:w-full tw:lg:w-full tw:px-2">


            <x-panel.encabezado titulo="Encargados Procedimientos" :migas="['Gestión ambiental' => null]" />

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio_encargado" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Procedimiento</th>
                            <th>Encargado</th>
                            <th>Modificar</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="encargado in encargados" :key="encargado.id_encargado">
                            <td>@{{ encargado.i }}</td>
                            <td>@{{ encargado.nom_procedimiento }}</td>
                                <td v-if="encargado.status == 0"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModal(encargado);" >Agregar encargado</button></td>
                                <td v-if="encargado.status == 0"></td>
                                <td v-if="encargado.status == 1">@{{ encargado.nombre_personal }}</td>
                               <td v-if="encargado.status == 1"> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModal_mod(encargado);" >Modificar encargado</button></td>




                        </tr>


                        </tbody>
                    </table>
</div>
                </div>
            </div>


        </main>
        @include('ambiental.jefe_ambiental.agregar_encargado')
        @include('ambiental.jefe_ambiental.modificar_encargado')

    </div>
    <script>

        new Vue({
            el:"#encargados_procedimiento",

            data(){
                return {
                    //objeto donde se va a guardar los datos de un procedimiento
                    encargado: {
                        nom_procedimiento:'',
                        id_personal:0,
                    },
                    modificar_encar:true,
                    modal_encar:0,
                    modal_mod_encar:0,
                    tituloModal_encar:" ",
                    //lo inicialisamos el array
                    encargados:[],
                    personales:[],
                    id_procedimiento:0,
                    estadoguardar:false,


                }
            },
            methods:{
                //meetodo para mostrar tabla
                async Encargados() {
                    //llamar datos al controlador
                    const resultado=await axios.get('/ambiental/ver_encargados/tabla');

                    this.encargados=resultado.data;

                    //aqui se guarda el arreglo que traemos
                },
                async Personal() {
                    //llamar datos al controlador
                    const resultado=await axios.get('/ambiental/personal_tecnologico/');

                    this.personales=resultado.data;
                    //aqui se guarda el arreglo que traemos
                },

                async eliminar_proce (id_procedimiento){
                    const resultado=await axios.delete('/ambiental/eliminar_procedimientos/'+id_procedimiento);
                    this.getProcedimiento();
                },
                async guardar_encargado (){
                    if(this.encargado.id_personal == 0) {
                        swal({
                            position: "top",
                            type: "warning",
                            title: "Selecciona una opción",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }else{
                        this.estadoguardar=true;
                        const resultado=await axios.post('/ambiental/guardar_encargado/'+this.id_procedimiento,this.encargado);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                        this.cerrarModal();
                        this.Encargados();
                    }
                },
                async guardar_encargado_mod (){

                        this.estadoguardar=true;
                        const resultado=await axios.post('/ambiental/modificar_encargado/'+this.id_procedimiento,this.encargado);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                        this.cerrarModal_mod();
                        this.Encargados();
                },
                abrirModal(data={}){
                    this.estadoguardar=false;
                    this.modal_encar=1;
                    this.tituloModal_encar="Agregar Encargado del Procedimiento";
                    this.id_procedimiento=data.id_procedimiento;
                    this.encargado.nom_procedimiento=data.nom_procedimiento;
                    this.encargado.id_personal=0;
                },
                abrirModal_mod(data={}){
                    this.estadoguardar=false;
                    this.modal_mod_encar=1,
                    this.tituloModal_encar="Modificar Encargado del Procedimiento";
                    this.id_procedimiento=data.id_procedimiento;
                    this.encargado.nom_procedimiento=data.nom_procedimiento;
                    this.encargado.id_personal=data.id_personal;
                },
                cerrarModal(){
                    this.modal_encar=0;
                },
                cerrarModal_mod(){
                    this.modal_mod_encar=0;
                },

            },
            //funciones para cuando se cargue la vista
            async created(){
                //disparar la funcion
                this.Encargados();
                this.Personal();
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
