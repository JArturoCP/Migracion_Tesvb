{{-- Modal para editar procesos de la agenda: lo incluye auditorias/agenda2 cuando $ver == 'procesos_agenda'. --}}
@php($procesosMarcados = \Illuminate\Support\Facades\Session::get('procesos-agenda') ?: [])
<x-panel.modal id="modal_procesos_agenda" tamano="lg" clase-cerrar="close" titulo="Editar procesos de la agenda">
    <div class="tw:grid tw:gap-3 tw:sm:grid-cols-2">
        @foreach($procesos as $proceso)
            <x-panel.checkbox class="existentes" data-id="{{$proceso->id_auditoria_proceso}}" :checked="in_array($proceso->id_auditoria_proceso, $procesosMarcados)">{{$proceso->clave.' '.\App\audParseCase::parseProceso($proceso->des_proceso)}}</x-panel.checkbox>
        @endforeach
    </div>
    <x-slot:pie>
        <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
        <x-panel.boton variante="exito" class="guardar_procesos">
            <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar
        </x-panel.boton>
    </x-slot:pie>
</x-panel.modal>

<form data-panel-envio action="{{url('auditorias/validar')}}/{{$auditoria_id}}/edit" method="get" id="form_procesos_agenda">
    <input type="text" name="data" id="data_procesos_agenda" hidden>
</form>

<script>
    $(document).ready(function () {
        $("#modal_procesos_agenda").modal("show");

        $('.guardar_procesos').click(function () {
            var agregar = [];
            $('#modal_procesos_agenda .existentes:checkbox:checked').each(function () {
                agregar.push($(this).data('id'));
            });
            if (agregar.length > 0) {
                $('#data_procesos_agenda').val(JSON.stringify(agregar));
                $('#form_procesos_agenda').submit();
            } else {
                PanelFormularios.alerta('warning', 'Revisa la selección', 'Selecciona al menos un proceso.');
            }
        });
    });
</script>
