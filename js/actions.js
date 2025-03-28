// actions.js
import { setupSubComponentFilter } from "./sub-components.js";

export function setupActions() {
    // Initialize sub-component filter
    setupSubComponentFilter();

    // Use event delegation on document.body to handle clicks
    document.body.addEventListener("click", (event) => {
        // Check if click target is within an actions list item
        if (event.target.closest(".action")) {
            const listItem = event.target.closest(".action");

            // Don't toggle if click is inside body or footer
            const isClickInBody = event.target.closest(".action__body");
            const isClickInFooter = event.target.closest(".action__footer");

            if (!isClickInBody && !isClickInFooter) {
                listItem.classList.toggle("open");
            }
        }
    });
}

export function rescindedPolicyToggle() {
    document.addEventListener("DOMContentLoaded", function () {
        const rescindedPolicyToggles = document.querySelectorAll(".js-rescinded-policy-toggle");
        const rescindedPolicyBodies = document.querySelectorAll(".js-rescinded-policy-body");

        rescindedPolicyToggles.forEach((toggle, index) => {
            toggle.addEventListener("click", function (e) {
                e.preventDefault();
                toggle.classList.toggle("open");
                rescindedPolicyBodies[index].classList.toggle("open");
            });
        });
    });
}
