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



const section = document.querySelector("section"),
    overlay = document.querySelector(".overlay"),
    showBtn = document.querySelector(".show-modal"),
    closeBtn = document.querySelector(".close-btn");
showBtn.addEventListener("click", () => section.classList.add("active"));
// overlay.addEventListener("click", () =>
//     section.classList.remove("active")
// );
closeBtn.addEventListener("click", () =>
    section.classList.remove("active")
);