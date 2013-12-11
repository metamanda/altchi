<?php /* Smarty version 2.6.13, created on 2013-12-10 03:28:52
         compiled from show_submission.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'show_submission.tpl', 20, false),array('modifier', 'escape', 'show_submission.tpl', 44, false),array('modifier', 'date_format', 'show_submission.tpl', 61, false),array('modifier', 'nl2br', 'show_submission.tpl', 82, false),array('modifier', 'truncate', 'show_submission.tpl', 131, false),)), $this); ?>

<h1>
<span name="edits" id="title"><?php echo $this->_tpl_vars['submission']['title']; ?>
</span>
</h1>
<?php if ($this->_tpl_vars['userid'] == $this->_tpl_vars['submission']['user']['id']): ?>
<!--a href="index.php?action=updatesubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
">edit</a>
<br-->
<a href="index.php?action=deletesubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
" onclick="return confirm('Are you sure you want to delete this submission?')">delete submission</a><br>
<p>
<?php elseif ($this->_tpl_vars['userid']['status'] == 1): ?>
<a href="index.php?action=updatesubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
">edit</a>
<br>
<a href="index.php?action=deletesubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
" onclick="return confirm('Are you sure you want to delete this submission?')">delete submission</a><br>
<p>
<?php endif; ?>

<?php echo smarty_function_counter(array('name' => 'reviewcounter','start' => 0,'print' => false,'assign' => 'reviewcount'), $this);?>


<div class="list">

<table>

<tr>
<td class="listcaption" nowrap>Submitted by</td>
<td><a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['submission']['user']['id']; ?>
"><?php echo $this->_tpl_vars['submission']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['submission']['user']['lastname']; ?>
</a></td>
</tr>
<tr>
<td class="listcaption" nowrap>Affiliation</td>
<td><?php echo $this->_tpl_vars['submission']['user']['affiliation']; ?>
</td>
</tr>
<?php if ($this->_tpl_vars['submission']['additionalauthors']): ?>
<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap">All authors</span></td>
<td><?php echo $this->_tpl_vars['submission']['additionalauthors']; ?>
</td>
</tr>
<?php endif; ?>

<tr>
<td class="listcaption">Keywords</td>
<td>
<?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['keywords'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

</td>
</tr>

<tr>
<td class="listcaption">Paper link</td>
<td>
<?php if ($this->_tpl_vars['submission']['link']): ?>
<a href="<?php echo $this->_tpl_vars['submission']['link']; ?>
">Go to (external link)</a><br>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['submission']['url']; ?>
">Download</a><br>
<?php endif; ?>
</td>
</tr>

<tr>
<td class="listcaption">Submitted</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['submitted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</td>
</tr>

<?php if ($this->_tpl_vars['submission']['edited']): ?>
<tr>
<td class="listcaption" nowrap>Last edited</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['edited'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
</td>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['submission']['extras']):  $_from = $this->_tpl_vars['submission']['extras']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
<tr>
<td class="listcaption" nowrap><span style="white-space:nowrap"><?php echo ((is_array($_tmp=$this->_tpl_vars['field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</span></td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['field']['content'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from);  endif; ?>

<tr>
<td class="listcaption">Submission history</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['history'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
</tr>

<tr>
<td class="listcaption">Abstract</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']['abstract'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
</tr>

<?php if ($this->_tpl_vars['submission']['videolink']): ?>
<tr>
<td class="listcaption">Video link</td>
<td><a href="<?php echo $this->_tpl_vars['submission']['videolink']; ?>
">See Video (external link)</a></td>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['submission']['comments']): ?>
<tr>
<td class="listcaption">Author Comments</td>
<td><?php echo $this->_tpl_vars['submission']['comments']; ?>
</td>
</tr>
<?php endif; ?>

</table>
</div>
<br/><br/>

<script src="forum.js"></script>

<div class="forumnav">



<?php if ($this->_tpl_vars['thread']['link']): ?><a href="<?php echo $this->_tpl_vars['thread']['link']; ?>
"><?php endif;  echo $this->_tpl_vars['thread']['subject'];  if ($this->_tpl_vars['thread']['link']): ?></a><?php endif; ?></div>


<div class="forumposts">
<table width="100%">

<?php $_from = $this->_tpl_vars['posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['post']):
?>

<tr class="postheader">
 <td>

 <table width=100%>
   <tr>   
    <td id="post_header_<?php echo $this->_tpl_vars['post']['id']; ?>
" align="left">
     <?php if ($this->_tpl_vars['post']['user']['firstname'] != "" || $this->_tpl_vars['post']['user']['lastname'] != ""): ?>
     <a href="index.php?action=showuser&id=<?php echo $this->_tpl_vars['post']['user']['id']; ?>
"><?php echo $this->_tpl_vars['post']['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['post']['user']['lastname']; ?>
</a>, <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['user']['affiliation'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40) : smarty_modifier_truncate($_tmp, 40)); ?>
<br> wrote on <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
<br>
     <?php else: ?>
     [user deleted]<br />wrote on <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
<br>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['post']['edited']): ?>
     - edited <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['edited'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>

     <?php endif; ?>
    </td>
    <td style="text-align: right;">
     <a href="javascript:quote('<?php echo $this->_tpl_vars['post']['id']; ?>
');">quote</a>
          <?php if ($this->_tpl_vars['admin'] || $this->_tpl_vars['userid'] == $this->_tpl_vars['post']['userid']): ?>
          <a href="javascript:deletePost('<?php echo $this->_tpl_vars['post']['id']; ?>
','<?php echo $this->_tpl_vars['index']; ?>
');"><span title="delete post">x </span></a>&nbsp;
     <?php endif; ?>
    </td>
   </tr>  
 

   <?php if ($this->_tpl_vars['post']['quality'] != 0): ?>

    <?php if ($this->_tpl_vars['post']['isCurrentReview'] == 'true'): ?>
		<tbody class="currentreview">
		<?php echo smarty_function_counter(array('name' => 'reviewcounter','print' => false), $this);?>

    <?php else: ?>
		<tbody class="oldreview">
    <?php endif; ?> 

   <tr>
   	<td>Quality: <?php echo $this->_tpl_vars['post']['quality']; ?>
</td>
   	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['qualitytext'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>
   </tr>
   <tr>
      	<td>Appropriate: <?php echo $this->_tpl_vars['post']['appropriate']; ?>
</td>
      	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['appropriatetext'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>
   </tr>
   <tr>
      	<td>Discussion potential: <?php echo $this->_tpl_vars['post']['controversial']; ?>
</td>
      	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['controversialtext'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>
   </tr>
   </tbody>
   <?php endif; ?>
   
 
  </table>
 </td>
</tr>

<tr class="postbody">
 <td id="post_<?php echo $this->_tpl_vars['post']['id']; ?>
" colspan="100">
  <?php echo $this->_tpl_vars['post']['review']; ?>

 </td>
</tr>

 <tr id="spacer">
 <td><br></td>
 </tr>

<?php endforeach; else: ?>

<tr><td colspan="100">
No posts.
</tr></td>

<?php endif; unset($_from); ?>

</table>
</div>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "screen_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['logged_in']):  if (! $this->_tpl_vars['thread']['locked']): ?>
<p>

<form method="post" action="index.php?action=showsubmission&id=<?php echo $this->_tpl_vars['submission']['id']; ?>
">

Use this form to enter a comment, or a review by clicking the checkbox. <br/><br/>
A review includes ratings for quality, appropriateness and likelyhood to promote discussion.<br/><br/>
You can comment as many times as you like on any paper you want.<br/><br/>
Of course, you can't review your own paper, but you can comment on it.<br />
<br>
<p>







<i>The review period for alt.chi is over.  You may still comment on submissions and discussion.</i><br>




<label for="yesisreview" disabled style="color: grey">This is my review</label>

<?php if ($this->_tpl_vars['userid']['status'] == 1): ?>
<input type="radio" name="isreview" value="yes" id="yesisreview" onclick="toggleVisibility(this,document.getElementById('isreviewtrue'));" disabled/>
<?php else: ?>
<input type="radio" name="isreview" value="yes" id="yesisreview" disabled />
<?php endif; ?>
<label for="noisreview">This is a comment</label>
<input type="radio" name="isreview" value="no" checked="checked" id="noisreview" onclick="toggleVisibility(this,document.getElementById('isreviewtrue'));" />


</p>

<textarea id="input_post" name="post"></textarea><br>
<fieldset id="isreviewtrue" class="reviewonly" >
	<legend>Review scores</legend>
<p><em>You are allowed only one review per paper.  This will overwrite any previous review scores you have made for this paper; you may comment as much as you like.  You may comment on your own papers but may not review them.</em></p>
	<p>
	<label class="reviewonly"  for="quality">Quality</label>
	<select class="reviewonly" class="reviewonly" name="quality" id="quality" disabled />
		<option value="7">7 - excellent</option>
		<option value="6">6</option>
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1 - very poor</option>
	</select>
    <br/>
	<label class="reviewonly"  for="qualitytext">Why?</label>
	<input  class="reviewonly"  type="text" size=40 maxlength=40 name="qualitytext" id="qualitytext" value="" disabled />
	</p>

	<p>
	<label class="reviewonly"  for="appropriate">Appropriate for alt.chi</label>
	<select  class="reviewonly"  name="appropriate"  id="appropriate" disabled>
		<option value="7">7 - very appropriate</option>
		<option value="6">6</option>
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1 - inappropriate</option>
	</select>
    <br/>
	<label for="appropriatetext">Why?</label>
	<input  class="reviewonly" type="text" size=40 maxlength=40 name="appropriatetext" id="appropriatetext" value="" disabled/>
	</p>

	<p>
	<label for="controversial">Discussion</label>
	<select  class="reviewonly"  name="controversial"  id="controversial" disabled>
		<option value="7">7 - Will encourage</option>
		<option value="6">6</option>
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1 - Unlikely to encourage</option>
	</select>
    <br/>
	<label for="controversialtext">Why?</label>
	<input class="reviewonly"  type="text" size=40 maxlength=40 name="controversialtext" id="controversialtext" value="" disabled/>
	</p>

</fieldset>

<input type="submit" value="Submit">

<?php echo '
<script>
<!--//
	
function toggleVisibility(radiobutton,disablethis) {
	if(radiobutton.value == "no"){
		document.getElementById("appropriate").disabled = true;
		document.getElementById("controversial").disabled = true;
		document.getElementById("quality").disabled = true;
		document.getElementById("appropriatetext").disabled = true;
		document.getElementById("controversialtext").disabled = true;
		document.getElementById("qualitytext").disabled = true;
	}else {
		document.getElementById("appropriate").disabled = false;
		document.getElementById("controversial").disabled = false;
		document.getElementById("quality").disabled = false;
		document.getElementById("appropriatetext").disabled = false;
		document.getElementById("controversialtext").disabled = false;
		document.getElementById("qualitytext").disabled = false;
	}
	return true;
}

//-->
</script>
'; ?>



</form>
</div>
</p>
<?php endif;  endif; ?>