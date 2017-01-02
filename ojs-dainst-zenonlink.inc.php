<?php
/**
 * Super small Plugin to show Zenonlinks in the the Meta-Sector of Articles, wich are stored by the OJS-dainst-importer.
 * 
 * 
 * ojsDainstZenonlink  class
 * 
 */

import('classes.plugins.PubIdPlugin');

class ojsDainstZenonlink extends PubIdPlugin {

	/**
	 * @see PubIdPlugin::register()
	 */
	function register($category, $path) {
		$success = parent::register($category, $path);
		$this->addLocaleData();
		return $success;
	}

	/**
	 * @see PKPPlugin::getName()
	 */
	function getName() {
		return 'ojsDainstZenonlink';
	}

	/**
	 * @see PKPPlugin::getDisplayName()
	 */
	function getDisplayName() {
		return __('plugins.pubIds.ojsDainstZenonlink.displayName');
	}

	/**
	 * @see PKPPlugin::getDescription()
	 */
	function getDescription() {
		return __('plugins.pubIds.ojsDainstZenonlink.description');
	}


	/**
	 * 
	 * normally you would create PubId here if not present, but we only want ot display if there was stored something by the importer
	 * 
	 * @see PubIdPlugin::getPubId()
	 */
	function getPubId(&$pubObject, $preview = false) {
		return $pubObject->getStoredPubId($this->getPubIdType());
	}

	/**
	 * @see PubIdPlugin::getPubIdType()
	 */
	function getPubIdType() {
		return 'other::zenon';
	}

	/**
	 * @see PubIdPlugin::getPubIdDisplayType()
	 */
	function getPubIdDisplayType() {
		return 'Zenon';
	}

	/**
	 * @see PubIdPlugin::getPubIdFullName()
	 */
	function getPubIdFullName() {
		return 'Zenon / iDai.bibliography identifier';
	}

	/**
	 * @see PubIdPlugin::getResolvingURL()
	 */
	function getResolvingURL($journalId, $pubId) {
		return "http://zenon.dainst.org/Record/$pubId";
	}

	/**
	 * @see PubIdPlugin::getDAOFieldNames()
	 */
	function getDAOFieldNames() {
		return array('pub-id::other::zenon');
	}

	/**
	 * @see PubIdPlugin::getPubIdMetadataFile()
	 */
	function getPubIdMetadataFile() {

		return $this->getTemplatePath().'template.tpl';
	}
	
	/**
	 * @see PubIdPlugin::getSettingsFormName()
	 */
	function getSettingsFormName() {
		return 'classes.zenonlinkForm';
	}
	
	/**
	 * @see PubIdPlugin::verifyData()
	 */
	function verifyData($fieldName, $fieldValue, &$pubObject, $journalId, &$errorMsg) {
		return true;
	}
	
	function isEnabled($pubObjectType, $journalId) {
		return ($pubObjectType == 'Article');
	}


}



?>