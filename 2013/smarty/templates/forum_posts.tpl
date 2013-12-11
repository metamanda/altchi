{* smarty *}

<script src="forum.js"></script>

{* <h1>Thread <a href="forum.php?action=showcategory&id={$category.id}">{$category.name}</a> &gt; *}
<div class="forumnav"><a href="forum.php">Forum</a> &gt; <a href="forum.php?action=showcategory&id={$category.id}">{$category.name}</a> &gt;
{if $thread.link}<a href="{$thread.link}">{/if}{$thread.subject}{if $thread.link}</a>{/if}</div>

{include file="screen_browser.tpl"}

<div class="forumposts">
<table width="100%">

{foreach from=$posts item="post"}

<tr class="postheader">
 <td>
  <table>
   <tr>
    <td id="post_header_{$post.id}" align="left">
     <a href="index.php?action=showuser&id={$post.user.id}">{$post.user.firstname} {$post.user.lastname}</a> wrote on {$post.posted|date_format:"%Y-%m-%d %H:%M"}
    </td>
    <td align="right">
     {if $post.edited}
     <span style="white-space:nowrap;">edited {$post.edited|date_format:"%Y-%m-%d %H:%M"}</span>
     {/if}
    </td>
    <td style="text-align: right;">
     <a href="javascript:quote('{$post.id}');">quote</a>
     {if $post.editable or $admin}
     <a href="forum.php?action=editpost&id={$post.id}&index={$index}"><span title="edit">edit</span></a>
     {/if}
     {if $admin or $userid==$post.userid}
     <a href="forum.php?action=deletepost&id={$post.id}&index={$index}"><span title="delete post">x</span></a>
     {/if}
    </td>
   </tr>
  </table>
 </td>
</tr>

<tr class="postbody">
 <td id="post_{$post.id}" colspan="100">
  {$post.post}
 </td>
</tr>

{foreachelse}

<tr><td colspan="100">
No posts.
</tr></td>

{/foreach}

</table>
</div>

{include file="screen_browser.tpl"}

{if $logged_in}
{if not $thread.locked}
<p>

<form method="post" action="forum.php?action=showthread&id={$thread.id}">
New post:<br>
<textarea id="input_post" name="post"></textarea><br>
<input type="submit" value="Submit">
</form>

</p>
{/if}
{/if}
