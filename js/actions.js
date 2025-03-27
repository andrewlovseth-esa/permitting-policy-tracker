// actions.js

export function setupActions() {
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
