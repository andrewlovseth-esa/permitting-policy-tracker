// actions.js

export function setupActions() {
    document.addEventListener("DOMContentLoaded", function () {
        const actionToggles = document.querySelectorAll(".action__toggle");

        actionToggles.forEach((toggle) => {
            toggle.addEventListener("click", function () {
                const action = this.closest(".action");
                const body = action.querySelector(".action__body");
                const label = this.querySelector(".action__toggle-label");

                // Toggle the open class
                body.classList.toggle("open");
                this.classList.toggle("open");

                // Update the button label
                if (body.classList.contains("open")) {
                    label.textContent = "Collapse";
                } else {
                    label.textContent = "Expand";
                }
            });
        });
    });
}
