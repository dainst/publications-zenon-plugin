<?php

/**
 * @file plugins/pubIds/urn/URNSettingsForm.inc.php
 *
 * Copyright (c) 2013-2016 Simon Fraser University Library
 * Copyright (c) 2003-2016 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class URNSettingsForm
 * @ingroup plugins_pubIds_urn
 *
 * @brief Form for journal managers to setup URN plugin
 */
/*
error_reporting(E_ALL & ~ E_DEPRECATED);
ini_set('display_errors', 'on');//*/

import('lib.pkp.classes.form.Form');

class zenonlinkForm extends Form {


	/** @var integer */
	var $_journalId;

	/** @var URNPubIdPlugin */
	var $_plugin;


	/**
	 * Constructor
	 * @param $plugin URNPubIdPlugin
	 * @param $journalId integer
	 */
	function zenonlinkForm(&$plugin, $journalId) {
		parent::Form($plugin->getTemplatePath() . '/templates/form.tpl');
	}


	/**
	 * @see Form::display()
	 */
	function display() {
		//$templateMgr =& TemplateManager::getManager();
		//$templateMgr->register_function('debugPubIDSettings', array($this, debugPubIDSettings));
		parent::display();
	}
	
	


	/**
	 * @see Form::initData()
	 */
	function initData() {

	}

	/**
	 * @see Form::readInputData()
	 */
	function readInputData() {

	}

	/**
	 * @see Form::validate()
	 */
	function execute() {

	}

}

?>
