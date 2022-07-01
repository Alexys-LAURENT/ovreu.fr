<br>
<br>
<div class="insertion">
<h2>INSERTION D'UNE REUNION</h2>
<hr> <br>
<form method="post" action="">
      <h3>Date de la réunion </h3>
      <input type="date" name="datereunion">
 
      <h3>Heure : </h3>
      <input type="time" name="heure">
    
    
      <h3>Description : </h3>
      <input type="text" name="libelle">
    
   
      <h3>Salarié : </h3>
      <select name="idsalarie">
					<?php
						$lesClients = $unControleur->selectAllClients();
						foreach ($lesClients as $unClient) {
							echo "<option value ='".$unClient['idsalarie']."'>";
							echo $unClient['idsalarie']." - ".$unClient['nom']."-".$unClient['prenom'];
							echo "</option>";
						}
					?>
				</select>
   
    
      <input type="reset" name="Annuler" value="Annuler" class="Annuler">
      <input type="submit" name="Valider" value="Valider" class="Valider">
    
  
</form>
</div>
