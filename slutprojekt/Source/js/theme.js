let themes = {
    light: {
        primaryBackgroundColor: "#f0f0f0",
        primaryBackgroundColorLight: "#fafafa",
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
        lightPlaceholderColor: "#5e5d5d",
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
        lightPlaceholderColor: "#0a0a0a",
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
    root.style.setProperty("--light-placeholder-color", theme.lightPlaceholderColor);
}