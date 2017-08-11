<?php
/*
Plugin Name: Greet Admin By Time
Plugin URI: http://wordpress.org/plugins/greet-admin-by-time/
Description: Changes Howdy message to greet admin depending on time of day 
Version: 1.1
Author: Alexander C. Block
Author URI: http://pizzli.com
License: GPLv2
*/
/*  Copyright 2013 Alexander C. Block  (email : ablock@pizzli.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_filter('gettext', 'change_howdy', 10, 3);

function change_howdy($translated, $text, $domain) {
$blogtime = current_time( 'mysql' ); 
list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $blogtime );
if ($hour <= 11){
$greet = "Good Morning";
}
if ($hour >= 12 && $hour <= 16){
$greet = "Good Afternoon";
}
if ($hour >= 17){
$greet = "Good Evening";
}
 if (!is_admin() || 'default' != $domain)
        return $translated;
 if (false !== strpos($translated, 'Howdy'))
        return str_replace('Howdy', $greet, $translated);
return $translated;
}
    
?>