<?php include_once ("./../../fragmentos/_conectDb.php"); ?>
<script>
    //ESTA ES LA LIÑITA MAGICA
    $(".btn").popover({trigger: "hover"});
</script>
<div id="os_div_<?php echo $_POST['numeroOs']; ?>">
    <legend><button onClick="borrarOs(<?php echo $_POST['numeroOs']; ?>);
         return false;"><i class="icon-remove"></i></button>Obra social numero <?php echo $_POST['numeroOs']; ?>
    </legend>
    <fieldset>
        <?php
        $db = conectaDb();
        $consulta = "SELECT * FROM os where activo = 1";
        $result = $db->query($consulta);
        if (!$result)
            print ("<p>error en la consulta<p>");
        else
            
            ?>
        <select tabindex="12" class="select-xlarge" name="os_select[<?php echo $_POST['numeroOs']; ?>][nombre]" >
            <?php
            foreach ($result as $valor)
                if ($valor['nombre'] == 'Ninguna')
                    echo '<option Selected="Selected">' . $valor['nombre'] . '</option>';
                else
                    echo '<option>' . $valor['nombre'] . '</option>';
            ?>
        </select>
        <button class="btn btn-mini" onclick="return false;" data-original-title="Obra social del médico" data-content="Seleccione el nombre de la lista de obra sociales haciendo click sobre el campo o sobre la flecha hacia abajo y luego sobre el nombre.">
            <i class="icon-question-sign"></i>
        </button>


    </fieldset>
    <br>
</div>
<script>
$('.agregarOs').click(function() {
 alert("esta entrando");

//                        var nombreos;
//                        $(this).parent().parent().find('select').each(function() {
//                            nombreos = ($(this).val());
//                            $.ajax({
//                                url: 'medico/_alta_nueva_os.php',
//                                type: 'post',
//                                data: {
//                                    idmedico: <?php //echo $id;  ?>,
//                                    nombreos: nombreos,
//                                },
//                                success: function(data) {
//                                    var datos = eval('(' + data + ')');
//                                    /* ahora usas datos como si fuera un objeto */
//                                    switch (datos.resultado) {
//                                        case 1:
//                                            alert('Anulación exitosa.');
//                                            break;
//                                        case 2:
//                                            alert('Falla en la anulación.');
//                                            break;
//                                    }
//                                }
//                            });
//                        });
});
</script>