<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-2/12 tw:lg:ml-[41.6667%] tw:px-2">


            <template v-if="status_doc == 1">
                    <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base tw:flex tw:w-full" v-on:click="abrirModalAutorizar_doc(encargados);" >Autorizar Documentación</button>

                </template>
        <template v-if="status_doc == 3">
                    <button  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base tw:flex tw:w-full" v-on:click="abrirModalenviar_correcciones(encargados);" >Enviar correcciones</button>
        </template>



        <p><br/></p>
    </div>
</div>