<?php

/* GNUkebox -- a free software server for recording your listening habits

   Copyright (C) 2009 Free Software Foundation, Inc

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU Affero General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU Affero General Public License for more details.

   You should have received a copy of the GNU Affero General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

require_once('database.php');	// include the database connection string

// these functions should be short-lived while things go through a transition

function username_to_uniqueid($username) {
	global $adodb;

	$adodb->SetFetchMode(ADODB_FETCH_ASSOC);
	try {
		$uniqueid = $adodb->GetOne('SELECT uniqueid from Users where lower(username) = lower('.$adodb->qstr($username).')');
	} catch (exception $e) {
		return 0;
	}

	return $uniqueid;
}

function uniqueid_to_username($uniqueid) {
	global $adodb;

	$adodb->SetFetchMode(ADODB_FETCH_ASSOC);
	try {
		$username = $adodb->GetOne('SELECT username from Users where uniqueid = '.($uniqueid));
	} catch (exception $e) {
		return "BROKEN($uniqueid)";
	}

	return $username;
}

?>
