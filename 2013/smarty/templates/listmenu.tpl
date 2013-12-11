{* smarty *}

<div class="menucaption">{$title}</div>
<div class="menu">

{* initialise counter *}
{counter start=0 print=false}

{foreach from=$list item="item"}
{if $listnumbers}{counter}. {/if}

{if $item.link}<a class="menuoption" href="{$item.link}">{/if}{$item.text|truncate:18:"...":true}{if $item.link}</a>{/if}<br>

{foreachelse}
No items.
{/foreach}

</div>
