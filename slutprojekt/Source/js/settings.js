let items = document.querySelector("#settings-items").children;

for(let i = 0; i < items.length; i++) {
    let item = items[i];

    item.querySelector(".settings-item-button").addEventListener("click", () => {
        openModal(item.querySelector(".settings-item-open"));
    });
}

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

document.addEventListener("keydown", (evt) => {
    evt = evt || window.event;
    let isEscape = false;
    
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc");
    } else {
        isEscape = (evt.keyCode === 27);
    }

    if (isEscape) 
    {
        let modalWindow = document.querySelector("#modal");
        modalWindow.classList.remove("modal-open");
    }
});