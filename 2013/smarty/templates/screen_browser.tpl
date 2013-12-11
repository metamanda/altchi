{* smarty *}

{*

$index - pagenumber
$numitemsshow - constant telling the number of items shown per screen
$numscreen - total number of screens
$numitems - total number of items
$script - script name (without &index=)

*}

{*
{if $numitems>0}
Items {$index*$numitemsshow+1} to

{if $index<$numscreens-1}
{$index*$numitemsshow+$numitemsshow}
{else}
{$numitems}
{/if}

of {$numitems}

{if $numitems>$numitemsshow}

{if $numscreens>1}
{if $index>0}
<a href="{$script}&index={$index-1}">prev</a>
{/if}
{if $index<$numscreens-1}
<a href="{$script}&index={$index+1}">next</a>
{/if}
<br>
{/if}

{/if}

{/if}
*}
{*
<div class="screenbrowser">

Page:
{section name=forloop start=1 loop=$numscreens+1 step=1}
{if $smarty.section.forloop.index==$index+1}
{$smarty.section.forloop.index}
{else}
<a href="{$script}&index={$smarty.section.forloop.index-1}">{$smarty.section.forloop.index}</a>
{/if}
{/section}

</div>
*}