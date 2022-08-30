<div>Not implemented.</div>

{* {load_script context="publicIdentifiersForm" scripts=$scripts}

{assign var=pubObjectType value=$pubIdPlugin->getPubObjectType($pubObject)}
{assign var=enabledZenonPlugin value=$pubIdPlugin->isObjectTypeEnabled($pubObjectType, $currentContext->getId())}

{if $enabledZenonPlugin}
	{assign var=storedPubId value=$pubIdPlugin->getPubId($pubObject)}
	{fbvFormArea id="pubIdZenonFormArea" class="border" title="plugins.pubIds.zenon.displayName"}
		{assign var=formArea value=true}

		{fbvFormSection}
			{fbvElement type="text" label="plugins.pubIds.zenon.label" id="zenonId" value=$storedPubId size=$fbvStyles.size.MEDIUM inline=true }
		{/fbvFormSection}

	{/fbvFormArea}

	{if $storedPubId}
		<a href="{$pubIdPlugin->getResolvingURL(1, $storedPubId)}" target="_blank">	{$pubIdPlugin->getResolvingURL(1, $storedPubId)}</a>
	{else}
		<a href="https://zenon.dainst.org/Search/Results?lookfor={$pubObject->getLocalizedTitle()}&type=Title&limit=20&sort=relevance" target="_blank">
			{translate key="plugins.pubIds.zenon.lookup"}
		</a>
	{/if}
{/if} *}
