<?php

namespace Tournament\init;

use Tournament\Model\Config;
use Tournament\Model\DB;
use Tournament\controller\ajaxController;


class init {

	public function __construct() {


	}

	public function initialization() {
		new TournamentDB();
		new ajaxController();
		new Config();
	}
}

new init();


?>