
    <table id="paginar_table" class="table table-bordered">
                          <thead>
                            <tr>
                                <th>No.</th>
                                <th style="width: 400px;">Grado</th>
                                <th style="width: 400px;">Nombre Completo</th>
                                <th style="width: 100px;">Cédula</th>
                                <th style="width: 400px;">Materias</th>
                                <th>Unidades</th>
                                <th>Grupo</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $contador=1;  ?>
                            @foreach($relacion as $rel)
                            <tr>
                              <td>{{ $contador }}</td>
                              <td style="width: 400px;">{{$rel->descripcion}}</td>
                              <td style="width: 400px;">{{$rel->nombre}}</td>
                              <td style="width: 100px;">{{$rel->cedula}}</td>
                              <td style="width: 400px;">{{$rel->materia}}</td>
                              <td>{{$rel->unidades}}</td>
                              <td>{{$rel->grupo}}</td>
                              <?php $contador++; ?>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>  

