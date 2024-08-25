export function userThemePreference() {
    //if user has choosen dark mode with the toggle button make sure that site is on darkmode
    const preference = localStorage.getItem("darkmode") as
        | "true"
        | "false"
        | null;

    if (preference !== null) {
        //if user wants darkmode but body does not contain the class
        if (
            preference === "true" &&
            !document.body.classList.contains("dark")
        ) {
            document.body.classList.add("dark");
            return;
        }

        //if user does not want darkmode but body contains the class
        if (
            preference === "false" &&
            document.body.classList.contains("dark")
        ) {
            document.body.classList.remove("dark");
            return;
        }
    } else {
        //else, if user has not choosen a theme with toggle button then check for thir device preference to set the darkmode
        const { matches: hasDarkmode } = window.matchMedia(
            "(prefers-color-scheme: dark)"
        );

        if (hasDarkmode) {
            document.body.classList.add("dark");
        } else {
            document.body.classList.remove("dark");
        }
    }
}

export function toggleDarkmode() {
    if (document.body.classList.contains("dark")) {
        document.body.classList.remove("dark");
        localStorage.setItem("darkmode", "false");
    } else {
        document.body.classList.add("dark");
        localStorage.setItem("darkmode", "true");
    }
}

export function isDarkmode() {
    if (document.body.classList.contains("dark")) {
        return true;
    } else {
        return false;
    }
}
