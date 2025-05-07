<?php
if (isset($_POST['submit_availability'])) {
    $team_name = sanitize_text_field($_POST['team_name'] ?? '');
    $available_date = sanitize_text_field($_POST['available_date'] ?? '');

    // Save or handle the data as needed — adjust this logic if saving to custom post types or meta
    echo '<p>Availability submitted for ' . esc_html($team_name) . ' on ' . esc_html($available_date) . '.</p>';
}
?>

<form method="post">
    <label for="team_name">Team Name:</label>
    <input type="text" id="team_name" name="team_name" required>

    <label for="available_date">Available Date:</label>
    <input type="date" id="available_date" name="available_date" required>

    <button type="submit" name="submit_availability">Submit Availability</button>
</form>
