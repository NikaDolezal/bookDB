<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load audiobooks from file</title>
</head>
<body>
    <?php
    echo "Hello world! <br>";
    $file = fopen("audiobooks_list.txt", "r");

//parse lines until EOF
while(! feof($file)) {
  $line = fgets($file);
  if ( str_starts_with( $line, "Location" ) ){
    // sscanf($line, "");
  }
  
  if ( !( str_starts_with( $line, "* " ) ) ){
    //'* ' is only present in lines that contain an entry, rest is printed as-is
    echo $line."<br>";
    } else {
    //testing sscanf()
    $auth_name = '';
    $auth_surname = '';
    $title = '';
    $notes = '';
    $pattern = "* %[^,], %[^:]: %[^>]> %[0-9A-Za-z/ -]+";
    sscanf($line, $pattern, $auth_surname, $auth_name, $title, $notes);
    if($notes === ''){
    echo "author surname: ".$auth_surname." author name: ".$auth_name.", book title: ".trim($title).". Notes: ".$notes."<br />";
    } else {
    echo "author surname: ".$auth_surname." author name: ".$auth_name.", book title: ".trim($title, " -").". Notes: ".$notes."<br />";

    }
  }
}

fclose($file);
    ?>
</body>
</html>