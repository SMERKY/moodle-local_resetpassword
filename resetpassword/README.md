moodle-local_resetpassword
==========================

/**
 * @package     local
 * @subpackage  resetpassword
 * @copyright   2014 Aaron Leggett
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

This local plugin allows an external service to access moodles reset password functionality.
By posting a secure key, along with the user accounts email address, the local plugin will check against certain criteria before loggin, and sending the moodle password reset email.

The plugin checks a series of events before allowing the password reset email to be sent.
  1 - Checks the plugin has been enabled (plugin setting disabled by default)
  2 - Checks the encrypted key from the POST message matches the one stored in moodle (plugin setting)
  3 - Checks the user exists in the moodle user table
  4 - Checks the user is not an admin (admins have been restricted from using this plugin for security reasons)

The plugin works by an external service sendding a POST request to the following plugin file
  [YOUR MOODLE URL] / local / resetpassword / reset.php
  eg moodle.example.com/local/resetpassword/reset.php
  
The file requires two variables to be posted to it.
  e - the email address of the account
  k - the encrypted key
  
The encrypted key that is posted to the file is created by concatenation of the email address and the private key (set in moodle), this is then encrypted with MD5.
  
  eg
    e = test@test.com
    k = MD5('test@test.com' . 'private key')
    
For any further information regarding this plugin, please see the GITHUB issues or email the developer with the details below
  - https://github.com/SMERKY/moodle-local_resetpassword/issues
  - aaron@aaronleggett.com


