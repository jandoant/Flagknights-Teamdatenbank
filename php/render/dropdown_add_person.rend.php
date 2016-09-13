<?php
  while ($datensatz = mysqli_fetch_assoc($result_rollen)) {
  echo "<option value='".$datensatz['rolle_id']."'>".$datensatz['rollenname']."</option>";
}
?>
