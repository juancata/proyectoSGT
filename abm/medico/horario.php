<div id="horario_div_<?php echo $_POST['numeroHorario']; ?>" class="nuevoHorario">
  <legend><button onClick="borrarHorario(<?php echo $_POST['numeroHorario']; ?>); return false;return false;"><i class="icon-remove"></i></button>Horario numero <?php echo $_POST['numeroHorario']; ?></legend>
  <fieldset>
      <?php $n = $_POST['numeroHorario']?>
    <label>Día</label>
    <select class="span5" name="horario[<?php echo $_POST['numeroHorario']; ?>][dia]" onchange="propio('horario_div_<?php echo $_POST['numeroHorario']; ?>');" id="dia<?php echo $n;?>" >
      <option selected="selected">Elija un día</option>
      <option value="lun">Lunes</option>
      <option value="mar">Martes</option>
      <option value="mie">Miércoles</option>
      <option value="jue">Jueves</option>
      <option value="vie">Viernes</option>

    </select>
    
    <label>Desde</label>
    <select class="span5" name="horario[<?php echo $_POST['numeroHorario']; ?>][desde]" onchange="propio('horario_div_<?php echo $_POST['numeroHorario']; ?>');" id="horarios<?php echo $n;?>">
      <option selected="selected">Elija un horario</option>
      <?php
      for ($i = 8; $i < 20; $i++) {
        echo "<option value=\"$i:00:00\">$i:00</option>";
      }
      ?>
    </select>
    
     <label>Hasta</label>
    <select class="span5" name="horario[<?php echo $_POST['numeroHorario']; ?>][hasta]" onchange="propio('horario_div_<?php echo $_POST['numeroHorario']; ?>');" id="horariosHasta<?php echo $n;?>" onchange="verificarHorario(numeroHorario-1)">
      <option selected="selected">Elija un horario</option>
      <?php
      for ($i = 8; $i < 20; $i++) {
        echo "<option value=\"$i:00:00\">$i:00</option>";
      }
      ?>
    </select>
     
  </fieldset>
  <br>
</div>
