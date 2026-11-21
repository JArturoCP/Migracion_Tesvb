<label for="fin">Hora de termino</label>
<div class="tw:flex tw:w-full tw:items-stretch">
    <select name="fin" id="fin" class="fin tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
        <option value="" selected disabled="true">Selecciona...</option>
        @foreach($horario as $hora)
            <option value="{{$hora}}">{{$hora}}</option>
        @endforeach
    </select>
    <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i class="fa fa-clock-o"></i></span>
</div>
