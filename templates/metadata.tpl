{if $pubObject}
	{assign var=pubObjectType value=$pubIdPlugin->getPubObjectType($pubObject)}
	{if $pubObjectType=="Article"}
		<h3>Zenon-Id</h3>
		<table width="100%" class="data">
			<tr valign="top">
				<td width="20%">
					Zenon-Id
				</td>
				<td>
					<input type="text" value="{$pubIdPlugin->getPubId($pubObject, true)|escape}" name="zenon_id"></input>
					<a href="https://zenon.dainst.org/Record/{$pubIdPlugin->getPubId($pubObject, true)|escape}" target="_blank">https://zenon.dainst.org/Record/{$pubIdPlugin->getPubId($pubObject, true)|escape}</a>
				</td>
			</tr>
		</table>
	{/if}
{/if}