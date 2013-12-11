{* smarty *}

<h1>Search for {$searchtext}</h1>

<div class="list">

<table>
{foreach from=$searchresults item="hit"}
<tr>
<td><a href="{$hit.link}">{$hit.text}</a></td>
</tr>
{/foreach}
</table>

</div>
