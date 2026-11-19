<?php $__env->startSection('title', 'Constancias'); ?>
<?php echo $__env->make('partials.panel.recursos_app', ['datatables' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->startSection('content'); ?>

<main class="tw-pantalla tw:space-y-6">
    <?php if (isset($component)) { $__componentOriginalf4d7e85a0a3a054d4f2beedd2e03fcde = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4d7e85a0a3a054d4f2beedd2e03fcde = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel.encabezado','data' => ['titulo' => 'LIBERACIÓN DE ACTIVIDADES']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel.encabezado'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['titulo' => 'LIBERACIÓN DE ACTIVIDADES']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4d7e85a0a3a054d4f2beedd2e03fcde)): ?>
<?php $attributes = $__attributesOriginalf4d7e85a0a3a054d4f2beedd2e03fcde; ?>
<?php unset($__attributesOriginalf4d7e85a0a3a054d4f2beedd2e03fcde); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4d7e85a0a3a054d4f2beedd2e03fcde)): ?>
<?php $component = $__componentOriginalf4d7e85a0a3a054d4f2beedd2e03fcde; ?>
<?php unset($__componentOriginalf4d7e85a0a3a054d4f2beedd2e03fcde); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal3255a8d0c3c62b708f3e6e630347ab9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3255a8d0c3c62b708f3e6e630347ab9a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel.tarjeta','data' => ['sinRelleno' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel.tarjeta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sin-relleno' => true]); ?>
        <!-- Nav tabs -->
        <div class="tw:border-b tw:border-gray-200 tw:px-6 tw:pt-4 tw:dark:border-gray-800">
            <ul class="nav nav-tabs tw:flex tw:gap-2 tw:border-0" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tres" aria-controls="home" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-brand-500 tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-brand-600 tw:dark:text-brand-400">No Liberados</a>
                </li>
                <li role="presentation">
                    <a href="#cuatro" aria-controls="cuatro" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-transparent tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-gray-500 tw:hover:text-gray-700 tw:dark:text-gray-400">Aprobados</a>
                </li>
                <li role="presentation">
                    <a href="#dos" aria-controls="dos" role="tab" data-toggle="tab" class="tw:inline-block tw:rounded-t-lg tw:border-b-2 tw:border-transparent tw:px-4 tw:py-2 tw:text-sm tw:font-medium tw:text-gray-500 tw:hover:text-gray-700 tw:dark:text-gray-400">No Aprobados</a>
                </li>  
            </ul>
        </div>

        <div class="tab-content tw:p-6">
            <div role="tabpanel" class="tab-pane active" id="tres">
                <div class="tw:mb-4 tw:flex tw:items-center tw:justify-between">
                    <div class="tw:flex tw:items-center tw:gap-2">
                        <label for="checktodos" class="tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Seleccionar Todos</label>
                        <input type="checkbox" id="checktodos" class="tw:size-4 tw:rounded tw:border-gray-300 tw:text-brand-600 tw:focus:ring-brand-500">
                    </div>
                    <div>
                        <?php if (isset($component)) { $__componentOriginal36b2bad95f9363016b8780561c4fb6dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36b2bad95f9363016b8780561c4fb6dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel.boton','data' => ['tipo' => 'primario','tamano' => 'sm','id' => 'insertar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel.boton'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tipo' => 'primario','tamano' => 'sm','id' => 'insertar']); ?>
                            <span class="fa fa-check" aria-hidden="true"></span> Liberar Seleccionados
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36b2bad95f9363016b8780561c4fb6dc)): ?>
<?php $attributes = $__attributesOriginal36b2bad95f9363016b8780561c4fb6dc; ?>
<?php unset($__attributesOriginal36b2bad95f9363016b8780561c4fb6dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36b2bad95f9363016b8780561c4fb6dc)): ?>
<?php $component = $__componentOriginal36b2bad95f9363016b8780561c4fb6dc; ?>
<?php unset($__componentOriginal36b2bad95f9363016b8780561c4fb6dc); ?>
<?php endif; ?>
                    </div>
                </div>

                <?php if (isset($component)) { $__componentOriginal767d3fd32d0433821053633a522e34fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal767d3fd32d0433821053633a522e34fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel.tabla','data' => ['id' => 'paginacion']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel.tabla'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'paginacion']); ?>
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Semestre</th>
                            <th>Grupo</th>
                            <th>Actividad</th>
                            <th>Docente</th>
                            <th>Créditos</th>
                            <th>Promedio</th>
                            <th class="tw:text-center">Liberación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $liberacion_evaluacion_si; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $liberacion_evaluacion_si): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($liberacion_evaluacion_si->cuenta); ?></td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90"><?php echo e($liberacion_evaluacion_si->nombre); ?> <?php echo e($liberacion_evaluacion_si->apaterno); ?> <?php echo e($liberacion_evaluacion_si->amaterno); ?></td>
                            <td><?php echo e($liberacion_evaluacion_si->semestre); ?></td>
                            <td><?php echo e($liberacion_evaluacion_si->grupo); ?></td>
                            <td><?php echo e($liberacion_evaluacion_si->descripcion); ?></td>
                            <td><?php echo e($liberacion_evaluacion_si->titulo); ?> <?php echo e($liberacion_evaluacion_si->docente); ?></td>
                            <td><?php echo e($liberacion_evaluacion_si->creditos); ?></td>
                            <td><?php echo e($liberacion_evaluacion_si->promedio); ?></td>
                            <td class="tw:text-center">  
                                <input class="checkbox tw:size-4 tw:rounded tw:border-gray-300 tw:text-brand-600 tw:focus:ring-brand-500" name="orderbox[]" type="checkbox" value="1" id="liberacion_jefe" data-cuenta="<?php echo e($liberacion_evaluacion_si->id_registro_alumno); ?>">
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal767d3fd32d0433821053633a522e34fc)): ?>
<?php $attributes = $__attributesOriginal767d3fd32d0433821053633a522e34fc; ?>
<?php unset($__attributesOriginal767d3fd32d0433821053633a522e34fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal767d3fd32d0433821053633a522e34fc)): ?>
<?php $component = $__componentOriginal767d3fd32d0433821053633a522e34fc; ?>
<?php unset($__componentOriginal767d3fd32d0433821053633a522e34fc); ?>
<?php endif; ?>      
            </div>

            <div role="tabpanel" class="tab-pane" id="cuatro">
                <div class="tw:mb-4 tw:flex tw:justify-end">
                    <?php if (isset($component)) { $__componentOriginal36b2bad95f9363016b8780561c4fb6dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36b2bad95f9363016b8780561c4fb6dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel.boton','data' => ['href' => ''.e(url('/constancias_todas')).'','target' => '_blank','tamano' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel.boton'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(url('/constancias_todas')).'','target' => '_blank','tamano' => 'sm']); ?>
                        <span class="fa fa-print" aria-hidden="true"></span> Imprimir Todo
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36b2bad95f9363016b8780561c4fb6dc)): ?>
<?php $attributes = $__attributesOriginal36b2bad95f9363016b8780561c4fb6dc; ?>
<?php unset($__attributesOriginal36b2bad95f9363016b8780561c4fb6dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36b2bad95f9363016b8780561c4fb6dc)): ?>
<?php $component = $__componentOriginal36b2bad95f9363016b8780561c4fb6dc; ?>
<?php unset($__componentOriginal36b2bad95f9363016b8780561c4fb6dc); ?>
<?php endif; ?>
                </div>

                <?php if (isset($component)) { $__componentOriginal767d3fd32d0433821053633a522e34fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal767d3fd32d0433821053633a522e34fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel.tabla','data' => ['id' => 'pagi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel.tabla'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'pagi']); ?>
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Semestre</th>
                            <th>Grupo</th>
                            <th>Actividad</th>
                            <th>Docente</th>
                            <th>Créditos</th>
                            <th>Promedio</th>
                            <th class="tw:text-center">Imprimir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $liberacion_evaluacion_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $liberacion_evaluacion_no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($liberacion_evaluacion_no->promedio>=70): ?>
                        <tr>
                            <td><?php echo e($liberacion_evaluacion_no->cuenta); ?></td>
                            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90"><?php echo e($liberacion_evaluacion_no->nombre); ?> <?php echo e($liberacion_evaluacion_no->apaterno); ?> <?php echo e($liberacion_evaluacion_no->amaterno); ?></td>
                            <td><?php echo e($liberacion_evaluacion_no->semestre); ?></td>
                            <td><?php echo e($liberacion_evaluacion_no->grupo); ?></td>
                            <td><?php echo e($liberacion_evaluacion_no->descripcion); ?></td>
                            <td><?php echo e($liberacion_evaluacion_no->titulo); ?> <?php echo e($liberacion_evaluacion_no->docente); ?></td>
                            <td><?php echo e($liberacion_evaluacion_no->creditos); ?></td>
                            <td><?php echo e($liberacion_evaluacion_no->promedio); ?></td>
                            <td class="tw:text-center">
                                <?php if($liberacion_evaluacion_no->estado==1): ?>
                                    <a href="<?php echo e(url("/Constancia/".$liberacion_evaluacion_no->id_registro_alumno."/edit")); ?>" target="_blank" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Imprimir constancia">
                                        <span class="fa fa-print em" aria-hidden="true"></span>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal767d3fd32d0433821053633a522e34fc)): ?>
