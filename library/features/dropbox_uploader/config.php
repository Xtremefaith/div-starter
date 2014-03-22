<?php
if(!defined('dboconf')){ die(); }

$dropbox_email= get_field('dropbox_email','options'); // YOUR DROPBOX EMAIL
$dropbox_password= get_field('dropbox_password','options'); // YOUR DROPBOX PASSWORD
$dropbox_folder='Public/Inbox';
$supported_types=array('image/png','image/jpeg','video/avi','audio/mpeg','video/mp4');
$size_limit='105000000';
?>