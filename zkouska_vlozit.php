<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vložit novou knihu</title>
</head>
<body>
    <form method="POST" action="zkouska_vlozit_zprac.php">
    ISBN:
	<input name="isbn" type="text" ><br>
    Jméno autora:
	<input name="jmeno_autora" type="text" ><br>
    Příjmení autora:
	<input name="prijmeni_autora" type="text" ><br>
	Název:
	<input name="nazev" type="text" ><br>	
	Popis:
	<textarea name="popis"></textarea>
    <button type="sumit">Vložit</button>
    </form>
</body>
</html>