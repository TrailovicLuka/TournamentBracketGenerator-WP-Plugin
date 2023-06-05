<?php

namespace Tournament\Model\DB;

class TournamentDB {

	public $table_name;

	public function __construct() 
	{
		global $wpdb;
		$this->table_name = $wpdb->prefix . "tournament_beast";
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$this->table_name'" ) != $this->table_name ) {
			$this->create_db();
		}
	}

	private function create_db() 
	{
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $this->table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            created timestamp NOT NULL default CURRENT_TIMESTAMP,
            tournament_options varchar (1000) NOT NULL,
            tournament_start Date NOT NULL,
            tournament_duration varchar(255) DEFAULT '' NOT NULL,
            tournament_api varchar(255) DEFAULT '' NOT NULL,
            tournament_groups varchar(255) DEFAULT '' NOT NULL,
			tournament_schedule LONGTEXT DEFAULT '' NOT NULL,
            tournament_teams LONGTEXT DEFAULT '' NOT NULL,
			
            UNIQUE KEY id (id)
          ) $charset_collate;";
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	public function createData( $columns = [], $values = [] ) 
	{
		global $wpdb;
		$columns_sql = "`" . implode( "`,`", $columns ) . "`";
		$values_sql  = "'" . implode( "','", $values ) . "'";
		$query = $wpdb->prepare("INSERT INTO $this->table_name ($columns_sql) VALUES ($values_sql)");
		$wpdb->query( $query );
	}

	public function updateData( $columns, $values, $id ) 
	{
		global $wpdb;
		$set_pairs = [];
		for ( $i = 0; $i < count( $columns ); $i ++ ) {
			$set_pairs[] = "`{$columns[$i]}`='{$values[$i]}'";
		}
		$set_pairs_str = implode( ", ", $set_pairs );
		$query = $wpdb->prepare( "UPDATE $this->table_name SET $set_pairs_str WHERE id=$id");
		$wpdb->query( $query );
	}


	public function getAllTourData( $column = [] ) 
	{
		global $wpdb;
		$result = $wpdb->prepare( "SELECT $column FROM $this->table_name" );
		return $wpdb->get_results($result);
	}
	

	public function getSpecificTourData( $column, $data ) 
	{
		global $wpdb;
		$result = $wpdb->prepare( "SELECT * FROM $this->table_name WHERE $column LIKE $data" );
		return  $wpdb->get_results($result);
	}

	public function removeData($id)
	{
		global $wpdb;
		$removing = $wpdb->prepare("DELETE FROM  $this->table_name WHERE id=$id");
		return $wpdb->query($removing);
	}
}

new TournamentDB();

