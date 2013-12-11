{*smarty*}
{foreach from=$authorSubmissions item="submission"}
"{$submission.title}","{$submission.user.firstname} {$submission.user.lastname}",{$submission.additionalauthors}<br/>
{foreach from=$submission.additionalauthors item="addauthor"}
additional author: {$addauthor} <br/>
{/foreach}
{/foreach}