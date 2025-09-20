<?php

class BookEntry
{
	public $title;
	public $author_surname;
	public $author_name;
	public $genre;
	public $location;
	public $notes;

	function __construct() {
		$title = '';
		$author_surname = '';
		$author_name = '';
		$genre = '';
		$location = '';
		$notes = '';
	}

	function lineReset(): void {
		$this->title = '';
		$this->author_surname = '';
		$this->author_name = '';
		$this->notes = '';
	}
}

?>
