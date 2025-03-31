import { setupMobileNav, setupMobileFilterToggle } from "./mobileNav.js?v=1.4";
import { setupActions, rescindedPolicyToggle } from "./actions.js?v=1.4";
import { setupSubComponentFilter } from "./sub-components.js?v=1.4";

// Initialize mobile navigation logic
setupMobileNav();
setupMobileFilterToggle();

// Initialize actions logic
setupActions();
rescindedPolicyToggle();

// Initialize sub-component filter
setupSubComponentFilter();
