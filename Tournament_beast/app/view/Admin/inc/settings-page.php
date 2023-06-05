<?php

use Tournament\Model\DB\TournamentDB;

function tournament_settings_callback(): void {
	$newTournament = new TournamentDB(); 
	// var_dump(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	// die;
?>

	<div class="container-fluid p-0">
		<div class="settings-page">
			<div class="settings-page__header py-2 ">
				<h2 class='text-white text-center'>Tournament Beast</h2>
			</div>
			<div class="settings-page__content p-5 d-flex flex-column">
				<div class="settings-page__content--options d-flex justify-content-between">
					<form method='POST' action="#" class='col-12 col-md-6'>
						<div class="form-group d-flex flex-column col-12 col-md-6 h-100 justify-content-between">

							<label for="tourName" class='text-white mb-2 '>Tournament name</label>
							<input type="text" name='tourName' id='tourName' class='mb-2'>

							<label for="tourSport" class='text-white mb-2'>Sport Type</label>
							<select name="tourSport" id="tourSport" onChange="">
								<option value=""></option>
								<option value="football">Football</option>
								<option value="basketball">Basketball</option>
							</select>
							<div class="settings-page__content-tour-type d-flex flex-column d-none"
								 id='tourTypeWrap'>
								 <label for="tourType" class='text-white my-2'>Tournament Type</label>
									<select name="tourType_football" id="tourType_football">
										<option value=""></option>   
										<option value="classic">Classic</option>    
										<!-- <option value="league">League </option>     -->
										<option value="international">International (UEFA)</option>    
										<option value="clubInternational">Club International (UEFA)</option>
									</select>
									<select name="tourType_basketball" id="tourType_basketball">
										<option value=""></option>   
										<option value="cup">Cup (FIBA WC,Olympic,Euro)</option>    
										<!-- <option value="league">League </option>     -->
										<option value="international">International (UEFA)</option>    
										<option value="clubInternational">Club International (UEFA)</option>
									</select>
									<!-- <div class="d-flex align-items-center" id="api-check">
										<label class="mt-2 me-2 text-white">Use Api</label>
										<input class="mt-2" type="checkbox" name="checkApi" >
									</div>
									<span class='note-settings text-mute'>Note: <em>if you don't have API, data can be filled in manually</em></span> -->
								</div>
							<button type="submit" class="button button-primary mt-5 col-12 col-lg-8" id='submitSettings'>
								Create Tournament
							</button>

							<?php if (
								isset( $_POST["checkApi"] ) ||
								isset( $_POST["tourName"], $_POST["tourSport"] ) || isset($_POST["tourType_football"]) || isset($_POST["tourType_basketball"])
							) {
								$tourName  = sanitize_text_field(  $_POST["tourName"] );
								$tourSport = $_POST["tourSport"];
								$tourType  = $_POST["tourType_football"] ? $_POST["tourType_football"]: $_POST["tourType_basketball"];

								isset( $_POST["checkApi"] ) ? ( $tourApi = $_POST["checkApi"] ) : ( $tourApi = "" );

								$newTournament = new TournamentDB();


								if (strlen( $tourName ) >= 3 && strlen( $tourSport ) >= 3 && strlen( $tourType ) >= 3) {
									$newTournament->createData([ "tournament_options", "tournament_api" ],
									[ serialize( [
												"name"     => $tourName,
												"sport"    => $tourSport,
												"tourType" => $tourType,
											] ),
											$tourApi ? "api" : "manually",
										]
									);

									echo '<p class="pt-2 text-success">Tournament added successfully </p>';
								} else {
									echo '<p class="pt-2 text-danger">All fields must be filled to add tournament on list</p>';
								}
							} ?>
							</div>
						</form>
					<div class="settings-page__content--preview" id='img_preview' >
							
					</div>
				</div>
				<div class="settings-page__content--tournament-list pt-5">
					<?php
					$tournaments = $newTournament->getAllTourData( "tournament_options" );
					if ( $tournaments ) {
						$i = 0;
						foreach ( $tournaments as $tournament ) {

							$tournament      = unserialize( $tournament->tournament_options );
							$tourId          = $newTournament->getAllTourData( "id" );
							$tourApi         = $newTournament->getAllTourData( "tournament_api" );
							$AllTourData     = $newTournament->getSpecificTourData( "id", $tourId[ $i ]->id );				
							$tourGroups      = $AllTourData[0]->tournament_groups;
							$tournamentTeams = unserialize($AllTourData[0]->tournament_teams);
							$tourGroupsEach  = explode( ",", $tourGroups );
							$tourGroupsCount = count( $tourGroupsEach );
							$tourSport		 = unserialize($AllTourData[0]->tournament_options);

							?>
							<div class="accordion accordion-flush col-12 pb-2 d-flex align-items-center" id="accordionFlushExample">
							<div class='bin h-100 cursor-pointer' style='cursor:pointer'>
								<i class="fa-solid fa-trash text-danger pe-3" id=deleteBtn data-id=<?php echo $tourId[ $i ]->id;  ?>></i>
							</div>
								<div class="accordion-item col-12">
									<h2 class="accordion-header" id="flush-headingOne">
										<button id='accordionHeader' class="accordion-button collapsed" type="button"
										data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
										aria-expanded="false" aria-controls="flush-collapseOne">
											<?php echo $tournament["name"]; ?>
										</button>
									</h2>
									
									<div id="flush-collapseOne" class="accordion-collapse collapse"
										 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
										<div class="accordion-body">
											<div class="tournament__steps-form d-flex flex-column flex-md-row">
												<div id="step-1" class='p-2 col-12 col-md-4'>
													<form action="#" method="POST">
														<label for="tournamentDuration">Duration</label>
														<br>
														<input type="number" name='tournamentDuration'
															   id='tournamentDuration' min='1' max='99'
															   value="<?php echo $AllTourData[0]->tournament_duration; ?>" <?php echo $tourGroupsCount >= 2 ? "readonly" : ''; ?>>
														   
														<br>
														<label for="startDate" class='mt-2'>Start Date</label>
														<br>
														<input type="date" class='mb-2' name='tournamentStart'
															   id='tournamentStart'
															   value="<?php echo $AllTourData[0]->tournament_start; ?>" <?php echo $tourGroupsCount >= 2 ? "readonly" : ''; ?>> 
														<br>
														<label for="groups">Groups</label>
														<br>
														<input type="text" name='tournamentGroups'
															   id='tournamentGroups'
															   placeholder='A,B,C,D...'
															   value="<?php echo $AllTourData[0]->tournament_groups; ?>"  <?php echo $tourGroupsCount >= 2 ? "readonly" : ''; ?>>
														<br>
														<button id="tourNextBtn"
																data-tour="<?php echo $tourId[ $i ]->id; ?>"
																type="submit"
																<?php echo $tourGroupsCount >= 2 ? "disabled" : ''; ?>
																class='button button-primary mt-2 <?php echo $tourGroupsCount >= 2 ? "d-none" : ""; ?> '>
															Next
														</button>
														<?php if(isset($_POST['tournamentStart'],$_POST['tournamentGroups'])){
																sanitize_text_field( $_POST['tournamentDuration'] ); 
																sanitize_text_field( $_POST['tournamentGroups'] );
														} ?>
													</form>
												</div>
												<div id="step-2" class='step_2 p-2 col-12 col-md-7'>
													<?php if ( $tourApi[ $i ]->tournament_api === "manually" ) { ?>
														<form action="#" method="POST" class='d-flex flex-column'>
															<div class="step_2-wrap <?php echo $tourGroupsCount > 2	? "d-block": ""; ?> ">
															<label><strong>Groups</strong></label>
																<div class='d-flex justify-content-between flex-wrap step-2-groups'>
																	<?php
																	$g = 0;
																	while ( $g < $tourGroupsCount ) { ?>
																	
																		<textarea cols='10' rows='5' placeholder='<?php  echo $tourGroupsEach[ $g ] ?>'><?php   if(isset($tournamentTeams[$g][ $tourGroupsEach[ $g ]])) {foreach($tournamentTeams[$g][ $tourGroupsEach[ $g ]] as $team) {  echo str_replace(',', '&#10;',$team); } } ?></textarea>

																		<?php $g ++; 
																	}?>
																</div>
																<div class="generate mt-4 col-12 col-md-6">
																	<input type="text"
																	value="<?php echo $tourGroupsCount > 2 ? '[tournament id='.$tourId[$i]->id.' sport='.$tourSport['sport'].' type='.$tourSport['tourType'].']' : ''; ?>"
																	class="bg-light border rounded w-100"
																	style="height: 50px" readonly>
																	<button id="tourTeamsGroup" type="submit"  data-tour="<?php echo $tourId[ $i ]->id; ?>" class="button button-primary my-2">Save & Generate Shortcode 
																</button>
																	<br>
																	<a href="<?php echo site_url().'/wp-admin/admin.php?page=tournament-preview&id='. $tourId[ $i ]->id ?>">Bracket Preview page</a>
																</div>
															</div>

														</form>
													<?php } ?>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php $i ++;
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}



?>