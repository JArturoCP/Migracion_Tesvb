<form  id="form_autorizar_semestre" action="{{url("/servicios_escolares/guardar_autorizar_semestre_al/".$id_semestres_al)}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">

            <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Seguro(a) que quieres autorizar el semestre y periodo que el estudiante ingreso al TESVB?</h3>
        </div>

    </div>
</form>