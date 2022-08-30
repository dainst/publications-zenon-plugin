<?php

/**
 * @file plugins/pubIds/urn/classes/form/URNSettingsForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class zenonSettingsForm
 * @ingroup plugins_pubIds_zenon
 *
 * @brief Form for journal managers to setup Zenon plugin
 * 
 */


import('lib.pkp.classes.form.Form');

class zenonSettingsForm extends Form {

	//
	// Private properties
	//
	/** @var integer */
	var $_contextId;

	/**
	 * Get the context ID.
	 * @return integer
	 */
	function _getContextId() {
		return $this->_contextId;
	}

	/** @var zenonIdPlugin */
	var $_plugin;

	/**
	 * Get the plugin.
	 * @return zenonIdPlugin
	 */
	function _getPlugin() {
		return $this->_plugin;
	}

	//
	// Constructor
	//
	/**
	 * Constructor
	 * @param $plugin zenonIdPlugin
	 * @param $contextId integer
	 */
	function __construct($plugin, $contextId) {
		$this->_contextId = $contextId;
		$this->_plugin = $plugin;

		parent::__construct($plugin->getTemplateResource('settingsForm.tpl'));

		$this->setData('pluginName', $plugin->getName());
	}

	/**
	 * @copydoc Form::initData()
	 */
	function initData() {
		$contextId = $this->_getContextId();
		$plugin = $this->_getPlugin();
	}

	/**
	 * @copydoc Form::readInputData()
	 */
	function readInputData() { }

	//
	// Private helper methods
	//
	function _getFormFields() {
		return array();
	}
}


