// mobileNav.js

export function setupMobileNav() {
    document.addEventListener("DOMContentLoaded", function () {
        const navTrigger = document.querySelector(".js-nav-trigger");
        const mobileNav = document.getElementById("mobile-drawer");
        const overlay = document.createElement("div");
        const hamburger = document.querySelector(".hamburger");

        // Create overlay element
        overlay.classList.add("overlay");
        document.body.appendChild(overlay);

        // Function to open the nav
        function openNav() {
            mobileNav.classList.add("is-open");
            overlay.classList.add("is-visible");
            hamburger.classList.add("nav-open"); // Add nav-open class to hamburger
        }

        // Function to close the nav
        function closeNav() {
            mobileNav.classList.remove("is-open");
            overlay.classList.remove("is-visible");
            hamburger.classList.remove("nav-open"); // Remove nav-open class from hamburger
        }

        // Toggle nav on hamburger click
        navTrigger.addEventListener("click", function (e) {
            e.preventDefault();
            if (mobileNav.classList.contains("is-open")) {
                closeNav();
            } else {
                openNav();
            }
        });

        // Close nav when clicking the overlay
        overlay.addEventListener("click", closeNav);

        // Close nav when pressing the Escape key
        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") {
                closeNav();
            }
        });

        // Close nav when clicking a link
        mobileNav.addEventListener("click", function (e) {
            if (e.target.tagName === "A") {
                closeNav();
            }
        });
    });
}

export function setupMobileFilterToggle() {
    document.addEventListener("DOMContentLoaded", function () {
        const filterToggle = document.querySelector(".js-filter-toggle");
        const filterBody = document.querySelector(".js-filter-body");
        const filtersHeader = document.querySelector(".filters__header");

        filterToggle.addEventListener("click", function (e) {
            e.preventDefault();
            filterBody.classList.toggle("closed");
            filtersHeader.classList.toggle("open");
        });
    });
}
