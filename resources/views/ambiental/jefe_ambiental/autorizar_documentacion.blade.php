@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Ambiental')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>



    <div id="autorizar_doc" x-ignore>
        <main class="tw:w-full tw:lg:w-full tw:px-2">
            <template v-if="respuestas == 0">
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Autorizar documentación</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">No hay un periodo activo.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="respuestas == 1">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Autorizar documentación  del periodo {{ $periodo }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-9/12 tw:lg:ml-[8.3333%] tw:px-2">
                    <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200">
                        <li class="active" ><a href="#">Autorizar documentación</a>
                        </li>
                        <li  > <a href="{{url('/ambiental/proceso_de_modificacion/')}}">Proceso de modificación</a></li>
                        <li  > <a href="{{url('/ambiental/documentacion_autorizada/')}}">Documentación Autorizada</a></li>
                    </ul>
                    <br>
                </div>
            </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                        <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="tabla_envio" class="table-responsive tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>

                                <th>Procedimiento</th>
                                <th>Nombre del encargado</th>
                                <th>Autorizar Documentacion</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="encargado in encargados" :key="encargado.id_documentacion_encar">
                                <td>@{{ encargado.nom_procedimiento }}</td>
                                <td>@{{ encargado.nombre }}</td>
                                <td v-if="encargado.estado_envio_doc == 1"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" v-on:click="abrirdocumentos_enc(encargado);" >Autorizar</button></td>
                                <td v-if="encargado.estado_envio_doc == 3"> <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" v-on:click="abrirdocumentos_enc_con_mod(encargado);" >Autorizar modificaciones</button></td>

                                {{--
                                 <td> <a @click="eliminar_proce(procedimiento.id_procedimiento)"  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" >Eliminar</a></td>
                                 --}}

                            </tr>


                            </tbody>
                        </table>
</div>
                    </div>
                </div>

            </template>

        </main>

    </div>
    <script>
        new Vue({
            el:"#autorizar_doc",

            data(){
                return {
                    //objeto donde se va a guardar los datos de un procedimiento
                    modal:0,
                    tituloModal:" ",
                    //lo inicialisamos el array
                    encargados:[],
                    respuestass:[],
                    respuestas:[],
                    id_documentacion_encar:0,
                    estadoguardar:false,
                    respuestas:0,


                }
            },
            methods:{
                //meetodo para mostrar tabla
                async documentacion_enviada() {
                    //llamar datos al controlador
                    const res=await axios.get('/ambiental/estado_periodo/');
                    this.respuestass=res.data;
                    this.respuestas=this.respuestass[0].contar;
                    if(this.respuestas == 0){

                    }else {
                        this.respuestas == 1;
                        const resultado = await axios.get('/ambiental/ver_documentacion_encargado/');
                        this.encargados = resultado.data;
                    }





                    //aqui se guarda el arreglo que traemos
                },
                async abrirdocumentos_enc(data={}) {
                    this.id_documentacion_encar=data.id_documentacion_encar;
                    window.location.href = '/ambiental/documentacion_encar/'+this.id_documentacion_encar;
                },
                async abrirdocumentos_enc_con_mod(data={}){
                    this.id_documentacion_encar=data.id_documentacion_encar;
                    window.location.href = '/ambiental/documentacion_encar_mod/'+this.id_documentacion_encar;
                },
                cerrarModal(){
                    this.modal=0;
                },

            },
            //funciones para cuando se cargue la vista
            async created(){
                //disparar la funcion
                this.documentacion_enviada();

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
