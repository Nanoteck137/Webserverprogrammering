$(".hamburger-menu").click(() => {
    $(".hamburger-menu").toggleClass("change");
    $("#mobile-menu-list").toggleClass("down");
});

$("#create-new-post").click(() => {
    window.location = $("#create-new-post").attr("data-href");
});

$("#sorting-head").click(() => {
    $("#sorting-options").toggleClass("show-sorting-options");
    $("#sorting-img-down").toggleClass("hide");
    $("#sorting-img-up").toggleClass("hide");
});

let themes = {
    default: {
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

}

changeTheme(themes.default);