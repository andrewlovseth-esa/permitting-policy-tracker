// actions.js

export function setupActions() {
    // Use event delegation on document.body to handle clicks
    document.body.addEventListener("click", (event) => {
        // Check if click target is within an actions list item
        if (event.target.closest(".list-item")) {
            const listItem = event.target.closest(".list-item");

            // Don't toggle if click is inside body or footer
            const isClickInBody = event.target.closest(".list-item__body");
            const isClickInFooter = event.target.closest(".list-item__footer");

            if (!isClickInBody && !isClickInFooter) {
                listItem.classList.toggle("open");
            }
        }
    });
}
