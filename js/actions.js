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
        document.body.addEventListener("click", (event) => {
            const toggle = event.target.closest(".js-rescinded-policy-toggle");
            if (toggle) {
                event.preventDefault();
                const body = toggle.nextElementSibling;
                if (body && body.classList.contains("js-rescinded-policy-body")) {
                    toggle.classList.toggle("open");
                    body.classList.toggle("open");
                }
            }
        });
    });
}
