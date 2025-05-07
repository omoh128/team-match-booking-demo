<?php


namespace Inc\Handlers;

class ChallengeHandler {
    public function register() {
        add_action('admin_post_accept_challenge', [$this, 'handleAccept']);
    }

    public function handleAccept() {
        if (!current_user_can('edit_posts') || !isset($_GET['challenge_id'])) {
            wp_die('Unauthorized.');
        }

        $challenge_id = intval($_GET['challenge_id']);

        // Get challenge meta
        $challenger = get_post_meta($challenge_id, 'challenger_team', true);
        $opponent = get_post_meta($challenge_id, 'opponent_team', true);
        $match_date = get_post_meta($challenge_id, 'match_date', true);

        // Create a fixture
        $fixture_id = wp_insert_post([
            'post_type' => 'fixture',
            'post_title' => $challenger . ' vs ' . $opponent,
            'post_status' => 'publish',
        ]);

        if ($fixture_id && !is_wp_error($fixture_id)) {
            update_post_meta($fixture_id, 'challenger_team', $challenger);
            update_post_meta($fixture_id, 'opponent_team', $opponent);
            update_post_meta($fixture_id, 'match_date', $match_date);

            // Optional: update challenge status
            update_post_meta($challenge_id, 'status', 'accepted');
        }

        wp_redirect(admin_url('edit.php?post_type=challenge'));
        exit;
    }
}
