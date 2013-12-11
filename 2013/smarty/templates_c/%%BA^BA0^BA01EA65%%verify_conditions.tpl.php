<?php /* Smarty version 2.6.13, created on 2013-12-10 02:04:20
         compiled from verify_conditions.tpl */ ?>

<form method="POST" action="login.php?action=verify&user=<?php echo $this->_tpl_vars['user']; ?>
&code=<?php echo $this->_tpl_vars['code']; ?>
">

<h1>Verification</h1>

<h2>Conditions</h2>

<p>
To take part in the alt.chi review process (including submitting and reviewing contributions, and posting in on-line discussions) you must agree to the following conditions.
</p>

<p>
<b>No cheating</b>:
<br>
I agree to not attempt to maliciously influence the reviewing and selection process, e.g. by submitting reviews under false names, coercing others into writing biased reviews, etc.
</p>

<p>
<b>Full disclosure</b>:
<br>
As reviewer, I agree to provide full information on my relationship to the authors of each submission I review, as well as any other information that may influence my objectivity.
<br>
As submitter, I agree to provide full information on all factors that could affect the fair judgment of my submission's suitability for presentation at CHI 2013, e.g. if all or part of it has been previously published, if it is currrently under review at CHI or any other conference or journal, etc.
</p>

<p>
<b>Be nice</b>:
<br>
I agree to keep the alt.chi forum a welcoming and civil place for open-minded discussions. This includes not using offensive language, refraining from personal attacks, and keeping discussions reasonably on topic.
</p>

<p>
Anyone who is found to break this agreement will have all their submissions, reviews and forum posts immediately removed from the site.
</p>

<input type="hidden" value="true" name="agreement">

<input type="submit" name="agreement" value="I agree">
<input type="button" value="I don't agree" onclick="document.location='login.php?action=dontagree'">
</form>

<p>
Apart from the lack of anonymity, these conditions should be the same as for any other peer-review process. If you have any concerns, please contact the alt.chi chairs before you agree.
</p>