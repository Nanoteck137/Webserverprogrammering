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


/*window.onclick = function(event) {
    
    if (!event.target.matches("#forum-search")) {
        let element = document.getElementById("forum-search");
        if (element.classList.contains("forum-search-show")) {
            element.classList.remove("forum-search-show");
        }
    }
}*/

let themes = {
    /*default: {
        primaryBackgroundColor: "#ffa726",
        primaryBackgroundColorLight: "#ffd95b",
        primaryBackgroundColorDark: "#c77800",
        primaryBackgroundColorOn: "#000000",
        primaryBackgroundColorLightOn: "#000000",
        primaryBackgroundColorDarkOn: "#000000",

        secondaryBackgroundColor: "#ff7043",
        secondaryBackgroundColorLight: "#ffa270",
        secondaryBackgroundColorDark: "#0e0b0a",
        secondaryBackgroundColorOn: "#000000",
        secondaryBackgroundColorLightOn: "#000000",
        secondaryBackgroundColorDarkOn: "#ffffff",
    },*/

    light: {
        primaryBackgroundColor: "#fafafa",
        primaryBackgroundColorLight: "#ffffff",
        primaryBackgroundColorDark: "#c7c7c7",
        primaryBackgroundColorOn: "#000000",
        primaryBackgroundColorLightOn: "#000000",
        primaryBackgroundColorDarkOn: "#000000",

        secondaryBackgroundColor: "#ff7043",
        secondaryBackgroundColorLight: "#ffa270",
        secondaryBackgroundColorDark: "#0e0b0a",
        secondaryBackgroundColorOn: "#000000",
        secondaryBackgroundColorLightOn: "#000000",
        secondaryBackgroundColorDarkOn: "#ffffff",

        bigLogoContainerColor: "#fafafa",
    },

    dark: {
        primaryBackgroundColor: "#616161",
        primaryBackgroundColorLight: "#8e8e8e",
        primaryBackgroundColorDark: "#373737",
        primaryBackgroundColorOn: "#ffffff",
        primaryBackgroundColorLightOn: "#000000",
        primaryBackgroundColorDarkOn: "#ffffff",

        secondaryBackgroundColor: "#ff7043",
        secondaryBackgroundColorLight: "#ffa270",
        secondaryBackgroundColorDark: "#0e0b0a",
        secondaryBackgroundColorOn: "#000000",
        secondaryBackgroundColorLightOn: "#000000",
        secondaryBackgroundColorDarkOn: "#ffffff",

        bigLogoContainerColor: "#ededed",
    }
};

function changeTheme(theme) {
    let root = document.documentElement;

    root.style.setProperty("--primary-background-color", theme.primaryBackgroundColor);
    root.style.setProperty("--primary-background-color-light", theme.primaryBackgroundColorLight);
    root.style.setProperty("--primary-background-color-dark", theme.primaryBackgroundColorDark);

    root.style.setProperty("--primary-background-color-on", theme.primaryBackgroundColorOn);
    root.style.setProperty("--primary-background-color-light-on", theme.primaryBackgroundColorLightOn);
    root.style.setProperty("--primary-background-color-dark-on", theme.primaryBackgroundColorDarkOn);

    root.style.setProperty("--secondary-background-color", theme.secondaryBackgroundColor);
    root.style.setProperty("--secondary-background-color-light", theme.secondaryBackgroundColorLight);
    root.style.setProperty("--secondary-background-color-dark", theme.secondaryBackgroundColorDark);

    root.style.setProperty("--secondary-background-color-on", theme.secondaryBackgroundColorOn);
    root.style.setProperty("--secondary-background-color-light-on", theme.secondaryBackgroundColorLightOn);
    root.style.setProperty("--secondary-background-color-dark-on", theme.secondaryBackgroundColorDarkOn);

    root.style.setProperty("--big-logo-container-color", theme.bigLogoContainerColor);
}

changeTheme(themes.light);