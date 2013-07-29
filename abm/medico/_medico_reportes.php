<?php

$db = conectaDb();
$consulta = "select * from medico";
$result = $db->query($consulta);
?>
<legend>Turnos por médico</legend>
        <label>Fecha inicio</label>
        <input class="fecha" type="date" tabindex="1" class="input-large" id="fechaInic" name="fechaInic">           
        <br><br>
        <label>Fecha fin</label>
        <input class="fecha" type="date" tabindex="2" class="input-large" id="fechaFin" name="fechaFin" onkeypress="return justFecha(event);">
        <br><br>
<form class="form-horizontal" name="form1" action="./medico/_medico_imprimir_reportes.php" method="GET" target="_blank">
    <div class="control-group">
        <div id="manzana">
            <div id="banana">
                <table id="tabla1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Elegir</th>
                            <th>Médico</th>
                            <th>Cantidad de turnos</th>
                            <th>% de turnos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $valor): ?>
                            <?php
                            $con = 'select * from medico inner join turno on (medico.idmedico = turno.id_med) where idmedico = ' . $valor['idmedico'] . '';
                            $result2 = $db->query($con);
                            $cant = $result2->rowCount();

                            $conAux = 'select * from turno';
                            $resultAux = $db->query($conAux);
                            $cantAux = $resultAux->rowCount();
                            if ($cantAux > 0)
                                $porcentaje = ($cant * 100) / $cantAux;
                            else
                                $porcentaje = ($cant * 100) / 1;
                            $porcentaje = round($porcentaje * 100) / 100; //esto es para redondear a 2 decimales

                            $medico = $valor['nombre'] . ' ' . $valor['apellido'];
                            ?>
                            <tr>
                                <td><input type="checkbox" name="<?php echo $valor['idmedico'] ?>" value="<?php echo $valor['idmedico'] ?>" id="<?php echo $valor['idmedico'] ?>"></td>
                                <td><?php echo $medico ?></td>
                                <td><?php echo $cant ?></td>
                                <td><?php echo $porcentaje ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>    
                </table>
            </div>
        </div>
    </div>
    <br>
    <a href="javascript:seleccionar_todo1()">Marcar todos</a> |
    <a href="javascript:deseleccionar_todo1()">Desmarcar todos</a> 
    <input type="hidden" name="code" value="1"/>
    <button type="submit" class="btn btn-success offset1">Imprimir</button>
</form>

<script>

            function seleccionar_todo1() {
                for (i = 0; i < document.form1.elements.length; i++)
                    if (document.form1.elements[i].type == "checkbox")
                        document.form1.elements[i].checked = 1
            }

            function deseleccionar_todo1() {
                for (i = 0; i < document.form1.elements.length; i++)
                    if (document.form1.elements[i].type == "checkbox")
                        document.form1.elements[i].checked = 0
            }

            $().ready(function() {

                $('.fecha').change(function() {
                    $.ajax({
                        url: 'medico/obtener_turnos_por_cambio_fecha.php',
                        type: 'POST',
                        data: {
                            fechaInic: $('#fechaInic').val(),
                            fechaFin: $('#fechaFin').val()
                        },
                        success: function(data) {

                            $('#banana').remove();
                            $('#manzana').append(data);
                        }
                    });
                });
            });

</script>


<?php $result = $db->query($consulta); ?>

<legend>Turnos cancelados</legend>
<form class="form-horizontal" name="form2" action="./medico/_medico_imprimir_reportes.php" method="GET" target="_blank">
    <div class="control-group">
        <label>Fecha inicio</label>
        <input class="fecha1" type="date" tabindex="1" class="input-large" id="fechaInic1" name="fechaInic1">           
        <br><br>
        <label>Fecha fin</label>
        <input class="fecha1" type="date" tabindex="2" class="input-large" id="fechaFin1" name="fechaFin1">
        <br><br>
        <div id="manzana1">
            <div id="banana1">
                <table id="tabla2" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Elegir</th>
                            <th>Médico</th>
                            <th>Turnos cancelados</th>
                            <th>% de turnos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $valor): ?>
                            <?php
                            $con = 'select * from medico inner join turno on (medico.idmedico = turno.id_med) where idmedico = ' . $valor['idmedico'] . ' and estado = "cancelado"';
                            $result2 = $db->query($con);
                            $cant = $result2->rowCount();

                            $conAux = 'select * from medico inner join turno on (medico.idmedico = turno.id_med) where idmedico = ' . $valor['idmedico'] . '';
                            $resultAux = $db->query($conAux);
                            $cantAux = $resultAux->rowCount();
                            if ($cantAux > 0)
                                $porcentaje = ($cant * 100) / $cantAux;
                            else
                                $porcentaje = ($cant * 100) / 1;
                            $porcentaje = round($porcentaje * 100) / 100; //esto es para redondear a 2 decimales

                            $medico = $valor['nombre'] . ' ' . $valor['apellido'];
                            ?>
                            <tr>
                                <td><input type="checkbox" name="' . $valor['idmedico'] . '" value="' . $valor['idmedico'] . '" id="' . $valor['idmedico'] . '"></td>
                                <td><?php echo $medico ?></td>
                                <td><?php echo $cant ?></td>
                                <td><?php echo $porcentaje ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>    
                </table>
            </div>
        </div>
    </div>
    <br>
    <a href="javascript:seleccionar_todo2()">Marcar todos</a> | 
    <a href="javascript:deseleccionar_todo2()">Desmarcar todos</a>
    <input type="hidden" name="code2" value="2"/>
    <button type="submit" class="btn btn-success offset1">Imprimir</button>
