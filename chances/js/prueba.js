const modal = document.getElementById("myModal");
const btnOpenModal = document.getElementById("openModal");
const spanClose = document.getElementsByClassName("close")[0];

btnOpenModal.addEventListener("click", () => {
    modal.style.display = "block";
});

spanClose.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});
