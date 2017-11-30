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

		$zenonId = $pubObject->getData('zenonId');

		error_log("Zid" . $zenonId);



		if ($zenonId) {
			$this->setStoredPubId($pubObject, $zenonId);
			//$pubObject->setStoredPubId($this->getPubIdType(), $zenonId);
			$pubObject->setData('zenonId', null);

			return $zenonId;
		}



		$storedPubId = $pubObject->getStoredPubId($this->getPubIdType());
		error_log("sid" . $storedPubId);
		//error_log(print_r($pubObject->_data,1));
		if ($storedPubId) return $storedPubId;

		return "";
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
		$pubObject->setData('pub-id::other::zenon', null);
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
		return $this->getTemplatePath().'zenonIdEdit.tpl';
	}

	function constructPubId($pubIdPrefix, $pubIdSuffix, $contextId) {
		return "";
	}

	function getAssignFormFieldName() {
		return '';
	}

	function getPrefixFieldName() {
		return '';
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