</form>

<script>

    function seleccionar_todo2() {
                for (i = 0; i < document.form2.elements.length; i++)
                    if (document.form2.elements[i].type == "checkbox")
                        document.form2.elements[i].checked = 1
            }

            function deseleccionar_todo2() {
                for (i = 0; i < document.form2.elements.length; i++)
                    if (document.form2.elements[i].type == "checkbox")
                        document.form2.elements[i].checked = 0
            }

    $().ready(function() {

        $('.fecha1').change(function() {
            $.ajax({
                url: 'medico/obtener_turnos_cancelados.php',
                type: 'POST',
                data: {
                    fechaInic: $('#fechaInic1').val(),
                    fechaFin: $('#fechaFin1').val()
                },
                success: function(data) {
                    $('#banana1').remove();
                    $('#manzana1').append(data);
                }
            });
        });
    });

</script>



<?php
$conhorarios = "select nombre, apellido, dia, min(desde) desde, max(hasta) hasta, id_med from horario inner join medico on (horario.id_med = medico.idmedico) group by id_med, dia";
$result2 = $db->query($conhorarios);
;
?>

<legend>Medicos por banda horaria</legend>
<form class="form-horizontal" name="form3" action="./medico/_medico_imprimir_reportes.php" method="GET" target="_blank">
    <div class="control-group">
        <label>Horario inicio</label>
        <select class="hora" name="horario1" id="horario1" onchange="return verifHorario();">
            <option selected="selected">Elija un horario</option>
            <?php
            for ($i = 8; $i < 20; $i++) {
                echo "<option value=\"$i:00:00\">$i:00</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Horario fin</label>
        <select class="hora" name="horario2" id="horario2" onchange="return verifHorario();">
            <option selected="selected">Elija un horario</option>
            <?php
            for ($i = 8; $i < 20; $i++) {
                echo "<option value=\"$i:00:00\">$i:00</option>";
            }
            ?>


        </select>
        <br><br>
        <div id="manzana2">
            <div id="banana2">
                <table id="tabla3" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Elegir</th>
                            <th>Médico</th>
                            <th>día</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result2 as $valor2): ?> 
                            <?php $medico = $valor2['nombre'] . ' ' . $valor2['apellido']; ?>
                            <tr>
                                <td><input type="checkbox" name="' . $valor['idmedico'] . '" value="' . $valor['idmedico'] . '" id="' . $valor['idmedico'] . '"></td>
                                <td><?php echo $medico ?></td>
                                <td><?php echo $valor2['dia'] ?></td>    
                                <td><?php echo $valor2['desde'] ?></td>
                                <td><?php echo $valor2['hasta'] ?></td>    
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <a href="javascript:seleccionar_todo3()">Marcar todos</a> | 
    <a href="javascript:deseleccionar_todo3()">Desmarcar todos</a> 
    <input type="hidden" name="code" value="3"/>
    <button type="submit" class="btn btn-success offset1">Imprimir</button>
</form>

<script>

    function seleccionar_todo3() {
                for (i = 0; i < document.form3.elements.length; i++)
                    if (document.form3.elements[i].type == "checkbox")
                        document.form3.elements[i].checked = 1
            }

            function deseleccionar_todo3() {
                for (i = 0; i < document.form3.elements.length; i++)
                    if (document.form3.elements[i].type == "checkbox")
                        document.form3.elements[i].checked = 0
            }

    function verifHorario() {
        var horario1 = $('#horario1').val();
        var horario2 = $('#horario2').val();
        var a = horario1.split(':');   //separa el tring del horario hh:mm:ss por el caracter ":"
        var b = horario2.split(':');//separa el tring del horario hh:mm:ss por el caracter ":"
        var hr1 = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); //pasa el hroario a segundos
        var hr2 = (+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2]); //pasa el hroario a segundos
        if ((hr1 != null) || (hr2 != null)) {
            if (hr2 < hr1) {
                alert('ERROR. intervalos incorrectos');
                return false;
            }
        }
    }

    $().ready(function() {
        $('.hora').change(function() {
            $.ajax({
                url: 'medico/obtener_medicos_por_banda_horaria.php',
                type: 'POST',
                data: {
                    hora1: $('#horario1').val(),
                    hora2: $('#horario2').val()
                },
                success: function(data) {
                    $('#banana2').remove();
                    $('#manzana2').append(data);
                }
            });
        });
    });



</script>