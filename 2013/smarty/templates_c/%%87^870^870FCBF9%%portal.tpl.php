<?php /* Smarty version 2.6.13, created on 2013-12-10 04:03:35
         compiled from portal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'portal.tpl', 34, false),)), $this); ?>


<h1>Welcome!</h1>


<p>

<!--If you are disappointed with the number of reviews your paper has received, feel free to ask people who you think would be appropriate reviewers to review it</b>: all we ask is that reviewers avoid outright conflicts of interest and publicly state any pre-existing relationship where appropriate.  We do not guarantee or attempt to ensure that every paper is reviewed: this is an inherent part of the alt.chi reviewing process.
-->
<!--p><b>We are now open for submission!</b> You can revise and update your submission as needed until the deadline, at <b>17:00 PST, January 9</b>. Currently, our "edit submission" page does not allow you to re-upload a file. If you want to replace your PDF, just create a new submission for it, and delete your old one.</p-->
<p>
<p><b>The alt.chi deadline has passed, and submissions are now closed.</b> We owe a special thank you to <a href="index.php?action=englishreview">our volunteer English reviewers</a> for all the work they put in before the alt.chi deadline.</p>
<p><b>The reviewing period has ended, but you can still leave comments.</b></p>
<!-- b>We are now open for reviewing and other discussion.</b> Please take the time to participate in the discussions.  You will be required to review a minimum of three papers for each submission, and may informally comment on as many as you would like. Authors are encouraged to participate in discussions about their paper, responding to review and comments. Dialog is good!
</p>
<p>
<b>Reviews will be due by 3 February at the very latest.</b>  Please get your reviews in as soon as possible!  In addition, if you see a paper and you know someone who would be a good reviewer for it, please point them at it.  We'd like to see a wide pool of reviewers.  
</p-->
<!--p>Reviewing will take place from <b>January 14 until February 3</b>. Please feel free to ask people who you think would be appropriate reviewers to review your paper: all we ask is that reviewers avoid outright conflicts of interest and publicly state any pre-existing relationship where appropriate.</p-->
<p><b>Between 3 February and 11 February</b> a jury of experts will deliberate over the body of papers and reviews. Your reviews will be weighed heavily in this decision process; the jury will help us select a set of presentations that will gracefully balance quality, appropriateness, and the ability to stimulate discussion.</p>
<p><b>Anyone can see submissions and associated discussion.</b> We only require logging in to submit paper and to post reviews or comments.</p>
<p>
We'd be interested in hearing your suggestions for how to improve alt.chi next year.  You can email the chairs directly at <a href=mailto:alt.chi@chi2013.acm.org>alt.chi@chi2013.acm.org</a>.
</p>

<h2><a name="papers">My papers</a></h2>
<div class="list">

<?php $_from = $this->_tpl_vars['submissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submission']):
?>
<p class="submissionitem">
	<span class="submissiontitle">
	<a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60, "...") : smarty_modifier_truncate($_tmp, 60, "...")); ?>
</a>
	</span><br />
	
	<span class="submissionactivity">
	Most recent activity 
	<?php if ($this->_tpl_vars['submission']['latestdate'] == 0): ?>
		today	
	<?php elseif ($this->_tpl_vars['submission']['latestdate'] == 1): ?>
		yesterday
	<?php else: ?> 
		<?php echo $this->_tpl_vars['submission']['latestdate']; ?>
 days ago	
	<?php endif; ?>	
	
	|
	
	<?php if ($this->_tpl_vars['submission']['numnewposts'] > 1): ?>
		<?php echo $this->_tpl_vars['submission']['numnewposts']; ?>
 new posts since last login.
	<?php elseif ($this->_tpl_vars['submission']['numnewposts'] == 1): ?>
		1 new post since last login.
	<?php else: ?>
		no new posts since last login.
	<?php endif; ?>
	
	</span>
</p>
<?php endforeach; else: ?>
<p>No papers.</p>
<?php endif; unset($_from); ?>

<a class="portalaction" href="submission.php">Submit new contribution</a><br/>

</div>

<h2 id="reviews"><a name="reviews">My Reviews</a></h2>
<p><em>Remember, for each paper you submit, you and your co-authors must review at least three other papers before it is eligble for publication</em></p>

<div class="list">

<?php $_from = $this->_tpl_vars['reviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['review']):
?>
	<?php if ($this->_tpl_vars['review']['submission']['title'] != ""): ?>  
		<p class="reviewitem">
	<a href="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['review']['submission']['id']; ?>
"><?php echo $this->_tpl_vars['review']['submission']['title']; ?>
</a>

			<br />
		<span class="submissionactivity">
		Most recent activity 
		<?php if ($this->_tpl_vars['review']['latestdate'] == 0): ?>
			today	
		<?php elseif ($this->_tpl_vars['review']['latestdate'] == 1): ?>
			yesterday
		<?php else: ?> 
			<?php echo $this->_tpl_vars['review']['latestdate']; ?>
 days ago	
		<?php endif; ?>	
		| <?php echo $this->_tpl_vars['review']['commentcount']; ?>
 posts since you last posted.
		</span>
		</p>
		<?php endif;  endforeach; else: ?>
	<p>No reviews yet.</p>
<?php endif; unset($_from); ?>

<a class="portalaction" href="index.php?action=submissions&sortby=date&dir=1&simple">View all papers</a><br/>
</div>