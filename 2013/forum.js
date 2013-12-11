function trim(text)
{
  while(text.length>0 && (text.charAt(0)=="\n" || text.charAt(0)==" ")) text = text.substr(1);
//  while(text.lastIndexOf("\n")==text.length-1||text.lastIndexOf(" ")==text.length-1) text = text.substr(0,text.length-1);
  while(text.charAt(text.length-1)=="\n"||text.charAt(text.length-1)==" ") text = text.substr(0,text.length-1);
  return text;
}

function quote(id)
{
  var from = document.getElementById("post_"+id);
  if (!from) return;
  var to = document.getElementById("input_post");
  if (!to) return;
  var head = document.getElementById("post_header_"+id);
  if (!head) return;

  var header = head.innerHTML.replace(/(<([^>]+)>)/ig,"");

  var content = from.cloneNode(true);
  var quotes = content.getElementsByTagName("div");
  if (quotes.length>0) content.removeChild(quotes[0]);
  content = content.innerHTML;
  content.replace("<br>","\n");

  header = trim(header);
  content = trim(content);

//  to.value += "[quote]"+head.innerHTML.replace(/(<([^>]+)>)/ig,"")+"\n"+from.innerHTML.replace(/(<([^>]+)>)/ig","")+"[/quote]\n";
  var toadd = "[quote]"+header+ "\n\n" +
              content.replace(/(<([^>]+)>)/ig,"")+"[/quote]\n";

  to.value += toadd;
}

function deletePost(postid, index)
{
  var confirm_delete = confirm("Are you sure you want to delete this review?");
  if (confirm_delete)
  {
	  alert("Review deleted");
	  window.location = "index.php?action=deletepost&id="+postid+"&index="+index;
  }
  else
  {
	  alert("Review deletion cancelled");
  }
}