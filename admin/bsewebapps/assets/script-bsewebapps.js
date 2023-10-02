// account dropdown menu:
function accountMenu() {
  document.getElementById("accountMenuItems").classList.toggle("bwa-header-account-div-show");
}
window.onclick = function(e) {
  if (!e.target.matches('.bwa-header-account-div')) {
  var menuDropdown = document.getElementById("accountMenuItems");
    if (menuDropdown.classList.contains('bwa-header-account-div-show')) {
      menuDropdown.classList.remove('bwa-header-account-div-show');
    }
  }
}