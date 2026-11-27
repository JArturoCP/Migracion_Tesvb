@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app', ['vue' => true, 'axios' => true])
@section('content')
<div class="tw-pantalla">
    <div id="procedimiento" x-ignore data-carga-axios>
        <main class="tw:w-full tw:lg:w-full tw:px-2">


            <x-panel.encabezado titulo="Procedimientos" :migas="['Gestión ambiental' => null]" />
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <button v-on:click=" modificarse=false , abrirModal();" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >
                        Agregar Procedimiento
                    </button>
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
                            <th>Modificar</th>
                        </tr>
                        </thead>
                        <tbody>

                           <tr v-for="procedimiento in procedimientos" :key="procedimiento.id_procedimiento">
                           <td>@{{ procedimiento.i }}</td>
                            <td>@{{ procedimiento.nom_procedimiento }}</td>
                               <td> <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" v-on:click=" modificarse=true , abrirModal(procedimiento);" >Editar</button></td>
                              {{--
                               <td> <a @click="eliminar_proce(procedimiento.id_procedimiento)"  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" >Eliminar</a></td>
                               --}}

                        </tr>


                        </tbody>
                    </table>
</div>
                </div>
            </div>


        </main>
        @include('ambiental.jefe_ambiental.crear_procedimiento')
    </div>
    <script>
        new Vue({
            el:"#procedimiento",

            data(){
                return {
                    //objeto donde se va a guardar los datos de un procedimiento
                    procedimiento: {
                         nom_procedimiento:'',
                    },
                    modificarse:true,
                    modal:0,
                    tituloModal:" ",
             //lo inicialisamos el array
                    procedimientos:[],
                    id_proce:0,
                    estadoguardar:false,


                }
            },
            methods:{
                //meetodo para mostrar tabla
                async getProcedimiento() {
                    //llamar datos al controlador
                    const resultado=await axios.get('/ambiental/ver_procedimientos/tabla');

                    this.procedimientos=resultado.data;
                    //aqui se guarda el arreglo que traemos
                },

                 async eliminar_proce (id_procedimiento){
                    const resultado=await axios.delete('/ambiental/eliminar_procedimientos/'+id_procedimiento);
                     this.getProcedimiento();
                },
                async guardar_proc (){
                    if(this.modificarse){
                        const resultado=await axios.put('/ambiental/modificar_procedimientos/'+this.id_proce,this.procedimiento);
                        this.cerrarModal();
                        this.getProcedimiento();
                    }else{

                        if( this.procedimiento.nom_procedimiento == ''){
                            swal({
                                position: "top",
                                type: "warning",
                                title: "El campo se encuentra  vacío.",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            this.estadoguardar=true;
                            const resultado=await axios.post('/ambiental/registrar_procedimientos/',this.procedimiento);
                            swal({
                                position: "top",
                                type: "success",
                                title: "Registro exitoso",
                                showConfirmButton: false,
                                timer: 3500
                            });
                            this.cerrarModal();
                            this.getProcedimiento();
                        }

                    }

                },
                abrirModal(data={}){
                    this.estadoguardar=false;
                    this.modal=1;
                    if(this.modificarse){
                        this.id_proce=data.id_procedimiento;
                        this.tituloModal="Modificar Procedimiento";
                        this.procedimiento.nom_procedimiento=data.nom_procedimiento;
                    }else{
                        this.id_proce=data.id_procedimiento;
                        this.tituloModal="Agregar Nuevo Procedimiento";
                        this.procedimiento.nom_procedimiento='';
                    }
                },
               cerrarModal(){
                    this.modal=0;
                },

            },
            //funciones para cuando se cargue la vista
            async created(){
                //disparar la funcion
                this.getProcedimiento();

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
