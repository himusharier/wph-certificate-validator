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

// admin panel pop-up modal:
document.getElementById("bwa-signin-btn").onclick = function() {
	document.getElementById('bwa-popup-admin-modal').style.display = 'block';
	document.documentElement.style.overflow = 'hidden';
};
document.getElementById("bwa-popup-admin-modal-close").onclick = function() {
	document.getElementById('bwa-popup-admin-modal').style.display = 'none';
	document.documentElement.style.overflow = 'auto';
};
document.getElementById("bwa-popup-admin-later-btn").onclick = function() {
	document.getElementById('bwa-popup-admin-modal').style.display = 'none';
	document.documentElement.style.overflow = 'auto';
};
