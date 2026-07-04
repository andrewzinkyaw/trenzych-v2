/*
=========================================
 TRENZYCH VPN Navbar
=========================================
*/

document.addEventListener("DOMContentLoaded", function () {

    const toggle = document.getElementById("menuToggle");
    const menu = document.getElementById("navMenu");

    if (toggle && menu) {

        toggle.addEventListener("click", function () {

            menu.classList.toggle("active");

        });

        document.querySelectorAll("#navMenu a").forEach(link => {

            link.addEventListener("click", function () {

                menu.classList.remove("active");

            });

        });

        document.addEventListener("click", function (e) {

            if (
                !menu.contains(e.target) &&
                !toggle.contains(e.target)
            ) {
                menu.classList.remove("active");
            }

        });

    }

});
