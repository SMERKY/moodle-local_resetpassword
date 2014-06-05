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
 * Reset Password
 *
 * @package    local
 * @subpackage resetpassword
 * @copyright  2014 Aaron Leggett
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
* Function isValidKey
* 	Checks stored private key and email against the key sent
* 	@param k - Key sent in post
* 	@param e - Email requesting password reset
*	@param pk - Stored private key from moodle
*	@return bool - true if k is valid
*/
function isValidKey($k, $e, $pk){
	$tempKey = $e + $pk;
	$tempKey = md5($tempKey);

	if($tempKey != $k){
		return false;
	}

	return true;
}
