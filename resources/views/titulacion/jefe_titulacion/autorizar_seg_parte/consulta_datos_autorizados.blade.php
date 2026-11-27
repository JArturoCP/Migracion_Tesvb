@php
    $secciones = [
        'Identificación y contacto' => [
            'Número de cuenta' => ["docu.no_cuenta"],
            'Nombre' => ["docu.nombre_al"],
            'Apellido paterno' => ["docu.apaterno"],
            'Apellido materno' => ["docu.amaterno"],
            'CURP' => ["docu.curp_al"],
            'Nacionalidad' => ["etiqueta(nacionalidades, 'id_nacionalidad', docu.id_nacionalidad, 'nacionalidad')"],
            'Correo electrónico' => ["docu.correo_electronico"],
            'Teléfono' => ["docu.telefono"],
            'Red social habitual' => ["etiqueta(redesSociales, 'id_red_social', docu.id_red_social, 'red_social')"],
            'Usuario de la red social' => ["docu.nombre_usuario_red"],
        ],
        'Trayectoria escolar' => [
            'Tipo de estudiante' => ["etiqueta(tiposEstudiantes, 'id_tipo_estudiante', docu.id_tipo_estudiante, 'tipo_estudiante')"],
            'Carrera' => ["etiqueta(carreras, 'id_carrera', docu.id_carrera, 'nombre')"],
            'Plan de estudios' => ["etiqueta(planesEstudios, 'id_plan_estudio', docu.id_plan_estudio, 'plan_estudio')"],
            'Promedio general del TESVB' => ["docu.promedio_general_tesvb"],
            'Reprobación de materias' => ["etiqueta(respuestas, 'id_respuesta', docu.reprobacion_mat, 'descripcion')"],
            'Ingreso al TESVB' => ["docu.fecha_ingreso_tesvb"],
            'Egreso del TESVB' => ["docu.fecha_egreso_tesvb"],
            'Semestres cursados' => ["etiqueta(semestres, 'id_semestre', docu.id_semestre, 'id_semestre')"],
            'Ingreso a preparatoria o bachillerato' => ["docu.fecha_ingreso_preparatoria"],
            'Egreso de preparatoria o bachillerato' => ["docu.fecha_egreso_preparatoria"],
        ],
        'Trámite de titulación' => [
            'Emisión del certificado' => ["docu.fecha_emision_certificado"],
            'Registro del trámite' => ["docu.fecha_reg_tramite_titulacion"],
            'Pago de derecho de titulación' => ["docu.fecha_pag_derechos_titulacion"],
            'Opción de titulación' => ["etiqueta(opciones, 'id_opcion_titulacion', docu.id_opcion_titulacion, 'opcion_titulacion')"],
            'Nombre del proyecto' => ["docu.nom_proyecto"],
            'Jefe de división' => ["docu.nombre"],
            'Empresa de residencia profesional' => ["docu.nom_empresa"],
        ],
        'Domicilio' => [
            'Calle' => ["docu.calle_domicilio"],
            'Número' => ["docu.numero_domicilio"],
            'Colonia o comunidad' => ["docu.colonia_domicilio"],
            'Entidad federativa' => ["etiqueta(estados, 'id_estado', docu.entidad_federativa, 'nombre_estado')"],
            'Municipio o ciudad' => ["etiqueta(municipios, 'id_municipio', docu.municipio_domicilio, 'nombre_municipio')"],
        ],
        'Información complementaria' => [
            'Presenta alguna discapacidad' => ["etiqueta(respuestas, 'id_respuesta', docu.presenta_discapacidad, 'descripcion')"],
            'Discapacidad indicada' => ["docu.discapacidad_que_presenta", "docu.presenta_discapacidad == 1"],
            'Habla alguna lengua indígena' => ["etiqueta(respuestas, 'id_respuesta', docu.lengua_indigena, 'descripcion')"],
            'Lengua indígena indicada' => ["docu.habla_lengua_indigena", "docu.lengua_indigena == 1"],
            'Tipo de donación' => ["etiqueta(tiposDonaciones, 'id_tipo_donacion', docu.id_tipo_donacion, 'tipo_donacion')"],
        ],
    ];
@endphp

<x-panel.encabezado titulo="Datos personales autorizados" :migas="$migas" />

