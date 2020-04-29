<link rel="stylesheet" type="text/css" href="style/css/main.css">
<div class="row">
	<form method="POST" class="col-12">
		<?php 
		$etape1 = 'd-block';
		if($etape1 == 'd-block') { ?>
			<div class="form-group">
				<button type="submit" name="gestionnaire" class="btn btn-success w-100">Ajouter un gestionnaire</button>
			</div>
			<div class="form-group">
				<button type="submit" name="professeur"  class="btn btn-success w-100">Ajouter un professeur</button>
			</div>
			<div class="form-group">
				<button type="submit" name="etudiant"  class="btn btn-success w-100">Ajouter un étudiant</button>
			</div>
		<?php
		}
		if(isset($_POST)) { $etape1 == 'kd'; }
		?>
	</form>
</div>