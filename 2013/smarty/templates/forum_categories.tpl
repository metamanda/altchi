{* smarty *}

{foreach from=$error item="msg"}
<span class="errormessage">{$msg}</span><br>
{/foreach}

<h1>Categories</h1>

{foreach from=$categories item="category"}
<h2>
<a href="forum.php?action=showcategory&id={$category.id}">{$category.name}</a>
{if $logged_in}
{if $category.newposts>0}
-
{$category.newposts} new posts since last logged in.
{/if}
{else}
{* {$category.newposts} posts. *}
{/if}
</h2>
<div class="textbox">
{$category.description}
</div>
{foreachelse}
No categories.
{/foreach}

{if $admin}
<hr>
<h2>Add Category</h2>
<form method="post" action="forum.php?action=addcategory">
Name: <input type="text" name="categoryname" value="{$form.name}" style="width:100%"><br>
Description:<br>
<textarea name="categorydescription">{$form.categorydescription}</textarea><br>
<input type="submit" value="submit">
</form>
{/if}
