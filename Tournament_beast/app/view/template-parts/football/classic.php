<?php
use Tournament\Model\DB\TournamentDB;


$current_page  = is_admin() ? get_current_screen()->base : '';

 if ($current_page  === 'admin_page_tournament-preview'){

	if(isset($_POST['submit'])){
		$values = array_values($_POST);
		$tournament->updateData(['tournament_schedule'], [serialize($values)],$tourID[1]);	

		echo "<meta http-equiv='refresh' content='0'>";
	}
	?>
	<form method="POST" action="#" id='matchesForm'>
		<section id="bracket">
		<div class="container">
			<div class="split split-one">
				<div class="round round-one current">
				<div class="round-details">Round 1<br/><span class="date">March 16</span></div>
					<?php for($i=0; $i < $tournamentGroupsCount ;$i++) { ?>
						<ul class="matchup">
							<li class="team team-top">
								<input type="text" name="team-1[round-1-1][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[0]['round-1-1'])  ? $tournamentSchedule[0]['round-1-1'][$i] : '' ?>' placeholder="Team-1" >
								<span class="score">
									<input type="number" name="team-1[r-1-1][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[0]['r-1-1'][$i]) ? $tournamentSchedule[0]['r-1-1'][$i] : '' ?>' placeholder="Res" min="0" max="99">
								</span>
							</li>

							<li class="team team-bottom">
								<input type="text" name="team-2[round-t2-1-1][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[1]['round-t2-1-1'][$i]) ? $tournamentSchedule[1]['round-t2-1-1'][$i] : '' ?>'  placeholder="Team-2">
								<span class="score">
									<input type="number" name="team-2[r2-1-1][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[1]['r2-1-1'][$i]) ? $tournamentSchedule[1]['r2-1-1'][$i] : '' ?>' placeholder="Res" min="0" max="99">
								</span>
							</li>
						</ul>
					<?php } 				
					?>
				</div>  <!-- END ROUND ONE -->

				<div class="round round-two">
				<div class="round-details">Round 2<br/><span class="date">March 18</span></div>     
					<?php for($i=0; $i < $tournamentGroupsCount/2 ;$i++) {?>
						<ul class="matchup">
							<li class="team team-top">
								<input type="text" name="team-1[round-2-1][<?php echo $i ?>]" placeholder="Team-1">
								<span class="score">
									<input type="number" name="team-1[r-2-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
								</span>
							</li>
							<li class="team team-bottom">
								<input type="text" name="team-2[round-2-1][<?php echo $i ?>]" placeholder="Team-2">
								<span class="score">
									<input type="number" name="team-2[r-2-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
								</span>
							</li>
						</ul>
					<?php } ?>
				</div>  <!-- END ROUND TWO -->
				
				<div class="round round-three">
					<div class="round-details">Round 3<br/><span class="date">March 22</span></div>     
						<?php for($i=0; $i < $tournamentGroupsCount/4 ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top">
									<input type="text" name="team-1[round-3-1][<?php echo $i ?>]" placeholder="Team-1"> 
									<span class="score">
										<input type="number" name="team-1[r-3-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
								<li class="team team-bottom">
									<input type="text" name="team-2[round-3-1][<?php echo $i ?>]" placeholder="Team-2">
									<span class="score">
										<input type="number" name="team-2[r-3-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div>  <!-- END ROUND THREE -->    
				</div>

			<div class="champion">
				<div class="semis-l">
				<div class="round-details">west semifinals <br/><span class="date">March 26-28</span></div>   
					<ul class ="matchup championship">
						<li class="team team-top"> 
							<input type="text" name="team-1[semi-1][<?php echo $i ?>]" placeholder="Team-1"> 
							<span class="score">
								<input type="number" name="team-1[r-s-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
						<li class="team team-bottom">
							<input type="text" name="team-2[semi-1][<?php echo $i ?>]" placeholder="Team-2">
							<span class="score">
								<input type="number" name="team-2[r-s-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
					</ul>
				</div>
				<div class="final">
				<i class="fa fa-trophy"></i>
				<div class="round-details">championship <br/><span class="date">March 30 - Apr. 1</span></div>    
					<ul class ="matchup championship">
						<li class="team team-top"> 
							<input type="text" name="team-1[final][<?php echo $i ?>]" placeholder="Team-1"> 
							<span class="score">
								<input type="number" name="team-1[r-f][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
						<li class="team team-bottom">
							<input type="text" name="team-2[final][<?php echo $i ?>]" placeholder="Team-2">
							<span class="score">
								<input type="number" name="team-2[r-f][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
					</ul>
				</div>
				<div class="semis-r">   
				<div class="round-details">east semifinals <br/><span class="date">March 26-28</span></div>   
					<ul class ="matchup championship">
						<li class="team team-top">
							<input type="text" name="team-1[semi-2][<?php echo $i ?>]" placeholder="Team-1">
							<span class="score">
								<input type="number" name="team-1[r-s-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
						<li class="team team-bottom">
							<input type="text" name="team-2[semi-2][<?php echo $i ?>]" placeholder="Team-2">
							<span class="score">
								<input type="number" name="team-[r-s-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
					</ul>
				</div>  
			</div>


				<div class="split split-two">
					<div class="round round-three">
					<div class="round-details">Round 3<br/><span class="date">March 22</span></div>           
						<?php for($i=0; $i < $tournamentGroupsCount/4 ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top"> 
									<input type="text" name="team-1[round-3-2][<?php echo $i ?>]" placeholder="Team-1">
									<span class="score">
										<input type="number" name="team-1[r-3-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
								<li class="team team-bottom">
									<input type="text" name="team-2[round-3-2][<?php echo $i ?>]" placeholder="Team-2">
									<span class="score">
										<input type="number" name="team-1[r-3-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div>  <!-- END ROUND THREE -->  

					<div class="round round-two">
					<div class="round-details">Round 2<br/><span class="date">March 18</span></div>           
						<?php for($i=0; $i < $tournamentGroupsCount/2 ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top">
									<input type="text" name="team-1[round-2-2][<?php echo $i ?>]" placeholder="Team-1">
									<span class="score">
											<input type="number" name="team-1[r-2-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
								<li class="team team-bottom">
									<input type="text" name="team-2[round-2-2][<?php echo $i ?>]" placeholder="Team-2">
									<span class="score">
										<input type="number" name="team-1[r-2-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div> 

					 <!-- END ROUND TWO -->

					<div class="round round-one current">
					<div class="round-details">Round 1<br/><span class="date">March 16</span></div>
						<?php for($i=0; $i < $tournamentGroupsCount ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top">
									<input type="text" name="team-1[round-1-2][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[0]['round-1-2'][$i]) ?  $tournamentSchedule[0]['round-1-2'][$i] : ''?>' placeholder="Team-1">
									<span class="score">
										<input type="number" name="team-1[r-1-2][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[0]['r-1-2'][$i]) ? $tournamentSchedule[0]['r-1-2'][$i] : ''?>' placeholder="Res" min="0" max="99">
									</span>
								</li>
								<li class="team team-bottom">
									<input type="text" name="team-2[round-t2-1-2][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[1]['round-t2-1-2'][$i]) ? $tournamentSchedule[1]['round-t2-1-2'][$i] : '' ?>' placeholder="Team-2">
									<span class="score">
										<input type="number" name="team-1[r2-1-2][<?php echo $i ?>]" value='<?php echo isset($tournamentSchedule[0]['r2-1-2'][$i]) ? $tournamentSchedule[0]['r2-1-2'][$i] : ''?>' placeholder="Res" min="0" max="99">
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div>  <!-- END ROUND ONE -->                  
				</div>
			</div>
		</section>
		<div class='p-2 border-top border-bottom bg-light d-flex justify-content-center'>
			<input  type='submit' name='submit' class='button button-primary px-5' value='Update Tournament'> 
		</div>
	</form>

	<?php
	} else {	
		
	$tourID 				=	$attributes['id'];
	$tournament             =	new TournamentDB();
	$tournamentAllData      =   $tournament->getSpecificTourData('id', $tourID);
	$tournamentOptions		=	unserialize($tournamentAllData[0]->tournament_options);
	$tournamentGroups       =   explode(',',$tournamentAllData[0]->tournament_groups);
	$tournamentGroupsCount  =   count($tournamentGroups);
	$tournamentTeams        =   unserialize($tournamentAllData[0]->tournament_teams);
	$tournamentSchedule		=	unserialize($tournamentAllData[0]->tournament_schedule);

		?>
	<section id="bracket">
		<div class="container">
			<div class="split split-one">
				<div class="round round-one current">
				<div class="round-details">Round 1<br/><span class="date">March 16</span></div>
					<?php for($i=0; $i < $tournamentGroupsCount ;$i++) { ?>
						<ul class="matchup">
							<li class="team team-top">
								<span>
									<?php echo $tournamentSchedule[0]['round-1-1']  ? $tournamentSchedule[0]['round-1-1'][$i] : '' ?>
								</span>
								<span class="score">
									<?php echo $tournamentSchedule[0]['r-1-1'][$i] ? $tournamentSchedule[0]['r-1-1'][$i] : '' ?> 
								</span>
							</li>

							<li class="team team-bottom">
								<span>
									<?php echo $tournamentSchedule[1]['round-t2-1-1'][$i] ? $tournamentSchedule[1]['round-t2-1-1'][$i] : ''  ?>
								</span>
								<span class="score">
									<?php echo $tournamentSchedule[1]['r2-1-1'][$i] ? $tournamentSchedule[1]['r2-1-1'][$i] : ''  ?>
								</span>
							</li>
						</ul>
					<?php } 				
					?>
				</div>  <!-- END ROUND ONE -->

				<div class="round round-two">
				<div class="round-details">Round 2<br/><span class="date">March 18</span></div>     
					<?php for($i=0; $i < $tournamentGroupsCount/2 ;$i++) {?>
						<ul class="matchup">
							<li class="team team-top">
								<input type="text" name="team-1[round-2-1][<?php echo $i ?>]" placeholder="Team-1">
								<span class="score">
									<input type="number" name="team-1[r-2-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
								</span>
							</li>
							<li class="team team-bottom">
								<input type="text" name="team-2[round-2-1][<?php echo $i ?>]" placeholder="Team-2">
								<span class="score">
									<input type="number" name="team-2[r-2-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
								</span>
							</li>
						</ul>
					<?php } ?>
				</div>  <!-- END ROUND TWO -->
				
				<div class="round round-three">
					<div class="round-details">Round 3<br/><span class="date">March 22</span></div>     
						<?php for($i=0; $i < $tournamentGroupsCount/4 ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top">
									<input type="text" name="team-1[round-3-1][<?php echo $i ?>]" placeholder="Team-1"> 
									<span class="score">
										<input type="number" name="team-1[r-3-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
								<li class="team team-bottom">
									<input type="text" name="team-2[round-3-1][<?php echo $i ?>]" placeholder="Team-2">
									<span class="score">
										<input type="number" name="team-2[r-3-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div>  <!-- END ROUND THREE -->    
				</div>

			<div class="champion">
				<div class="semis-l">
				<div class="round-details">west semifinals <br/><span class="date">March 26-28</span></div>   
					<ul class ="matchup championship">
						<li class="team team-top"> 
							<input type="text" name="team-1[semi-1][<?php echo $i ?>]" placeholder="Team-1"> 
							<span class="score">
								<input type="number" name="team-1[r-s-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
						<li class="team team-bottom">
							<input type="text" name="team-2[semi-1][<?php echo $i ?>]" placeholder="Team-2">
							<span class="score">
								<input type="number" name="team-2[r-s-1][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
					</ul>
				</div>
				<div class="final">
				<i class="fa fa-trophy"></i>
				<div class="round-details">championship <br/><span class="date">March 30 - Apr. 1</span></div>    
					<ul class ="matchup championship">
						<li class="team team-top"> 
							<input type="text" name="team-1[final][<?php echo $i ?>]" placeholder="Team-1"> 
							<span class="score">
								<input type="number" name="team-1[r-f][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
						<li class="team team-bottom">
							<input type="text" name="team-2[final][<?php echo $i ?>]" placeholder="Team-2">
							<span class="score">
								<input type="number" name="team-2[r-f][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
					</ul>
				</div>
				<div class="semis-r">   
				<div class="round-details">east semifinals <br/><span class="date">March 26-28</span></div>   
					<ul class ="matchup championship">
						<li class="team team-top">
							<input type="text" name="team-1[semi-2][<?php echo $i ?>]" placeholder="Team-1">
							<span class="score">
								<input type="number" name="team-1[r-s-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
						<li class="team team-bottom">
							<input type="text" name="team-2[semi-2][<?php echo $i ?>]" placeholder="Team-2">
							<span class="score">
								<input type="number" name="team-[r-s-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
							</span>
						</li>
					</ul>
				</div>  
			</div>


				<div class="split split-two">
					<div class="round round-three">
					<div class="round-details">Round 3<br/><span class="date">March 22</span></div>           
						<?php for($i=0; $i < $tournamentGroupsCount/4 ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top"> 
									<input type="text" name="team-1[round-3-2][<?php echo $i ?>]" placeholder="Team-1">
									<span class="score">
										<input type="number" name="team-1[r-3-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>

									
								</li>
								<li class="team team-bottom">
									<input type="text" name="team-2[round-3-2][<?php echo $i ?>]" placeholder="Team-2">
									<span class="score">
										<input type="number" name="team-1[r-3-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div>  <!-- END ROUND THREE -->  

					<div class="round round-two">
					<div class="round-details">Round 2<br/><span class="date">March 18</span></div>           
						<?php for($i=0; $i < $tournamentGroupsCount/2 ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top">
									<input type="text" name="team-1[round-2-2][<?php echo $i ?>]" placeholder="Team-1">
									<span class="score">
											<input type="number" name="team-1[r-2-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
								<li class="team team-bottom">
									<input type="text" name="team-2[round-2-2][<?php echo $i ?>]" placeholder="Team-2">
									<span class="score">
										<input type="number" name="team-1[r-2-2][<?php echo $i ?>]" placeholder="Res" min="0" max="99">
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div> 

					 <!-- END ROUND TWO -->

					<div class="round round-one current">
					<div class="round-details">Round 1<br/><span class="date">March 16</span></div>
						<?php for($i=0; $i < $tournamentGroupsCount ;$i++) {?>
							<ul class="matchup">
								<li class="team team-top">
								<span>
									<?php echo $tournamentSchedule[0]['round-1-2'][$i] ?  $tournamentSchedule[0]['round-1-2'][$i] : '' ?>
								</span>
								<span class="score">
									<?php echo $tournamentSchedule[0]['r-1-2'][$i] ? $tournamentSchedule[0]['r-1-2'][$i] : '' ?> 
								</span>
								</li>
								<li class="team team-bottom">
									<span>
										<?php echo $tournamentSchedule[1]['round-t2-1-2'][$i] ? $tournamentSchedule[1]['round-t2-1-2'][$i] : '' ?>
									</span>
									<span class="score">
										<?php echo $tournamentSchedule[0]['r2-1-2'][$i] ? $tournamentSchedule[0]['r2-1-2'][$i] : '' ?> 
									</span>
								</li>
							</ul>
						<?php } ?>                  
					</div>  <!-- END ROUND ONE -->                  
				</div>
			</div>
		</section>

	<?php }
?>