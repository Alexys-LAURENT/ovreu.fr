<br><br>
<table class="affichagereunions">
  <tr class="color2 firstline">
    <td>ㅤNOMㅤ</td>
    <td>ㅤPRÉNOMㅤ</td>
    <td>ㅤLIBELLEㅤ</td>
    <td>ㅤDATEㅤ</td>
    <!--<td>ㅤHEUREㅤ</td> -->
  </tr>
  <?php
  if(isset($lesInterventions)){
    foreach ($lesInterventions as $uneIntervention) {
      echo "<tr>";
      //echo "<td>".$uneIntervention['idreunion']."</td>";
      echo "<td class='contenuetab'>".$uneIntervention['nom']."</td>";
      echo "<td class='contenuetab'>".$uneIntervention['prenom']."</td>";
      echo "<td class='contenuetab'>".$uneIntervention['libelle']."</td>";
      echo "<td class='contenuetab'>".$uneIntervention["date_format(r.datereunion, '%D %b %Y')"]."</td>";
      //echo "<td>".$uneIntervention['heure']."</td>";
      echo "</tr>";
    }
  }
  ?>
</table>
