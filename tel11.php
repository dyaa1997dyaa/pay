<?php

require_once("php/extdirect/classes/Postgres.php");
$driver_pg=new Postgres("localhost","asteriskcdrdb","postgres");


$pais = $_REQUEST['pais'];
if ($pais=='') { $pais='Spain'; }


// Realizando una consulta SQL
$sql = "SELECT distinct split_part(name,'-',1) as name FROM destinations where web order by split_part(name,'-',1) ASC";
$countries = $driver_pg->execute($sql);

$sql = "SELECT distinct name, cost_per_second FROM destinations where web and name like '".$pais."%'";
$tariffs=$driver_pg->execute($sql);
?>
<form>
<table width="95%" border="0" cellspacing="3" cellpadding="3" class="table_green">
  <tr>
    <td width="75"><b>Pa&iacute;s:</b></td>
    <td>
    <select name="pais" id="pais" onchange="this.form.submit();" class="celda_datos">
     <? foreach($countries as $country){?>
        <option <?= ($country["name"]==$pais?"selected":"") ?>  value="<?php echo $country['name']; ?>"><?php echo utf8_decode($country['name']); ?></option>
         <? } ?>
     </select>
     </td>
  </tr>
  <tr>
    <td valign="top"><b>Tarifas:</b></td>
    <td>
      <table width="100%" bgcolor="#FFCC33" cellpading="10" cellspacing="10" class="table_green">
   <? if(is_array($tariffs)){
   foreach($tariffs as $tariff) {?>
     <tr><td><?= utf8_decode($tariff['name']);?></td><td>
        <?=round($tariff['cost_per_second']*60,2)."&nbsp;&euro;/min";?></td></tr>
        <? }
  } ?>
        </table>
     </td>
  </tr>
</table>
</form>
