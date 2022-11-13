<?php

class GetPets {
    public function __construct()
    {
		add_action('', '');

	    global $wpdb;
	    $tableName = $wpdb->prefix . 'pets';

		$this->args = $this->getArgs();
	    $this->placeholders = $this->createPlaceholders();

		$query = "SELECT id,favGame,favTime, petWeight, favColor FROM $tableName ";
		$query .= $this->createWhereText();
		$query .= " LIMIT 100";

	    $this->pets = $wpdb->get_results($wpdb->prepare($query, $this->placeholders));
    }

	public function getArgs()
	{
		$temp = [
			'favColor' => sanitize_text_field($_GET['favColor']),
			'petWeight' => sanitize_text_field($_GET['petWeight']),
			'favTime' => sanitize_text_field($_GET['favTime']),
			'favGame' => sanitize_text_field($_GET['favGame'])
		];

		return array_filter($temp, function($x) {
			return $x;
		});
	}

	public function createPlaceholders() {
		return array_map(function($x) {
			return $x;
		}, $this->args);
	}

	public function createWhereText()
	{
		$whereQuery = "";

		if ( count($this->args) > 0 )
		{
			$whereQuery = "WHERE ";
		}

		$currentPosition = 0;
		foreach($this->args as $index => $item) {
			$whereQuery .= $this->specificQuery($index);
			if ($currentPosition != count($this->args) -1)
			{
               $whereQuery .= " AND ";
			}
			$currentPosition++;
		}

		return $whereQuery;
	}

	public function specificQuery($index)
	{
       switch ($index) {
	       case "favColor":
			   return "favColor = %s";
	       case "favTime":
		       return "favTime = %s";
	       case "petWeight":
		       return "petWeight = %d";
	       case "favGame":
		       return "favGame = %s";
	       default:
			   return $index . " = %s";
       }
	}
}

