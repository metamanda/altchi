{* smarty *}

<div>

{foreach from=$commitments item="commitment"}

Submission: {$commitment.submission.title}
<br/>
Reviewer: {$commitment.user.firstname} {$commitment.user.lastname}
<br/>
<br/>

{/foreach}

</div>
