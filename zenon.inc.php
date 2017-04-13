<?php
/**
 * Super small Plugin to show Zenonlinks in the the Meta-Sector of Articles, wich are stored by the OJS-dainst-importer.
 * 
 * 
 * ojsDainstZenonlink  class
 *
 * 
 * *MUST* be installed under ojs/plugins/puIds/zenonlink
 * 
 * @TODO: irgendwas stimmt mit dem Namen nicht... in der DB steht zenonlinkPubIdsPlugin, es soll aber nur zenon heißen
 * 
 */

import('classes.plugins.PubIdPlugin');

class zenon extends PubIdPlugin {

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
		return 'zenon';
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

		$zenonAsSetting = $pubObject->getData("zenon_id");
		if ($zenonAsSetting !== null) {
			$type = $this->getPubObjectType($pubObject);
			if ($type == "Article") {
				$this->setStoredPubId($pubObject, $type, $zenonAsSetting);
			}
		}
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
	 * @see PubIdPlugin::getPubIdMetadataFile()
	 */
	function getPubIdMetadataFile() {
		return $this->getTemplatePath().'templates/metadata.tpl';
	}

	/**
	 * @see PubIdPlugin::getDAOFieldNames()
	 */
	function getDAOFieldNames() {
		return array('zenon_id');
	}

	/**
	 * @see PubIdPlugin::getFormFieldNames()
	 */
	function getFormFieldNames() {
		return array('zenon_id');
	}

	function getExcludeFormFieldName() {
		return "yolon";
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
