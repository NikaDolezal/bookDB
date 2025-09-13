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
	//open file
   	$file = fopen("audiobooks_list.txt", "r");

	//initialize block vars
	$location = '';
	$genre = '';

	//set patterns
	$block_pattern = "%s %[0-9A-Za-z/ -]+";
	$line_pattern = "* %[^,], %[^:]: %[^>]> %[0-9A-Za-z/ -]+";

	//parse lines until EOF
	while(! feof($file)) {
		$line = fgets($file);

		//resolve block values - each sits on its own line, once a block value is recognized and saved, the cycle can move on, format does not allow for a book entry to still follow
		if ( str_contains( $line, "Location:" ) ){
			sscanf($line, $block_pattern, $tmp, $location);
			continue;
	 	}
	  	if ( str_contains( $line, "Genre:" ) ){
			sscanf($line, $block_pattern, $tmp, $genre);
			continue;
	  	}

		//parse a book entry line - lines that fail to begin with '*' will be ignored even if otherwise correctly formatted
		if ( str_starts_with( $line, "*" ) ){
			//initialize line vars, values must not carry over to next line in case of an empty space/read err
    			$auth_name = '';
    			$auth_surname = '';
    			$title = '';
    			$notes = '';
    			//TODO multiple authors
    			sscanf($line, $line_pattern, $auth_surname, $auth_name, $title, $notes);
    			echo "author surname: ".$auth_surname.", author name: ".$auth_name.", book title: ".trim($title).", genre: ".$genre.", location: ".$location.". Notes: ".$notes."<br />";
  		}
	}

	fclose($file);
    ?>
</body>
</html>
