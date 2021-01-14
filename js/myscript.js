const btn = document.querySelector(".btn-toggle");
const theme = document.querySelector("#theme-link");

    btn.addEventListener("click", function() {
        if (theme.getAttribute("href") === "/css/light-theme.css") {
            theme.href = "/css/dark-theme.css";
            document.cookie = "theme=/css/dark-theme.css";
        } else {
            theme.href = "/css/light-theme.css";
            document.cookie = "theme=/css/light-theme.css";
        }
    });
