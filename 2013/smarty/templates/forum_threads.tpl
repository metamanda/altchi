{* smarty *}

{foreach from=$error item="msg"}
<span class="errormessage">{$msg}</span><br>
{/foreach}

{* <h1>Threads in <a href="forum.php">{$category.name}</a></h1> *}
<div class="forumnav"><a href="forum.php">Forum</a> &gt; {$category.name}</div>
<p>
{$category.description}
</p>

{if $logged_in}
{if not $category.locked}
<p>
<form method="post" action="forum.php?action=showcategory&id={$category.id}">
New thread <input type="text" name="subject"> <input type="submit" value="Ok"><br>
</form>
</p>
{/if}
{/if}

{include file="screen_browser.tpl"}

<div class="list">

<table id="forumthreads" class="forum">
<tr>
<th style="width: 100%;">Subject</th>
<th style="width: 1px;">Started</th>
<th style="width: 1px;" nowrap><span style="white-space:nowrap;">Last Post</span></th>
<th style="width: 1px;" nowrap><span style="white-space:nowrap;">New posts</span></th>
{if $admin}
<th style="width: 1px;">Controls</th>
{/if}
</tr>
{foreach from=$threads item="thread"}
<tr>
<td style="width: *;"><a href="forum.php?action=showthread&id={$thread.id}">{$thread.subject}</a></td>
<td style="width: 1px;" nowrap><span style="white-space:nowrap">{$thread.started|date_format:"%Y-%m-%d"}</span></td>
<td style="width: 1px;" nowrap><span style="white-space:nowrap">{$thread.last_posted|date_format:"%Y-%m-%d %H:%M"}</span></td>
<td style="width: 1px; text-align: center;">{$thread.newposts}</td>

{if $admin}
<td align="right" style="width: 1px;"><a href="forum.php?action=deletethread&id={$thread.id}&index=$index">delete</a></td>
{/if}

</tr>

{foreachelse}

<tr><td colspan="100">
No threads.
</td></tr>

{/foreach}

</table>

{include file="screen_browser.tpl"}

</div>
