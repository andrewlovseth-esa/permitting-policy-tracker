export function setupSubComponentFilter() {
    const agencySelect = document.getElementById("agency");
    const subComponentFilter = document.getElementById("sub-component-filter");
    const subComponentSelect = document.getElementById("sub_component");

    if (!agencySelect || !subComponentFilter || !subComponentSelect) return;

    // Function to disable and reset sub-component filter
    function resetSubComponentFilter() {
        subComponentFilter.classList.add("disabled");
        subComponentSelect.disabled = true;
        subComponentSelect.innerHTML = '<option value="">- Select -</option>';
    }

    // Function to fetch and populate sub-components
    async function populateSubComponents(agencyId) {
        try {
            const response = await fetch("/wp-admin/admin-ajax.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({
                    action: "get_sub_components",
                    agency: agencyId,
                }),
            });

            const data = await response.json();

            if (data.success && data.data.length > 0) {
                subComponentFilter.classList.remove("disabled");
                subComponentSelect.disabled = false;

                // Keep the default option and add new options
                subComponentSelect.innerHTML = '<option value="">- Select -</option>';
                data.data.forEach((subComponent) => {
                    const option = document.createElement("option");
                    option.value = subComponent.slug;
                    option.textContent = subComponent.name;
                    subComponentSelect.appendChild(option);
                });
            } else {
                resetSubComponentFilter();
            }
        } catch (error) {
            console.error("Error fetching sub-components:", error);
            resetSubComponentFilter();
        }
    }

    // Handle agency select changes
    agencySelect.addEventListener("change", (e) => {
        const selectedAgency = e.target.value;
        if (selectedAgency) {
            populateSubComponents(selectedAgency);
        } else {
            resetSubComponentFilter();
        }
    });

    // Handle clear filters button
    document.querySelector(".filters__clear").addEventListener("click", () => {
        resetSubComponentFilter();
    });
}