<div id="reg_datos" x-ignore>
    <template v-if="cargando">
        <p role="status" class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">Cargando datos del estudiante…</p>
    </template>
    <template v-if="errorCarga">
        <x-panel.alerta tipo="error">No se pudieron cargar los datos del estudiante.</x-panel.alerta>
        <x-panel.boton variante="secundario" class="tw:mt-3" v-on:click="cargar">Reintentar</x-panel.boton>
    </template>
    <template v-if="!cargando && !errorCarga && !docu">
        <x-panel.vacio titulo="Sin datos registrados" />
    </template>
    <template v-if="!cargando && !errorCarga && docu">
        <div class="tw:space-y-5">
            @foreach ($secciones as $titulo => $campos)
                <x-panel.tarjeta :titulo="$titulo">
                    <dl class="tw:grid tw:gap-4 tw:sm:grid-cols-2 tw:xl:grid-cols-3">
                        @foreach ($campos as $etiqueta => $campo)
                            <div v-if="{{ $campo[1] ?? 'true' }}" class="tw:min-w-0 tw:rounded-lg tw:bg-gray-50 tw:p-3 tw:dark:bg-white/5">
                                <dt class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">{{ $etiqueta }}</dt>
                                <dd class="tw:mt-1 tw:text-sm tw:font-medium tw:break-words tw:text-gray-900 tw:dark:text-white"
                                    v-text="valor({{ $campo[0] }})"></dd>
                            </div>
                        @endforeach
                    </dl>

                    @if ($titulo === 'Trámite de titulación')
                        <div class="tw:mt-4" v-if="docu.mencion_honorifica == 1 || docu.mencion_honorifica == 2">
                            <span v-if="docu.mencion_honorifica == 1"><x-panel.badge tono="exito">Con mención honorífica</x-panel.badge></span>
                            <span v-else><x-panel.badge tono="gris">Sin mención honorífica</x-panel.badge></span>
                        </div>
                    @endif
                </x-panel.tarjeta>
            @endforeach

            <template v-if="docu.id_tipo_donacion == 2">
                <x-panel.tarjeta titulo="Donación de equipo o material didáctico">
                    <template v-if="equipo.length">
                        <x-panel.tabla compacta desplazable="Equipo o material didáctico">
                            <thead><tr>
                                <th scope="col">Nombre del equipo</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Folio fiscal</th>
                                <th scope="col">Tienda</th>
                            </tr></thead>
                            <tbody>
                                <tr v-for="item in equipo">
                                    <td v-text="valor(item.nombre_equipo)"></td>
                                    <td v-text="valor(item.descripcion)"></td>
                                    <td v-text="valor(item.folio_fiscal)"></td>
                                    <td v-text="valor(item.nombre_tienda)"></td>
                                </tr>
                            </tbody>
                        </x-panel.tabla>
                    </template>
                    <template v-else><x-panel.vacio titulo="Sin equipo registrado" /></template>
                </x-panel.tarjeta>
            </template>

            <template v-if="docu.id_tipo_donacion == 1">
                <x-panel.tarjeta titulo="Donación de libros">
                    <template v-if="libros.length">
                        <x-panel.tabla compacta desplazable="Libros donados">
                            <thead><tr>
                                <th scope="col">Título</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Editorial</th>
                            </tr></thead>
                            <tbody>
                                <tr v-for="libro in libros">
                                    <td v-text="valor(libro.titulo)"></td>
                                    <td v-text="valor(libro.autor)"></td>
                                    <td v-text="valor(libro.editorial)"></td>
                                </tr>
                            </tbody>
                        </x-panel.tabla>
                    </template>
                    <template v-else><x-panel.vacio titulo="Sin libros registrados" /></template>
                </x-panel.tarjeta>
            </template>
        </div>
    </template>
</div>

@push('scripts')
<script>
    new Vue({
        el: '#reg_datos',
        data: {
            cargando: true,
            errorCarga: false,
            docu: null,
            respuestas: [],
            carreras: [],
            planesEstudios: [],
            semestres: [],
            opciones: [],
            estados: [],
            municipios: [],
            tiposDonaciones: [],
            tiposEstudiantes: [],
            redesSociales: [],
            nacionalidades: [],
            libros: [],
            equipo: [],
        },
        methods: {
            valor(dato) {
                return dato === null || dato === undefined || dato === '' ? 'Sin dato' : dato;
            },
            etiqueta(catalogo, clave, id, campo) {
                return catalogo.find(item => String(item[clave]) === String(id))?.[campo];
            },
            async cargar() {
                const idAlumno = @json((int) $id_alumno);
                const consultar = async ruta => (await axios.get(ruta)).data;

                this.cargando = true;
                this.errorCarga = false;
                this.docu = null;
                try {
                    const registrado = await consultar('/titulacion/estado_reg_personales/' + idAlumno);
                    if (Number(registrado) === 0) { return; }

                    const [registro] = await consultar('/titulacion/ver_datos_alumno_registrados/' + idAlumno);
                    if (!registro) { return; }
                    const datos = await consultar('/titulacion/datos_personales/' + idAlumno);

                    [
                        this.respuestas, this.carreras, this.planesEstudios, this.semestres,
                        this.opciones, this.estados, this.municipios, this.tiposDonaciones,
                        this.tiposEstudiantes, this.redesSociales, this.nacionalidades,
                    ] = await Promise.all([
                        consultar('/ambiental/respuestas/'),
                        consultar('/titulacion/careras_tesvb/'),
                        consultar('/titulacion/planes_estudio_tesvb/'),
                        consultar('/titulacion/numeros_semestres_tesvb/'),
                        consultar('/titulacion/opciones_titulacion_tesvb/'),
                        consultar('/titulacion/entidades_federativas/'),
                        registro.entidad_federativa ? consultar('/titulacion/municipios/' + registro.entidad_federativa) : [],
                        consultar('/titulacion/tipo_donaciones/' + datos.id_tipo_descuento),
                        consultar('/titulacion/tipos_estudiantes/'),
                        consultar('/titulacion/tipos_redes_sociales/'),
                        consultar('/titulacion/nacionalidades/'),
                    ]);

                    if (Number(registro.id_tipo_donacion) === 1) {
                        this.libros = await consultar('/titulacion/ver_libros/' + registro.id_reg_dato_alum);
                    }
                    if (Number(registro.id_tipo_donacion) === 2) {
                        this.equipo = await consultar('/titulacion/ver_material_computo/' + registro.id_reg_dato_alum);
                    }

                    this.docu = registro;
                } catch {
                    this.errorCarga = true;
                } finally {
                    this.cargando = false;
                }
            },
        },
        created() {
            this.cargar();
        },
    });
</script>
@endpush
