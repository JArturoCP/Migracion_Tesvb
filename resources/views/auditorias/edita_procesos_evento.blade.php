{{-- Modal para editar procesos del evento: lo incluye auditorias/edit_evento cuando $ver == 'procesos_evento'. --}}
@php($procesosMarcados = \Illuminate\Support\Facades\Session::get('procesos-evento') ?: [])
<x-panel.modal id="modal_procesos_evento" tamano="lg" clase-cerrar="close" titulo="Editar procesos del evento">
    <div class="tw:grid tw:gap-3 tw:sm:grid-cols-2">
        @foreach($procesos as $proceso)
            <x-panel.checkbox class="existentes" data-id="{{$proceso->id_auditoria_proceso}}" :checked="in_array($proceso->id_auditoria_proceso, $procesosMarcados)">{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</x-panel.checkbox>
        @endforeach
    </div>
    <x-slot:pie>
        <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
        <x-panel.boton variante="exito" class="guardar_procesos">
            <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar
        </x-panel.boton>
    </x-slot:pie>
</x-panel.modal>

<form data-panel-envio action="{{url('auditorias/evento')}}/{{$id}}" method="POST" id="form_procesos_evento">
    @csrf
    @method('PUT')
    <input type="text" name="data" id="data_procesos_evento" hidden>
</form>

<script>
    $(document).ready(function () {
        $("#modal_procesos_evento").modal("show");

        $('.guardar_procesos').click(function () {
            var agregar = [];
            $('#modal_procesos_evento .existentes:checkbox:checked').each(function () {
                agregar.push($(this).data('id'));
            });
            if (agregar.length > 0) {
                $('#data_procesos_evento').val(JSON.stringify(agregar));
                $('#form_procesos_evento').submit();
            } else {
                PanelFormularios.alerta('warning', 'Revisa la selección', 'Selecciona al menos un proceso.');
            }
        });
    });
</script>
