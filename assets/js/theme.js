/*
=========================================
 TRENZYCH VPN Theme Manager
 Dark / Light / Auto
=========================================
*/

(function () {

    const STORAGE_KEY = "trenzych_theme";

    const root = document.documentElement;

    const button = document.getElementById("themeToggle");

    function systemTheme() {
        return window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
    }

    function apply(theme) {

        let active = theme;

        if (theme === "auto") {
            active = systemTheme();
        }

        if (active === "light") {
            root.setAttribute("data-theme", "light");
        } else {
            root.removeAttribute("data-theme");
        }

        if (button) {
            button.textContent =
                active === "dark" ? "🌙" : "☀️";
        }

    }

    let saved = localStorage.getItem(STORAGE_KEY);

    if (!saved) {
        saved = "dark";
        localStorage.setItem(STORAGE_KEY, saved);
    }

    apply(saved);

    if (button) {

        button.addEventListener("click", function () {

            let current = localStorage.getItem(STORAGE_KEY);

            if (current === "dark") {
                current = "light";
            } else {
                current = "dark";
            }

            localStorage.setItem(STORAGE_KEY, current);

            apply(current);

        });

    }

    window.matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", function () {

            if (localStorage.getItem(STORAGE_KEY) === "auto") {
                apply("auto");
            }

        });

})();
