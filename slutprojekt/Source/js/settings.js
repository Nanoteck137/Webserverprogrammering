document.getElementById("test").addEventListener("click", () => {
    let settingsItems = document.querySelector("#settings-items");
    openModal(settingsItems.children[0].querySelector(".settings-item-open"));
});

function openModal(element) {
    let modalWindow = document.querySelector("#modal");
    modalWindow.classList.add("modal-open");

    modalWindow.querySelector("#modal-content").remove();

    let contentContainer = document.createElement("div");
    contentContainer.setAttribute("id", "modal-content");
    
    let content = element.cloneNode(true);
    content.style.display = "block";

    contentContainer.appendChild(content);

    modalWindow.appendChild(contentContainer);
}

window.onclick = (event) => {
    if (event.target == document.querySelector("#modal")) {
        modal.classList.remove("modal-open");
    }
}
