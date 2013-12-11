{* smarty *}

<h1>Edit post</h1>

{if $isreview}
<p class='warning'>Please note! You cannot change your review scores after submitting.  To change them, you must submit a new review.</p>
{/if}

<h3>Post</h3>

<form method="post" action="index.php?action=editpost&id={$post.id}&index={$index}">
<textarea rows=5 cols=60 name="post">{$post.post}</textarea>
<br>
<input type="submit" name="button" value="Save">
<input type="button" value="Cancel" onClick="document.location = 'index.php?action=showsubmission&id={$post.threadid}&index={$index}';">
</form>
