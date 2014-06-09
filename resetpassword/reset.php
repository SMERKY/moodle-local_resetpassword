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
 * @package     local
 * @subpackage  local_resetpassword
 * @copyright   2014 Aaron Leggett
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');
require_once(dirname(dirname(dirname(__FILE__))).'/login/lib.php');

$key = required_param('k', PARAM_RAW);
$email = required_param('e', PARAM_RAW);

$enabled = get_config('local_resetpassword', 'enabled');
$privatekey = get_config('local_resetpassword', 'privatekey');

if($enabled == 0){
	throw new moodle_exception('Plugin not enabled');
}

if(!resetpassword_valid_key($key, $email, $privatekey)){
	throw new moodle_exception('Invalid Private Key');
}

$user = resetpassword_get_user_id($email);
if($user == false){
	throw new moodle_exception('User does not exist');
}

if(is_siteadmin($user)){
	throw new moodle_exception('Cannot reset admin password');
}

//send password reset email
$resetrecord = core_login_generate_password_reset($user);
$sendresult = send_password_change_confirmation_email($user, $resetrecord);

if($sendresult == 1){
	echo 'true';
}else{
	echo 'false';
}