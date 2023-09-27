function accountMenu() {
  document.getElementById("accountMenuItems").classList.toggle("bwa-header-account-div-show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.bwa-header-account-div')) {
  var myDropdown = document.getElementById("accountMenuItems");
    if (myDropdown.classList.contains('bwa-header-account-div-show')) {
      myDropdown.classList.remove('bwa-header-account-div-show');
    }
  }
}