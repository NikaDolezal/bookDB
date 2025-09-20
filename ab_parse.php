<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load audiobooks from file</title>
</head>
<body>
<?php
	//include
	require './BookEntry.php';

	//test
	echo "Hello world! <br>";

	//open file
	$file = fopen("audiobooks_list.txt", "r");

	//create object for a single entry
	$entry = new BookEntry();

	//set patterns
	$block_pattern = "%s %[0-9A-Za-z/ -]+";
	$line_pattern = "* %[^,], %[^:]: %[^>]> %[0-9A-Za-z/ -]+";

	//parse lines until EOF
	while(! feof($file)) {
		$line = fgets($file);

		//resolve block values - each sits on its own line, once a block value is recognized and saved, the cycle can move on, format does not allow for a book entry to still follow
		if ( str_contains( $line, "Location:" ) ){
			sscanf($line, $block_pattern, $tmp, $entry->location);
			continue;
	 	}
	  	if ( str_contains( $line, "Genre:" ) ){
			sscanf($line, $block_pattern, $tmp, $entry->genre);
			continue;
	  	}

		//parse a book entry line - lines that fail to begin with '*' will be ignored even if otherwise correctly formatted
		if ( str_starts_with( $line, "*" ) ){
			//values must not carry over to next line in case of an empty space/read err
			$entry->lineReset();
    			//TODO multiple authors
			sscanf($line, $line_pattern, $entry->auth_surname, $entry->auth_name, $entry->title, $entry->notes);
			$output_pattern = "author surname: %s, author name: %s, book title: %s, genre: %s, location: %s. Notes: %s<br />";
			$output = sprintf($output_pattern, $entry->auth_surname, $entry->auth_name, trim($entry->title), $entry->genre, $entry->location, $entry->notes);
			echo $output;
  		}
	}

	//close file
	fclose($file);
    ?>
</body>
</html>
