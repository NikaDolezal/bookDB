<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seznam knih</title>
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

$post_empty = false;
$query = '';

if(isset($_POST['isbn']) && !($_POST['isbn'] === '')){
    $query = "SELECT * FROM knihy WHERE isbn = '".$_POST['isbn']."'";    
}

if(isset($_POST['isbn']) && !($_POST['jmeno_autora'] === '')){
    $query = "SELECT * FROM knihy WHERE jmeno_autora = '".$_POST['jmeno_autora']."'";  
}

if(isset($_POST['prijmeni_autora']) && !($_POST['prijmeni_autora'] === '')){
    if($query === ''){
        $query = "SELECT * FROM knihy WHERE prijmeni_autora = '".$_POST['prijmeni_autora']."'";  
        
    } else {
        $query = $query." AND prijmeni_autora = '".$_POST['prijmeni_autora']."'";

    }
}

if(isset($_POST['nazev']) && !($_POST['nazev'] === '')){ 
    if($query === ''){
        $query = "SELECT * FROM knihy WHERE nazev = '".$_POST['nazev']."'";   
    } else {
        $query = $query." AND nazev = '".$_POST['nazev']."'";       
    } 
}
    
if($query === ''){
    $query = "SELECT * FROM knihy";
    $post_empty = true;
}

if (!($vysledek = mysqli_query($con, $query)))
{
  die("Nelze provést dotaz.</body></html>");
}

echo "<h1>Seznam knih</h1>";
if(mysqli_num_rows($vysledek) == 0){
    if($post_empty){
        echo "Žádné záznamy, prosím začněte vložením pomocí tlačítka.";
    } else {
    echo "Hledání neodpovídají žádné výsledky.";
    }
} else {
echo "<table border='1'>";
echo "<thead><th>ISBN</th><th>Jméno autora</th><th>Příjmení autora</th><th>Název</th><th>Popis</th></thead>";
while ($radek = mysqli_fetch_array($vysledek))
{
    echo "<tr><td>".htmlspecialchars($radek["isbn"])."</td><td>".htmlspecialchars($radek["jmeno_autora"])."</td><td>".htmlspecialchars($radek["prijmeni_autora"])."</td><td>".htmlspecialchars($radek["nazev"])."</td><td>".htmlspecialchars($radek["popis"])."</td></tr>";   
}
echo "</table>";
}
mysqli_free_result($vysledek);
mysqli_close($con);

    ?>
    <form action="zkouska_vlozit.php" method="POST">
        <button type="submit">Přidat</button>
    </form>
<hr />
<h3>Vyhledávání</h3>
<form method="POST" action="zkouska.php">
    ISBN:
	<input name="isbn" type="text" ><br>
    Jméno autora:
	<input name="jmeno_autora" type="text" ><br>
    Příjmení autora:
	<input name="prijmeni_autora" type="text" ><br>
	Název:
	<input name="nazev" type="text" ><br>	
	<button type="submit">Vyhledat</button>
</form>
<form action="zkouska.php" method="GET">
	<button type="submit">Zrušit</button>
</form>
</body>
</html>