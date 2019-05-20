$(".hamburger-menu").click(() => {
    $(".hamburger-menu").toggleClass("change");
    $("#mobile-menu-list").toggleClass("down");
});

$("#create-new-post").click(() => {
    window.location = $("#create-new-post").attr("data-href");
});

$(".forum-sort-selected").click(() => {
    $(".forum-sort-options").toggleClass("profile-posts-sort-options-down");
});

$("#forum-search-icon").click(() => {
    $("#forum-search").addClass("forum-search-show");
    $("#forum-sort").addClass("hide");
    $("#forum-search").focus();

});

$("#forum-search-exit").click(() => {
    $("#forum-search").removeClass("forum-search-show");
    $("#forum-sort").removeClass("hide");
});

$("#profile-icon-button").click(() => {
    $("#profile-menu").toggleClass("hide");
});

window.onclick = function(event) {
    if (event.target == document.querySelector("#modal")) {
        document.querySelector("#modal").classList.remove("modal-open");
    }

    if (!event.target.matches("path") && !event.target.matches("svg")) {
        if (!event.target.matches("#profile-menu")) {
            document.querySelector("#profile-menu").classList.add("hide");
        }
    }
}

