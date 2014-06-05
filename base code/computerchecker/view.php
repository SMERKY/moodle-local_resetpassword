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
 * Local plugin "computerchecker" - View page
 *
 * @package     local
 * @subpackage  local_computerchecker
 * @copyright   2013 Aaron Leggett - LearningWorks Ltd.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Include config.php
require_once('../../config.php');

// Globals
global $PAGE;

//set page variables
$PAGE->set_url('/local/computerchecker/view.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Computer Checker');
$PAGE->navbar->add('Computer Checker');

//set JS urls to be included (wouldnt work without making moodle_url)
$jQuery = new moodle_url($CFG->wwwroot.'/local/computerchecker/js/jquery-1.10.2.min.js');
$pluginDetect = new moodle_url($CFG->wwwroot.'/local/computerchecker/js/PluginDetect.js');
$scriptsPage = new moodle_url($CFG->wwwroot.'/local/computerchecker/js/scripts_page.js');

//add js urls to page
$PAGE->requires->js($jQuery);
$PAGE->requires->js($pluginDetect);
$PAGE->requires->js($scriptsPage);

echo $OUTPUT->header();

?>

<div id="versions">		
	<div class="versions">
		<table>
			<tr>
				<td class="table-title">Browser</td>
				<td class="table-title">Up to date</td>
				<td class="table-title">Version</td>
			</tr>
			<tr>
				<td id="browse" class="table-item"></td>
				<td id="browsesupported" class="table-light ver-box">Loading...</td>
				<td id="browseversion" class="table-dark ver-box"></td>
			</tr>
			<tr>
				<td colspan="3" id="browselink" style="display:none;" class="table-brow-download table-light">
					<div class="download-link"><p>DOWNLOAD</p></div>
					<div class="browser-download">
						<a href="http://www.google.com/chrome">
							<img class="img-icon" src="<?php echo $CFG->wwwroot; ?>/local/computerchecker/pix/chrome.png" />
						</a>
						<a href="http://www.mozilla.org/en-US/firefox/new/">
							<img class="img-icon" src="<?php echo $CFG->wwwroot; ?>/local/computerchecker/pix/firefox.png" />
						</a>
						<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
							<img class="img-icon" src="<?php echo $CFG->wwwroot; ?>/local/computerchecker/pix/ie.png" />
						</a>
					</div>
				</td>
			</tr>
		</table>
			
		<table>
			<tr>
				<td class="table-title">Plugin</td>
				<td class="table-title">Up to date</td>
				<td class="table-title">Version</td>
			</tr>
			<tr>
				<td class="table-item"><img class="img-icon" src="<?php echo $CFG->wwwroot; ?>/local/computerchecker/pix/java.png" /><div class="plugin-name">Java</div></td>
				<td id="java_inst" class="table-light ver-box">Loading...</td>
				<td id="java_ver" class="table-dark ver-box"></td>
			</tr>
			<tr>
				<td class="table-item"><img class="img-icon" src="<?php echo $CFG->wwwroot; ?>/local/computerchecker/pix/flash.png" /><div class="plugin-name">Flash</div></td>
				<td id="flash_inst" class="table-light ver-box">Loading...</td>
				<td id="flash_ver" class="table-dark ver-box"></td>
			</tr>
			<tr>
				<td colspan="3" id="pluginlink" style="display:none;" class="table-plug-download table-light">
					<div class="download-link"><p>DOWNLOAD</p></div>
					<div class="plugin-download">
						<a id="javalink" href="http://www.java.com/getjava/" target="_blank">
							<img class="img-icon" src="<?php echo $CFG->wwwroot; ?>/local/computerchecker/pix/java.png" />
						</a>
						<a id="flashlink" href="http://get.adobe.com/flashplayer/" target="_blank">
							<img class="img-icon" src="<?php echo $CFG->wwwroot; ?>/local/computerchecker/pix/flash.png" />
						</a>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<?php

echo $OUTPUT->footer();