<?php $attributes = $__attributesOriginal767d3fd32d0433821053633a522e34fc; ?>
<?php unset($__attributesOriginal767d3fd32d0433821053633a522e34fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal767d3fd32d0433821053633a522e34fc)): ?>
<?php $component = $__componentOriginal767d3fd32d0433821053633a522e34fc; ?>
<?php unset($__componentOriginal767d3fd32d0433821053633a522e34fc); ?>
<?php endif; ?>
            </div>

            <div role="tabpanel" class="tab-pane" id="dos">
                <?php if (isset($component)) { $__componentOriginal767d3fd32d0433821053633a522e34fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal767d3fd32d0433821053633a522e34fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.panel.tabla','data' => ['id' => 'pag']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('panel.tabla'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'pag']); ?>
                    <thead>
                        <tr>
                            <th>Cuenta</th>
                            <th>Alumno</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Actividad</th>
                            <th>Docente</th>
                            <th>Créditos</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $promedio_cero; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promedio_cero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($promedio_cero->promedio < 70): ?>
                            <tr>
                                <td><?php echo e($promedio_cero->cuenta); ?></td>
                                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90"><?php echo e($promedio_cero->nombre); ?> <?php echo e($promedio_cero->apaterno); ?> <?php echo e($promedio_cero->amaterno); ?></td>
                                <td><?php echo e($promedio_cero->semestre); ?></td>
                                <td><?php echo e($promedio_cero->grupo); ?></td>
                                <td><?php echo e($promedio_cero->descripcion); ?></td>
                                <td><?php echo e($promedio_cero->titulo); ?> <?php echo e($promedio_cero->docente); ?></td>
                                <td><?php echo e($promedio_cero->creditos); ?></td>
                                <td><?php echo e($promedio_cero->promedio); ?></td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal767d3fd32d0433821053633a522e34fc)): ?>
