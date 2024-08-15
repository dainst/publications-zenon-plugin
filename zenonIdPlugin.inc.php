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

use APP\plugins\PubIdPlugin;

class zenonIdPlugin extends PubIdPlugin {

	/**
	 * @copydoc Plugin::register()
	 */
	public function register($category, $path, $mainContextId = null) {
		$success = parent::register($category, $path, $mainContextId);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return $success;
		if ($success && $this->getEnabled($mainContextId)) {
		// 	HookRegistry::register('CitationStyleLanguage::citation', array($this, 'getCitationData'));
		// 	HookRegistry::register('Publication::getProperties::summaryProperties', array($this, 'modifyObjectProperties'));
		// 	HookRegistry::register('Publication::getProperties::fullProperties', array($this, 'modifyObjectProperties'));
		// 	HookRegistry::register('Publication::validate', array($this, 'validatePublicationDoi'));
		// 	HookRegistry::register('Issue::getProperties::summaryProperties', array($this, 'modifyObjectProperties'));
		// 	HookRegistry::register('Issue::getProperties::fullProperties', array($this, 'modifyObjectProperties'));
		// 	HookRegistry::register('Galley::getProperties::summaryProperties', array($this, 'modifyObjectProperties'));
		// 	HookRegistry::register('Galley::getProperties::fullProperties', array($this, 'modifyObjectProperties'));
		//  HookRegistry::register('Publication::getProperties::values', array($this, 'modifyObjectPropertyValues'));
		// 	HookRegistry::register('Issue::getProperties::values', array($this, 'modifyObjectPropertyValues'));
		// 	HookRegistry::register('Galley::getProperties::values', array($this, 'modifyObjectPropertyValues'));
			HookRegistry::register('Form::config::before', array($this, 'addPublicationFormFields'));
		// 	HookRegistry::register('Form::config::before', array($this, 'addPublishFormNotice'));
	
		}
		return $success;
	}

	// function getPubId($pubObject) {

	// 	$zenonId = $pubObject->getData('zenonId');
	// 	if ($zenonId) {
	// 		$this->setStoredPubId($pubObject, $zenonId);
	// 		$pubObject->setData('zenonId', null);
	// 		return $zenonId;
	// 	}
	// 	$storedPubId = $pubObject->getStoredPubId($this->getPubIdType());
	// 	if ($storedPubId) return $storedPubId;
	// 	return "";
	// }

	/**
	 * Name in plugin list
	 */
	function getDisplayName() {
		return __('plugins.pubIds.zenon.displayName');
	}

	/**
	 * Description in plugin list
	 */
	function getDescription() {
		return __('plugins.pubIds.zenon.description');
	}

	function getPubIdType() {
		return 'other::zenon';
	}

	function getPubIdDisplayType() {
		return 'iDAI.bibliography/Zenon';
	}

	function getPubIdFullName() {
		return 'iDAI.bibliography/Zenon Fullname, wo taucht das auf?';
	}

	function getResolvingURL($contextId, $pubId) {
		return "https://zenon.dainst.org/Record/" . $pubId;
	}

	// function verifyData($fieldName, $fieldValue, $pubObject, $contextId, &$errorMsg) {
	// 	$pubObject->setData('pub-id::other::zenon', null); // THIS is really important. it's hack which makes the pub-id always changeable
	// 	return true;
	// }

	function getDAOFieldNames() {
		return array('pub-id::other::zenon');
	}

	/**
	 * Add Zenon ID to submission
	 *
	 * @param $hookName string <Object>::getProperties::summaryProperties or
	 *  <Object>::getProperties::fullProperties
	 * @param $args array [
	 * 		@option $props array Existing properties
	 * 		@option $object Submission|Issue|Galley
	 * 		@option $args array Request args
	 * ]
	 *
	 * @return array
	 */
	public function modifyObjectProperties($hookName, $args) {
		$props =& $args[0];

		$props[] = 'pub-id::other::zenon';
	}

	/**
	 * Add Zenon ID fields to the publication identifiers form
	 *
	 * @param $hookName string Form::config::before
	 * @param $form FormComponent The form object
	 */
	public function addPublicationFormFields($hookName, $form) {

		if ($form->id !== 'publicationIdentifiers') {
			return;
		}

		$fieldData = [
			'label' => $this->getPubIdDisplayType(),
			'value' => $form->publication->getData('pub-id::other::zenon'),
			'description' => __('plugins.pubIds.zenon.editor.description'),
			'submissionId' => $form->publication->getData('submissionId'),
			// 'assignIdLabel' => __('plugins.pubIds.zenon.editor.zenon.assignZenon'),
			// 'clearIdLabel' => __('plugins.pubIds.zenon.editor.clearObjectsZenon'),
		];
		$form->addField(new \PKP\components\forms\FieldPubId('pub-id::other::zenon', $fieldData));
	}

	/**
	 * abstract functions we don't use but need to implement
	 */


	/** 
	 * Because we inheriting base class PubIdPlugin we have to implement this method, 
	 * but have no use for it. This will just display a simple message.
	 * See 'templates/settingsForm.tpl'.
	 */
	function instantiateSettingsForm($contextId) {
		$this->import('classes.form.zenonSettingsForm');
		return new zenonSettingsForm($this, $contextId);
	}

	/** 
	 * Same as instantiateSettingsForm.
	 * See 'templates/zenonIdEdit.tmp'.
	 */
	function getPubIdAssignFile() {
		return $this->getTemplateResource('zenonIdEdit.tpl');
	}

	/** 
	 * Same as instantiateSettingsForm.
	 * See 'templates/zenonIdEdit.tmp'.
	 */
	function getPubIdMetadataFile() {
		return $this->getTemplateResource('zenonIdEdit.tpl');
	}

	function getFormFieldNames() {
		return array();
		// return array("zenonId"); //'pub-id::other::zenon'
	}

	function getAssignFormFieldName() {
		return '';
		// return 'assignZenon';
	}

	// function addJavaScript($request, $templateMgr) {
	// 	$templateMgr->addJavaScript(
	// 		'urnCheckNo',
	// 		$request->getBaseUrl() . DIRECTORY_SEPARATOR . $this->getPluginPath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'checkNumber.js',
	// 		array(
	// 			'inline' => false,
	// 			'contexts' => 'publicIdentifiersForm',
	// 		)
	// 	);
	// }

	function constructPubId($pubIdPrefix, $pubIdSuffix, $contextId) {
		return "";
	}

	function isObjectTypeEnabled($pubObjectType, $contextId) {
		return false;	
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

	function getNotUniqueErrorMsg() {
		return __('plugins.pubIds.zenon.editor.not_unique');
	}
}

?>
