$(".forum-sort-selected").click(() => {
    console.log("Hello WOrld");
    $(".forum-sort-options").toggleClass("profile-posts-sort-options-down");
});

/*let sort = document.getElementsByClassName("forum-sort");
for(let i = 0; i < sort.length; i++) {
    let element = sort[i];
    element.addEventListener("click", () => {
        element.get
    });
}
console.log(sort);*/

/*$(".forum-sort-selected").click(() => {
    console.log("Hello WOrld");
    $(".forum-sort-selected").find(".forum-sort-options").toggleClass("profile-posts-sort-options-down");
});*/

// Close the dropdown menu if the user clicks outside of it
/*window.onclick = function(event) {
    if (!event.target.matches("#profile-posts-sort-select")) {
        let element = document.getElementById("profile-posts-sort-options");
        if (element.classList.contains("profile-posts-sort-options-down")) {
            element.classList.remove("profile-posts-sort-options-down");
        }
    }
}*/