<?php $attributes = $__attributesOriginal767d3fd32d0433821053633a522e34fc; ?>
<?php unset($__attributesOriginal767d3fd32d0433821053633a522e34fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal767d3fd32d0433821053633a522e34fc)): ?>
<?php $component = $__componentOriginal767d3fd32d0433821053633a522e34fc; ?>
<?php unset($__componentOriginal767d3fd32d0433821053633a522e34fc); ?>
<?php endif; ?>    
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3255a8d0c3c62b708f3e6e630347ab9a)): ?>
<?php $attributes = $__attributesOriginal3255a8d0c3c62b708f3e6e630347ab9a; ?>
<?php unset($__attributesOriginal3255a8d0c3c62b708f3e6e630347ab9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3255a8d0c3c62b708f3e6e630347ab9a)): ?>
<?php $component = $__componentOriginal3255a8d0c3c62b708f3e6e630347ab9a; ?>
<?php unset($__componentOriginal3255a8d0c3c62b708f3e6e630347ab9a); ?>
<?php endif; ?>

<?php
  $direccion=Session::get('ip');
?>

<div id="mensaje_actividad" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-warning">
        <p style="font-weight: bold; color:#BA0000; text-align:center;">NO HAS SELECCIONADO DATOS A IMPRIMIR</p>
      </div>
    </div>
  </div>
</div>

</main>

<script>
$(document).ready(function(){
    var direccion="<?php echo e($direccion); ?>";

    $("#checktodos").change(function(){
        $('input[name="orderbox[]"]').prop('checked',$(this).prop("checked"));
    });

    $("#checktodoss").change(function(){
        $('input[name="orderboxx[]"]').prop('checked',$(this).prop("checked"));
    });

    $('#insertar').click(function(){
        var checkboxValues=[];
        var cuenta=[];

        $('input[name="orderbox[]"]:checked').each(function(){
            checkboxValues[checkboxValues.length]=$(this).val();
            cuenta[cuenta.length]=$(this).data('cuenta'); 
        });
            
        var $marcados=$('input[name="orderbox[]"]:checked');
        var numero=$marcados.length;
        if(numero==0)
        {
            $('#mensaje_actividad').modal('show');
            setTimeout(myFunction, 2000); 

            function myFunction(){
                $('#mensaje_actividad').modal('hide');
            }
        }
        else
        {
            var suma=numero+numero;
            var arreglo=[];
            var j=0;
            for(var i=0;i<numero;i++){
                arreglo[i]=checkboxValues[i];
            }
            for(var e=numero;e<suma;e++){
                arreglo[e]=cuenta[j];
                j++;
            }
            window.location.href=direccion+"/constancias_si/"+arreglo;
        }
    });

    $('#paginacion').DataTable();
    $('#pag').DataTable();  
    $('#pagi').DataTable();    
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>