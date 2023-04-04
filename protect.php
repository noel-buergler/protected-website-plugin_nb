<?php

    /*
    Plugin Name: Password Protect Plugin
    Description: Password protects the WordPress page and redirects according to entered password
    Version: 1.0
    Author: Noel Buergler
    Author URI: https://noelbuergler.ch/
    */
    
    $passwords = array(
        'de' => 'https://lorenzgiordano.ch/de',
        'se' => 'https://lorenzgiordano.ch/se',
    );
    
    function password_protect_parse_request($wp) {
        global $passwords;
    
        if (is_admin() || is_user_logged_in()) {
            // If the user is logged in to the WordPress dashboard or logged in as a user, don't redirect
            return;
        }
    
        $current_url = (is_ssl() ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $current_url_no_slash = rtrim($current_url, '/');
        $password_protect_page = site_url('password-protect');
    
        if (isset($_COOKIE['my_website_password']) && array_key_exists($_COOKIE['my_website_password'], $passwords)) {
            $redirect_url = $passwords[$_COOKIE['my_website_password']];
    
            if ($redirect_url != $current_url && $current_url != $password_protect_page && $redirect_url != $current_url_no_slash) {
                wp_safe_redirect($redirect_url);
                exit;
            }
        } elseif ($current_url != $password_protect_page) {
            wp_safe_redirect($password_protect_page);
            exit;
        }
    }
    add_action('parse_request', 'password_protect_parse_request', 10);
    
    function password_protect_handle_form_submission() {
        global $passwords;
    
        if (isset($_POST['my_website_password'])) {
            $password = $_POST['my_website_password'];
            if (array_key_exists($password, $passwords)) {
                setcookie('my_website_password', $password, time() + 86400, '/');
                wp_safe_redirect($passwords[$password]);
                exit;
            }
        }
    }
    add_action('init', 'password_protect_handle_form_submission', 9);
    
    function password_protect_template_redirect() {
        if (is_page('password-protect')) {
            // If the user is on the password form page, display the form
            ?>
            <html>
            <head>
                <title>Password Protected</title>
            </head>
            <body>
                <form method="post">
                    <label for="my_website_password">Password:</label>
                    <input type="password" id="my_website_password" name="my_website_password">
                    <input type="submit" value="Submit">
                </form>
            </body>
            </html>
            <?php
            exit;
        }
    }
    add_action('template_redirect', 'password_protect_template_redirect');
    
    function password_protect_login_redirect($redirect_to) {
        if (!isset($_GET['redirect_to']) || $_GET['redirect_to'] == 'wp-admin/') {
            $redirect_to = site_url('password-protect');
        }
        return $redirect_to;
    }
    add_filter('login_redirect', 'password_protect_login_redirect');
    
    function password_protect_prevent_canonical_redirect() {
        if (is_page('password-protect')) {
            remove_action('template_redirect', 'redirect_canonical');
        }
    }
    add_action('template_redirect', 'password_protect_prevent_canonical_redirect', 8);