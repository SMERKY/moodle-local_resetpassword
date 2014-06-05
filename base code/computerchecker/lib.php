<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Computer Checker
 *
 * @package    local
 * @subpackage local_computerchecker
 * @copyright  2013 Aaron Leggett - LearningWorks Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//adds jQuery to every page
$CFG->additionalhtmlfooter .= '<script src="'.$CFG->wwwroot.'/local/computerchecker/js/jquery-1.10.2.min.js"></script>';

$enabled = get_config('local_computerchecker', 'enabled');

if($enabled){
	if(!isset($_COOKIE['computerchecker'])){
	    //if cookie is not set add js files (script will run automatically)
	   	$CFG->additionalhtmlfooter .= '
			<script src="'.$CFG->wwwroot.'/local/computerchecker/js/PluginDetect.js"></script>
			<script src="'.$CFG->wwwroot.'/local/computerchecker/js/scripts_background.js"></script>
			<script type="text/javascript">
				$(document).ready(runComputerCheck("'.$CFG->wwwroot.'"));
			</script>
		';  
	}else{
		$CFG->additionalhtmlfooter .= '
			<script src="'.$CFG->wwwroot.'/local/computerchecker/js/scripts_background.js"></script>
			<script type="text/javascript">
				$(document).ready(runCookieCheck("'.$CFG->wwwroot.'"));
			</script>
		';
	}
}
