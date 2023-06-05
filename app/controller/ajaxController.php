<?php

namespace Tournament\controller\ajaxController;

use Tournament\Model\DB\TournamentDB;
use Tournament\Model\Config;

class ajaxController extends TournamentDB {
	public function __construct() {
		parent::__construct();

		add_action( "wp_ajax_accordionSaveData", [ $this, "saveTournamentInfo" ] );
		add_action( "wp_ajax_accordionLoadGroups", [ $this, "loadTournamentGroups" ] );
		add_action( "wp_ajax_accordionGroupsTeamSave", [ $this, "saveTournamentGroupTeams" ] );
		add_action( "wp_ajax_saveTournamentMatches", [ $this, "tournamentMatchesSave" ] );
		add_action( "wp_ajax_itemDelete", [ $this, "deleteItem" ] );
		add_action( "wp_ajax_previewTourImg", [ $this, "tournamentImg" ] );

		add_shortcode( 'wpdocs_the_shortcode', 'wpdocs_the_shortcode_func' );
	}

	public function saveTournamentInfo() {
		$tourID       = $_POST["tourID"];
		$tourDuration = $_POST["tourDuration"];
		$tourStart    = $_POST["tourStart"];
		$tourGroups   = $_POST["tourGroups"];

		TournamentDB::updateData(
			[ "tournament_duration", "tournament_start", "tournament_groups" ],
			[ $tourDuration, $tourStart, $tourGroups ],
			$tourID
		);

		wp_die();
	}

	public function loadTournamentGroups() {
		$tourID          = $_POST["tourID"];
		$tourGroups      = $_POST["tourGroups"];
		$tourGroupsEach  = explode( ",", $tourGroups );
		$tourGroupsCount = count( $tourGroupsEach );

		$g = 0;
		while ( $g < $tourGroupsCount ) {
			echo "<textarea cols='10' rows='5'
					placeholder='" .
			     $tourGroupsEach[ $g ] .
			     "'></textarea>";
			$g ++;
		}

		wp_die();
	}

	public function saveTournamentGroupTeams() {
		$tourID				=	$_POST['tourID'];
		$tourTeams 			= 	$_POST['tourTeams'];
		$tourData 			= 	TournamentDB::getSpecificTourData('id',$tourID);
		$tourGroups			= 	$tourData[0]->tournament_groups;
		$tourGroups			=	explode(',',$tourGroups);
		$tourTeamsByGroup	=	explode(',',$tourTeams);

		$tournamentGroupTeams=[];
		
		for($g=0; $g < count($tourGroups); $g++) {
			$tourTeamsByGroup[$g] = preg_replace('#\s+#',',',trim($tourTeamsByGroup[$g]));
			array_push($tournamentGroupTeams,[$tourGroups[$g] => explode(PHP_EOL, $tourTeamsByGroup[$g])]);
			
		}
		TournamentDB::updateData(['tournament_teams'], [serialize($tournamentGroupTeams)],$tourID);

		wp_die();
	}


	public function deleteItem() {
		$tourID		=	$_POST['tourID'];
		TournamentDB::removeData($tourID);
		// wp_send_json_success('test');

		wp_die();

	}
	public function tournamentImg() {

		$tourName = $_POST['tourName'];

		echo plugin_dir_url(dirname(dirname((__FILE__)))) . 'assets/img/' . $tourName . '.png';
	
		wp_die();
	}
}

new ajaxController();
