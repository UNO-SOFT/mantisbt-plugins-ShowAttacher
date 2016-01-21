<?php
# :vim set noet:

define(MANTIS_DIR, dirname(__FILE__) . '/../..' );
define(MANTIS_CORE, MANTIS_DIR . '/core' );

require_once(MANTIS_DIR . '/core.php');
require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

class ShowAttacherPlugin extends MantisPlugin {
	function register() {
		$this->name = 'ShowAttacher';	# Proper name of plugin
		$this->description = 'Show the attacher beside the attachment';	# Short description of the plugin
		$this->page = 'config';		   # Default plugin page

		$this->version = '0.1';	 # Plugin version string
		$this->requires = array(	# Plugin dependencies, array of basename => version pairs
			'MantisCore' => '1.3.0',  #   Should always depend on an appropriate version of MantisBT
			);

		$this->author = 'Tamás Gulácsi';		 # Author/team name
		$this->contact = 'T.Gulacsi@unosoft.hu';		# Author/team e-mail address
		$this->url = 'http://www.unosoft.hu';			# Support webpage
	}

	function config() {
		return array(
			'users_always_monitor' => array(),
		);
	}

	function hooks() {
		return array(
			'EVENT_VIEW_BUG_ATTACHMENT' => 'view_bug_attachment',
		);
	}

	function view_bug_attachment($p_event, $p_attachment) {
		log_event( LOG_EMAIL_RECIPIENT, "event=$p_event params=".var_export($p_attachment, true) );
		require_once( MANTIS_CORE . '/bug_api.php' );
		require_once( MANTIS_CORE . '/user_api.php' );
		return '';
	}

}
