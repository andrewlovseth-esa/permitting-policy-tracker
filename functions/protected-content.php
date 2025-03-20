<?php

// Handle the password form via AJAX and validate the password
function wp_validate_password_ajax() {
    // Check if the password is provided in the request
    if (isset($_POST['password'])) {
        // Remove '&' characters from the password for validation and sanitize the input
        $entered_password = str_replace('&', '', sanitize_text_field($_POST['password']));
        
        // Fetch the correct password from the options (ACF or another storage)
        $correct_password = get_field('protected_content_password', 'options');

        // Check if the entered password matches the correct password
        if ($entered_password === $correct_password) {
            // Set a cookie for the validated password (expires in 30 days)
            setcookie('site_password', 'entered', time() + (86400 * 30), "/");

            // Send a success response and instruct the client to set localStorage
            wp_send_json_success([
                'message' => 'Success! You can now view the content.',
                'setLocalStorage' => true  // Instruct client to set localStorage
            ]);
        } else {
            // If the password is incorrect, send an error response
            wp_send_json_error(['message' => 'Incorrect password. Please try again.']);
        }
    } else {
        // If the password field is empty, send an error response
        wp_send_json_error(['message' => 'Password field is empty.']);
    }
}

// Hook the function to handle AJAX requests for both logged-in and non-logged-in users
add_action('wp_ajax_nopriv_validate_password', 'wp_validate_password_ajax');
add_action('wp_ajax_validate_password', 'wp_validate_password_ajax');

// Shortcode to display the password form
function wp_custom_password_form() {
    // Check if the 'site_password' cookie is set and has the correct value
    if (isset($_COOKIE['site_password']) && $_COOKIE['site_password'] === 'entered') {
        // If the password is already entered, show a success message instead of the form
        return '<div class="password-form__message success">You have already entered the correct password.</div>';
    }

    // If the cookie is not set or doesn't have the correct value, display the form
    ob_start(); ?>
    
    <form id="password-form" class="password-form">
        <div class="password-form__wrapper">
            <input class="password-form__input" name="password" id="password" type="text" placeholder="Type here (case-sensitive)" required />
            <button class="password-form__btn" type="submit">Enter</button>
        </div>
        <div class="password-form__message" id="message"></div>
    </form>

    <?php
    return ob_get_clean();
}
add_shortcode('bearsmith_password_form', 'wp_custom_password_form');