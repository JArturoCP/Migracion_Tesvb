@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Facilitadores de ingles')
@section('content')

    <main class="ingles-catalogo tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <div id="reg_facilitadores" class="tw:space-y-4" v-cloak>
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Facilitadores de inglés</h1>
            <div class="tesvb-tabla-scroll">
                <x-panel.tabla id="tabla_facilitadores" class="table table-resposive tw:mb-0" style="min-width: 760px !important" desplazable="Facilitadores de inglés" aria-label="Facilitadores de inglés">
                            <thead>
                            <tr>
                                <th scope="col">Asignar horas</th>
                                <th scope="col">Horas máximas</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Nivel de inglés</th>
                                <th scope="col">Título</th>
                                <th scope="col">Fecha de emisión</th>
                                <th scope="col">Sexo</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr v-for="facilitador in facilitadores">
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" v-on:click=" abrirModal_facilitador(facilitador);">
                                        <i class="glyphicon glyphicon-cog em2" aria-hidden="true"></i> Asignar horas
                                    </button>
                                </td>
                                <td v-if="facilitador.horas_maximas > 0">@{{ facilitador.horas_maximas }}</td>
                                <td v-else>NO SE HAN ASIGNADO HORAS</td>
                                <td>@{{ facilitador.nombre }}  @{{ facilitador.apellido_paterno }} @{{ facilitador.apellido_materno }}</td>
                                <td>@{{ facilitador.nivel_ingles }}</td>
                                <td>@{{ facilitador.titulo }}</td>
                                <td>@{{ facilitador.fecha_emision_titulo }}</td>
                                <td>@{{ facilitador.sexo }}</td>


                            </tr>

                                <tr v-if="facilitadores.length === 0">
                                <td colspan="7">No hay facilitadores para mostrar.</td>
                            </tr>
                            </tbody>
                        </x-panel.tabla>
            </div>
            <div class="modal ingles-catalogo-modal" :class="{mostrar:modal}" role="dialog" aria-labelledby="titulo-horas-facilitador">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-label="Cerrar" @click="cerrarModal_F();">&times;</button>
                            <h2 class="modal-title" id="titulo-horas-facilitador">Asignar horas al facilitador</h2>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p style="text-align: center">NOMBRE DEL FACILITADOR:  @{{ nombre_facilitador }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="horas_profesor">Horas asignadas: </label>
                                        <template v-if="horas_maximas == 0">
                                            <input class="form-control" type="number" min="0" max="49" id="horas_profesor" name="horas_profesor" v-model="horas_maximas" placeholder="Asignar horas"  required />
                                        </template>
                                        <template v-if="horas_maximas > 0">
                                            <input class="form-control" type="number" min="0" max="49" id="horas_profesor" name="horas_profesor" v-model="horas_maximas"   required />
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" @click="cerrarModal_F();">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click=" guardar_horas();" :disabled="estado_guardar">Agregar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        new Vue({
            el:"#reg_facilitadores",

            data(){
                return {

                    modal:0,
                    modal_mod:0,
                    estado_guardar:false,
                    facilitadores:[],
                    activo:0,
                    id_facilitador:0,
                    nombre_facilitador:"",
                    horas_maximas:0,





                }
            },
            methods:{

                async Ver_Facilitadores() {
                    //llamar datos al controlador (devuelve la lista directamente)
                    const res= await axios.get('/ingles/mostrar_profesore_ingles/');
                    const lista = Array.isArray(res.data) ? res.data : (res.data && Array.isArray(res.data.data) ? res.data.data : []);
                    this.facilitadores = lista;
                },
                async  abrirModal_facilitador(data={}){
                    this.id_facilitador=data.id_profesores;
                    this.nombre_facilitador=data.nombre+" "+data.apellido_paterno+" "+data.apellido_materno;
                    this.horas_maximas=data.horas_maximas;
                    this.estado_guardar=false;
                    this.modal=1;


                },
                async cerrarModal_F(){
                    this.modal=0;
                },
                async  guardar_horas(){

                    if(this.horas_maximas > 0){

                        const resultado=await axios.post('/armar_plantilla/profesor/agregar_horas_profesor/'+this.id_facilitador+'/'+this.horas_maximas);
                        swal({
                            position: "top",
                            type: "success",
                            title: "Registro exitoso",
                            showConfirmButton: false,
                            timer: 3500
                        });
                        this.cerrarModal_F();
                        this.Ver_Facilitadores();
                    }else{
                        swal({
                            position: "top",
                            type: "warning",
                            title: "Selecciona una opción",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }



                },



            },
            //funciones para cuando se cargue la vista
            created(){
                this.Ver_Facilitadores();
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

    <style>
        .dark .ingles-catalogo-modal .modal-content,
        .dark .ingles-catalogo-modal .modal-header {
            background: #1d2939;
            color: #f2f4f7;
            border-color: #475467;
        }
        .dark .ingles-catalogo-modal .modal-footer {
            border-color: #475467;
        }
        .dark .ingles-catalogo-modal .close {
            color: #f2f4f7;
            opacity: 1;
            text-shadow: none;
        }
        .dark .ingles-catalogo-modal input.form-control {
            background: #101828;
            color: #f2f4f7;
            border-color: #667085;
        }
    </style>
    <style>
        #reg_facilitadores[v-cloak] { display: none; }
    </style>
    <style>
        .ingles-catalogo .btn-primary,
        .ingles-catalogo-modal .btn-primary {
            background: #3538cd;
            border-color: #3538cd;
            color: #fff;
        }
        .ingles-catalogo .btn-primary:hover,
        .ingles-catalogo-modal .btn-primary:hover {
            background: #2d31a6;
            border-color: #2d31a6;
            color: #fff;
        }
        .ingles-catalogo .btn:focus-visible,
        .ingles-catalogo-modal .btn:focus-visible {
            outline: 2px solid #3538cd;
            outline-offset: 2px;
        }
        .dark .ingles-catalogo .btn:focus-visible,
        .dark .ingles-catalogo-modal .btn:focus-visible {
            outline-color: #a4bcfd;
        }
    </style>
@endsection