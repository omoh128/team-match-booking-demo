<?php
if (isset($_POST['submit_challenge'])) {
    $challenger = sanitize_text_field($_POST['challenger_team'] ?? '');
    $opponent_id = absint($_POST['opponent_team'] ?? 0);
    $match_date = sanitize_text_field($_POST['match_date'] ?? '');

    if ($challenger && $opponent_id && $match_date) {
        // Load current fixtures (if any)
        $fixtures = get_post_meta($opponent_id, 'team_fixtures', true);
        if (!is_array($fixtures)) {
            $fixtures = [];
        }

        // Add new fixture
        $fixtures[] = [
            'challenger' => $challenger,
            'date' => $match_date,
        ];

        update_post_meta($opponent_id, 'team_fixtures', $fixtures);

        echo '<p style="color: green;">' . esc_html($challenger) . ' has challenged ' . get_the_title($opponent_id) . ' to a match on ' . esc_html($match_date) . '.</p>';
    } else {
        echo '<p style="color: red;">Please complete all fields.</p>';
    }
}
?>

<form method="post">
    <label for="challenger_team">Your Team Name:</label>
    <input type="text" id="challenger_team" name="challenger_team" required>

    <label for="opponent_team">Select Opponent Team:</label>
    <select id="opponent_team" name="opponent_team" required>
        <option value="">-- Select Team --</option>
        <?php
        $teams = get_posts([
            'post_type' => 'team',
            'numberposts' => -1,
        ]);

        foreach ($teams as $team) {
            echo '<option value="' . esc_attr($team->ID) . '">' . esc_html($team->post_title) . '</option>';
        }
        ?>
    </select>

    <label for="match_date">Preferred Match Date:</label>
    <input type="date" id="match_date" name="match_date" required>

    <button type="submit" name="submit_challenge">Send Challenge</button>
</form>

