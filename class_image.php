<?php
class Image{
	public $id;
	public $title;
	public $client;
	public $produced;
	
	public function __construct($id, $title, $client, $produced){
		$this->id = $id;
		$this->title = $title;
		$this->client = $client;
		$this->produced = $produced;
	}
}
?>