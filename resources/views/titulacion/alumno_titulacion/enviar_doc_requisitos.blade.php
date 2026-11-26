
<template v-if="veri_constancia_ingles == 1"> {{--alumnos de no. cuenta menor 2010--}}
    <template v-if="docu.evi_acta_nac   == 1 && docu.evi_curp   == 1 &&
 docu.evi_certificado_prep   == 1 && docu.evi_certificado_tesvb   == 1 &&
docu.evi_constancia_ss   == 1 && docu.evi_certificado_acred_ingles   == 1 && docu.evi_acta_residencia   == 1 &&
docu.evi_opcion_titulacion   > 0 && docu.evi_pago_titulo   == 1 && docu.evi_pago_contancia   == 1
&& docu.evi_pago_derecho_ti   == 1 && docu.evi_pago_integrante_jurado   == 1">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">

                    <button  class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModalenviar();" >Enviar Documentación</button>


            </div>
        </div>
    </template>

</template>
<template v-if="veri_constancia_ingles == 2">

    <template v-if="veri_egel == 0">
        <template v-if="docu.evi_acta_nac   == 1 && docu.evi_curp   == 1 &&
 docu.evi_certificado_prep   == 1 && docu.evi_certificado_tesvb   == 1 &&
docu.evi_constancia_ss   == 1 && docu.evi_opcion_titulacion   > 0
&& docu.evi_pago_titulo   == 1 && docu.evi_pago_contancia   == 1
&& docu.evi_pago_derecho_ti   == 1 && docu.evi_pago_integrante_jurado   == 1 && docu.evi_pago_concepto_autenticacion    == 1 && ingles.estado_cert == 2">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">

                    <button  class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModalenviar();" >Enviar Documentación</button>


                </div>
            </div>
        </template>
    </template>
    <template v-if="veri_egel == 1">

        <template v-if="docu.evi_acta_nac   == 1 && docu.evi_curp   == 1 &&
 docu.evi_certificado_prep   == 1 && docu.evi_certificado_tesvb   == 1 &&
docu.evi_constancia_ss   == 1 && docu.evi_opcion_titulacion   > 0 && docu.evi_reporte_result_egel == 1
&& docu.evi_pago_titulo   == 1 && docu.evi_pago_contancia   == 1
&& docu.evi_pago_derecho_ti   == 1 && docu.evi_pago_integrante_jurado   == 1 && docu.evi_pago_concepto_autenticacion    == 1 && ingles.estado_cert == 2">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">

                    <button  class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" v-on:click="abrirModalenviar();" >Enviar Documentación</button>


                </div>
            </div>
        </template>
    </template>
</template>




