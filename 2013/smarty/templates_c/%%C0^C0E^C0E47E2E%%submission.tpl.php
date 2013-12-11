<?php /* Smarty version 2.6.13, created on 2013-01-09 22:33:03
         compiled from submission.tpl */ ?>

<script src="submission.js"></script>

<?php $_from = $this->_tpl_vars['formerror']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
<span class="errormessage"><?php echo $this->_tpl_vars['msg']; ?>
</span><br>
<?php endforeach; endif; unset($_from); ?>

<?php if (! $this->_tpl_vars['success']): ?>

<h1>Submit a contribution</h1>

<div class="topmessage">
	<p><b>Please note:</b></p>
	<p>By submitting a paper, you agree to review at least three other alt.chi papers.	</p>
	<p>
	The reviews can be written be the main author, one of the co-authors, or other people selected by the authors; however, 
	the main submitter is personally responsible for ensuring the quality and quantity of the reviews.	
	</p>
	<p>
	You are welcome to provide more than three reviews.  You can also comment as much as you like, but this will not count towards your 
	review quota.
	</p>
	<p>
	All submissions must be a maximum of 10 pages in <a href="http://chi2012.acm.org/cfp-formatting-instructions.shtml#extendedformat">Extended Abstracts</a>
	format.
	</p>
</div>

<div class="wide" class="noborder">
	<div class="formtable" id="submitlist">

		<form method="post" action="submission.php?action=review" enctype="multipart/form-data"><ul><p></p>
		<ul>
			<li>
			<label class="formtablelabel">Title</label>
			<input class="field" type="text" name="title" value="<?php echo $this->_tpl_vars['form']['title']; ?>
">
			</li>
			
			<li>
			<label class="formtablelabel">All authors</label>
			<?php if ($this->_tpl_vars['form']['authors'] == ""): ?>
				<input class="field" type="text" name="authors" value="Firstauthor, A., Secondauthor, B., and Thirdauthor, C.D."
				onfocus="this.value=''";>
			<?php else: ?>
				<input class="field" type="text" name="authors" value="<?php echo $this->_tpl_vars['form']['authors']; ?>
">
			<?php endif; ?>
			</li>
			
			<li>
			<label class="formtablelabel">Keywords</label>
			<input class="field" type="text" name="keywords" value="<?php echo $this->_tpl_vars['form']['keywords']; ?>
">
			</li>
			
			<li class="bigger">
			<label class="formtablelabel">Submission history</label>
			<textarea id="input_history" name="history"><?php echo $this->_tpl_vars['form']['history']; ?>
</textarea><br />
			Please note here if all or parts of this submission has been previously presented, or if it is currently under review at CHI
			or any other conference or journal. <b>If you are resubmitting a paper that you have previously submitted as a full CHI paper,
            please let us know here, and explain why you think this will be a good fit for alt.chi, specifically.</b> 
			</li>

			<li class="bigger">
			<label class="formtablelabel">Abstract</label>
			<textarea id="input_abstract" name="abstract"><?php echo $this->_tpl_vars['form']['abstract']; ?>
</textarea><br />
			</li>

			<li class="bigger">
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			<label class="formtablelabel">Upload file</label>
			  <input class="field" type="file" name="userfile"><br />
			  If greater than 2MB, upload elsewhere and submit the link below.<br/>
              Your filename should contain only alphanumeric characters. Quote and apostrophes don't play well with our system.
			</li>

			<li>
			<label class="formtablelabel">Link to Paper</label>
			<input class="field" type="text" name="link" value="<?php echo $this->_tpl_vars['form']['link']; ?>
">
			</li>

			<li>
            <label class="formtablelabel">Link to Video (optional)</label>
            <input class="field" type="text" name="videolink" value="<?php echo $this->_tpl_vars['form']['videolink']; ?>
" />
            </li>
            
            <li>
            <label class="formtablelabel">Comments (optional)</label>
            <textarea id="input_comments" name="comments"><?php echo $this->_tpl_vars['form']['comments']; ?>
</textarea><br/>
            </li>
            
			<li>&nbsp;</li>
			
			<li class="checkboxli">
			I confirm...
			</li>
			<li class="checkboxli">
			<input type="checkbox" id="check1" name="agreement" value="checked">
			<label for="check1">my paper is no more than 10 pages long in Extended Abstract format, including all references and figures.</label>
			</li>
			
			<li class="checkboxli">
			<input type="checkbox" id="check2" name="agreement" value="checked">
			<label for="check2">my paper is camera ready, not anonymized, and can be printed as is from the PDF.</label>
			</li>
			
			<li class="checkboxli">
			<input type="checkbox" id="check3" name="agreement" value="checked">
			<label for="check3">that I or my co-authors will write at least 3 reviews of other alt.chi papers, 
			or my paper will not be accepted for publication.</label>
			</li>

			<li>&nbsp;</li>
			
			
			<?php if ($this->_tpl_vars['admin']): ?>
			<p>
			<li>
			<label class="formtablelabel">Admin only: hidden
			<input type="checkbox" name="hidden"></label></p>
			</li>
			<?php endif; ?>

			<?php echo '
			<script>
			<!-- 
			function checktheboxes() {
				if ((document.getElementById(\'check1\').checked!=1) || (document.getElementById(\'check2\').checked!=1) || (document.getElementById(\'check3\').checked!=1))
					{
					alert(\'You must agree to all conditions before submitting.\'); 
					return false;
					}
				else
					{
					return true;
					}
			}
			//-->
			</script>
			'; ?>

			<li><input type="submit" value="Submit" onclick="return checktheboxes()"></li>
		</ul>
		
		
		</form>
	</div>
</div>
<?php else: ?>
Submission successful!<br>
<?php endif; ?>


