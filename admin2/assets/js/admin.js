/* ==========================================
   TRENZYCH Admin v2
   ========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("menuToggle");

    if (toggle && sidebar) {

        toggle.addEventListener("click", function () {

            sidebar.classList.toggle("show");

        });

    }

});/* ==========================================
   Active Menu Highlight
   ========================================== */

const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".menu a").forEach(function(link){

    const href = link.getAttribute("href");

    if(href === currentPage){

        link.classList.add("active");

    }

});/* ==========================================
   Close Sidebar on Mobile
   ========================================== */

document.addEventListener("click", function (e) {

    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("menuToggle");

    if (!sidebar || !toggle) return;

    if (window.innerWidth <= 768) {

        if (
            !sidebar.contains(e.target) &&
            !toggle.contains(e.target)
        ) {
            sidebar.classList.remove("show");
        }

    }

});

/* ==========================================
   Ready
   ========================================== */

console.log("TRENZYCH Admin v2 Loaded");
