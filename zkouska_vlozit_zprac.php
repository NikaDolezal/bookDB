<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vložit novou knihu</title>
</head>
<body>
    <?php
    require './DbConnect.php';

    $db_conn = new DbConnect();
if (!($con = mysqli_connect($db_conn->server,$db_conn->user,$db_conn->pass,$db_conn->dbname)))
{
	die("Nelze se připojit k databázovému serveru!</body></html>");
}
mysqli_query($con,"SET NAMES 'utf8'");
if (mysqli_query($con,
		"INSERT INTO knihy(isbn, jmeno_autora, prijmeni_autora, nazev, popis) VALUES('" .
		addslashes($_POST["isbn"]) . "', '" .
		addslashes($_POST["jmeno_autora"]) . "', '" .
		addslashes($_POST["prijmeni_autora"]) . "', '" .
        addslashes($_POST["nazev"]) . "', '" .
		addslashes($_POST["popis"]) . "')"))
{
	echo "Úspěšně vloženo.";
}
else
{
	echo "Nelze provést dotaz. " . mysqli_error($con);
}
mysqli_close($con);
?>
<form action="zkouska.php" method="GET">
    <button type="submit">Zpet</button>
</form>
</body>
</html>