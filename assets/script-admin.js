const popupModal = document.querySelector(".aph-buradio-admin-modal");
const popupShowBtn = document.querySelector(".aph-buradio-admin-addnew-btn");
const popupHideBtn = document.querySelector(".aph-buradio-admin-close-btn");
const popupCancelBtn = document.querySelector(".aph-buradio-admin-details-cancel-btn");

popupShowBtn.addEventListener("click", () => {
    popupModal.classList.toggle("showpopup");
});

popupHideBtn.addEventListener("click", () => {
    popupShowBtn.click();
});

popupCancelBtn.addEventListener("click", () => {
    popupShowBtn.click();
});