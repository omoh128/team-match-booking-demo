<?php

// inc/Forms/RegisterTeamForm.php
namespace Inc\Forms;

class RegisterTeamForm {
    public function register() {
        add_shortcode('register_team_form', [$this, 'renderForm']);
    }

    public function renderForm() {
        ob_start();
        ?>
        <form method="post">
            <input type="text" name="team_name" placeholder="Team Name" required>
            <textarea name="team_description" placeholder="Team Description"></textarea>
            <button type="submit" name="submit_team">Register Team</button>
        </form>
        <?php
        if (isset($_POST['submit_team'])) {
            wp_insert_post([
                'post_type' => 'team',
                'post_title' => sanitize_text_field($_POST['team_name']),
                'post_content' => sanitize_textarea_field($_POST['team_description']),
                'post_status' => 'publish',
            ]);
            echo "<p>Team registered successfully!</p>";
        }
        return ob_get_clean();
    }
}
