<?php

/**
 * @file plugins/pubIds/urn/classes/form/zenonSettingsForm.inc.php
 *
 *
 * @class URNSettingsForm
 * @ingroup plugins_pubIds_zenon
 *
 * @brief Form for journal managers to setup zenon plugin
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

	/** @var URNPubIdPlugin */
	var $_plugin;

	

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

		//parent::__construct($plugin->getTemplatePath() . 'settingsForm.tpl');

		$this->setData('pluginName', $plugin->getName());
	}

	/**
	 * Get the plugin.
	 * @return zenonIdPlugin
	 */
	function _getPlugin() {
		return $this->_plugin;
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
	function readInputData() {
		$this->readUserVars(array_keys($this->_getFormFields()));
	}

	/**
	 * @copydoc Form::validate()
	 */
	function execute() {
		$contextId = $this->_getContextId();
		$plugin = $this->_getPlugin();

	}


}

?>
