var editing = false;

function editSubSwitch()
{
  if (editing)
  {
    alert("done editing");
    editing = false;
  }
  else
  {
//    alert("editing");
/*    var lm = document.getElementById("type");
    lm.innerHTML = "<input type=\"text\" name=\"type\" value=\""+lm.innerHTML+"\">";

    lm = document.getElementById("submissionForm");
    var submitbutton = document.createElement("input");
    submitbutton.setAttribute("type","submit");
    submitbutton.setAttribute("value","save");
    lm.appendChild(submitbutton);*/

    alert("doing stuff");

    var elems = document.getElementsByTagName("input");
    if (elems)
    for( elem in elems )
    {
//      if (!elem.getAttribute("name")) continue;
//      if (elem.getAttribute("name")!="edits") continue;

      alert(elem.getAttribute);
/*      if (elem.style.display=='none')
        elem.style.display = 'block';
      else
        elem.style.display = 'none';*/
    }
/*    var elems = document.getElementsByTagName("input");
    if (elems)
    for( elem in elems )
    {
      if (elem.style.display=='none')
        elem.style.display = 'block';
      else
        elem.style.display = 'none';
    }*/
    editing = true;

    alert("done stuff doing");
  }
}
