<?php

/**
 * @file plugins/pubIds/zenon/zenonIdPlugin.inc.php
 *
 *
 * @class zenonPubIdPlugin
 * @ingroup plugins_pubIds_zenon
 *
 * @brief zenon plugin class
 */


import('classes.plugins.PubIdPlugin');

class zenonIdPlugin extends PubIdPlugin {

	function getPubId($pubObject) {
		$storedPubId = $pubObject->getStoredPubId($this->getPubIdType());
		error_log("%%%%%%" . $storedPubId);
		if ($storedPubId) return $storedPubId;

		return $pubObject->getData('zenonId');
	}


	function getDisplayName() {
		return __('plugins.pubIds.zenon.displayName');
	}

	function getDescription() {
		return __('plugins.pubIds.zenon.description');
	}

	function getTemplatePath($inCore = false) {
		return parent::getTemplatePath($inCore) . 'templates/';
	}

	function getPubIdType() {
		return 'other::zenon';
	}

	function getPubIdDisplayType() {
		return 'zenonId';
	}

	function getPubIdFullName() {
		return 'zenonId';
	}

	function getResolvingURL($contextId, $pubId) {
		return "https://zenon.dainst.org/Record/" . $pubId;
	}

	function getPubIdMetadataFile() {
		return $this->getTemplatePath().'zenonIdEdit.tpl';
	}

	function addJavaScript($request, $templateMgr) {
		/*$templateMgr->addJavaScript(
			'urnCheckNo',
			$request->getBaseUrl() . DIRECTORY_SEPARATOR . $this->getPluginPath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'checkNumber.js',
			array(
				'inline' => false,
				'contexts' => 'publicIdentifiersForm',
			)
		);*/
	}

	function verifyData($fieldName, $fieldValue, $pubObject, $contextId, &$errorMsg) {
		return true;
	}

	function instantiateSettingsForm($contextId) {
		$this->import('classes.form.zenonSettingsForm');
		return new zenonSettingsForm($this, $contextId);
	}

	function getFormFieldNames() {
		return array("zenonId"); //'pub-id::other::zenon'
	}

	function getDAOFieldNames() {
		return array('pub-id::other::zenon');
	}


	/**
	 * abstract functions we don't use but need to implement
	 */

	function getPubIdAssignFile() {
		return "";
	}

	function constructPubId($pubIdPrefix, $pubIdSuffix, $contextId) {

		return "";
	}

	function getAssignFormFieldName() {
		error_log("HALLO" . get_class($this));
		return 'pub-id::other::zenon';
	}

	function getPrefixFieldName() {
		return '--';
	}

	function getSuffixFieldName() {
		return '';
	}

	function getLinkActions($pubObject) {
		return array();
	}

	function getSuffixPatternsFieldNames() {
		return array();
	}

	function isObjectTypeEnabled($pubObjectType, $contextId) {
		return ("Submission" == $pubObjectType);
	}

	function getNotUniqueErrorMsg() {
		return "[some error]";
	}



}

?>
