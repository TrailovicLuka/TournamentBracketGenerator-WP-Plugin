<?php

use Tournament\Model\DB\TournamentDB;
use Tournament\Model\Config;

function tournament_preview_callback() {
	$url					= 	$_SERVER['REQUEST_URI'];
	$tourID					=	explode('id=', $url);
	$tournament             =	new TournamentDB();
	$tournamentAllData      =   $tournament->getSpecificTourData('id', $tourID[1] );
	$tournamentOptions		=	unserialize($tournamentAllData[0]->tournament_options);
	$tournamentGroups       =   explode(',',$tournamentAllData[0]->tournament_groups);
	$tournamentGroupsCount  =   count($tournamentGroups);
	$tournamentTeams        =   unserialize($tournamentAllData[0]->tournament_teams);
	$tournamentSchedule		=	unserialize($tournamentAllData[0]->tournament_schedule);
	$current_page 			= 	get_current_screen()->base;

	if(!$tournamentAllData || !$tournamentOptions['sport'] || !$tournamentOptions['tourType']) return;

	if(file_exists(PLUGIN_ROOT. '/app/view/template-parts/' . $tournamentOptions['sport'] . '/'. $tournamentOptions['tourType'].'.php')){
		
		include( PLUGIN_ROOT. '/app/view/template-parts/' . $tournamentOptions['sport'] . '/'. $tournamentOptions['tourType'].'.php');

	}else {
		echo '<h1>Currently there is no template, we are working on it. Soon...</h1>';
	}


}

?>