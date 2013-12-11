function addField()
{
  var el = document.getElementById("submission_formtable");
  if (!el) { alert("no formtable"); return false; }
  var tbody = el.getElementsByTagName("TBODY");
  if (tbody.length>0)
    el = tbody[0];

  var tr = document.createElement("TR");
  var td1 = document.createElement("TD");
  var inp1 = document.createElement("INPUT");
  inp1.setAttribute("type","text");
  inp1.setAttribute("name","extras_name[]");
  var td2 = document.createElement("TD");
  var inp2 = document.createElement("INPUT");
  inp2.setAttribute("type","text");
  inp2.setAttribute("name","extras_content[]");

  td1.appendChild(inp1);
  td2.appendChild(inp2);
  tr.appendChild(td1);
  tr.appendChild(td2);

  el.appendChild(tr);
}
