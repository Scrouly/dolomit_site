function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
	tabcontent[i].style.opacity = "0";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "flex";
	if(document.getElementById(tabName).style.display=="flex"){
	document.getElementById(tabName).style.opacity = "1";
	}
  evt.currentTarget.className += " active";
}


window.onload = function() {
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

};

