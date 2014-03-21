<?php
/*
Plugin Name: DboUploader - Dropbox upload
Plugin URI: http://www.webania.net/dbouploader/
Description: Upload to Dropbox
Version: 1.0
Author: Elvin Haci
Author URI: http://www.webania.net
License: GPL2
*/
/*  Copyright 2011,  Elvin Haci  (email : elvinhaci@hotmail.com)
 
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
  
function dbouploader($content = '') {
    if (is_user_logged_in())  
        add_shortcode('dbouploader', 'shortcoder'); 
    else 
        add_shortcode('dbouploader', 'notloggedin');
    return $content;
}
 
function notloggedin($atts,$content = '') {
    return 'You must be logged in!';
}
 
function shortcoder($atts,$content = '') {

    define("dboconf","1");
    include(dirname(__FILE__)."/config.php");
     
    if ($_POST) {
        include(dirname(__FILE__)."/DropboxUploader.php");

        try {
            // Rename uploaded file to reflect original name
            if ($_FILES['file']['error'] !== UPLOAD_ERR_OK)
                throw new Exception('File was not successfully uploaded from your computer.');
     
        if(  !in_array($_FILES["file"]["type"],$supported_types) or $_FILES["file"]["size"] > $size_limit)
            throw new Exception('File size ('.$_FILES["file"]["size"].') is too large (max:'.$size_limit.'bytes) or file type is not supported.');
     
        $tmpDir = uniqid('/tmp/DropboxUploader-');
        if (!mkdir($tmpDir))
            throw new Exception('Cannot create temporary directory!');
     
        if ($_FILES['file']['name'] === "")
            throw new Exception('File name not supplied by the browser.');

        global $current_user;
        get_currentuserinfo();
     
            $tmpFile = $tmpDir.'/'.str_replace("/\0", '_', $current_user->user_email.'_'.$_FILES['file']['name']);
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $tmpFile))
                throw new Exception('Cannot rename uploaded file!');
     
            // Enter your Dropbox account credentials here
            $uploader = new DropboxUploader($dropbox_email, $dropbox_password);
            $uploader->upload($tmpFile, $_POST['dest']);
     
            return '<span style="color: green;font-weight:bold;margin-left:0px;">File successfully uploaded. Thank you!</span>';
        } catch(Exception $e) {
            return '<span style="color: red;font-weight:bold;margin-left:0px;">Error: ' . htmlspecialchars($e->getMessage()) . '</span>';
        }
     
        // Clean up
        if (isset($tmpFile) && file_exists($tmpFile))
            unlink($tmpFile);
     
        if (isset($tmpDir) && file_exists($tmpDir))
            rmdir($tmpDir);
            
    } else {
        return '
        <div class="box" align="center">
                <h1>Dropbox Uploader Demo<br>
                </h1>
                <form method="POST" enctype="multipart/form-data">
                <input type="file" name="file" /><br><br>
                <input type="submit" value="Upload your file!" />
                <input style="display:none" type="text" name="dest" value="'.$dropbox_folder.'" />
        </div>    ';
    }
}
 
 
add_action('the_content', 'dbouploader'); 
?>