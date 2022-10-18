<?php

/*
Plugin Name: Custom Database
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: wpfrogs
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

if( ! defined('ABSPATH') ) exit; //exit if accessed directly
require_once "inc/generatePets.php";

class PetAdooptionPlugin {

	public function __construct() {
		global $wpdb;
		$this->charset = $wpdb->get_charset_collate();
		$this->tablename = $wpdb->prefix . "pets";
		add_action('activate_CustomDatabase/Custom-database.php', array($this, 'onActivation'));
		add_action('admin_head', array($this, 'onAdminRefresh'));
		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
		add_filter('template_include', array($this, 'loadTemplate'));
	}

	public function onActivation()
	{
		require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta("CREATE TABLE $this->tablename (
           id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
           birthYear smallint(5) NOT NULL DEFAULT 0,
           petWeight smallint(5) NOT NULL DEFAULT 0,
           favFood varchar(60) NOT NULL DEFAULT '',
           favColor varchar(60) NOT NULL DEFAULT '',
           favGame varchar(60) NOT NULL DEFAULT '',
           favTime varchar(60) NOT NULL DEFAULT '',
           favHobby varchar(60) NOT NULL DEFAULT '',
           PRIMARY KEY  (id)  
        ) $this->charset;");
	}

	public function onAdminRefresh()
	{
       global $wpdb;
	   $wpdb->insert($this->tablename, generatePets());
	}

	public function loadScripts()
	{

	}

	public function loadTemplate()
	{

	}

}

new PetAdooptionPlugin();