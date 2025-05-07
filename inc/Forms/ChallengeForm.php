<?php

namespace Inc\Forms;

class ChallengeForm {
    /**
     * Register the shortcode for the challenge form
     */
    public function register() {
        add_shortcode('challenge_form', [$this, 'renderForm']);
    }

    /**
     * Render the challenge form by including the template file
     *
     * @return string The form HTML
     */
    public function renderForm() {
        ob_start();
        
        // Include the template file
        $template_path = plugin_dir_path(dirname(__FILE__, 2)) . 'templates/challenge-team-form.php';
        
        if (file_exists($template_path)) {
            include $template_path;
        } else {
            echo '<p>Error: Challenge form template not found.</p>';
        }
        
        return ob_get_clean();
    }
}