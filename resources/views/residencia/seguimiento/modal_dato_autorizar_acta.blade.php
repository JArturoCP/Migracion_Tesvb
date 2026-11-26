<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
     <p><b>Número de cuenta:</b> {{ $alumno->cuenta }}</p>
        <p><b>Nombre del estudiante:</b> {{ $alumno->nombre }} {{$alumno->apaterno}} {{$alumno->amaterno}}</p>
        <p><b>Carrera: </b>{{$alumno->carrera}}</p>
        <input type="hidden" id="id_promedio_general" name="id_promedio_general" value="{{$alumno->id_promedio_general}}">
        <p>Autorizar la impresión de acta de residencia</p>
    </div>
</div>
