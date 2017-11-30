{load_script context="publicIdentifiersForm" scripts=$scripts}

{assign var=pubObjectType value=$pubIdPlugin->getPubObjectType($pubObject)}


{if $pubObjectType == "Submission"}
	{assign var=storedPubId value=$pubIdPlugin->getPubId($pubObject)}
	{fbvFormArea id="pubIdZenonFormArea" class="border" title="plugins.pubIds.zenon.displayName"}
		{assign var=formArea value=true}

		{fbvFormSection}
			{fbvElement type="text" label="plugins.pubIds.zenon.displayName" id="zenonId" value=$storedPubId size=$fbvStyles.size.MEDIUM inline=true }
		{/fbvFormSection}

	{/fbvFormArea}

{/if}
