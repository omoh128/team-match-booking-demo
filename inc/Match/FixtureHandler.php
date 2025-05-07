<?php
namespace Inc\Match;

class FixtureHandler {
    public function register() {
        add_shortcode('team_fixtures', [$this, 'renderFixtures']);
    }

    public function renderFixtures($atts = []) {
        // Parse attributes
        $atts = shortcode_atts([
            'team_id' => 0, // Optional: Show fixtures for specific team only
            'limit' => 10,  // Number of fixtures to display
        ], $atts);
        
        ob_start();
        
        // Get all teams
        $teams = get_posts([
            'post_type' => 'team',
            'posts_per_page' => -1,
        ]);
        
        $all_fixtures = [];
        
        // Loop through teams to collect fixtures
        foreach ($teams as $team) {
            // Skip if we're filtering by team_id and this isn't the team
            if (!empty($atts['team_id']) && $team->ID != $atts['team_id']) {
                continue;
            }
            
            // Get fixtures for this team
            $team_fixtures = get_post_meta($team->ID, 'team_fixtures', true);
            
            if (is_array($team_fixtures) && !empty($team_fixtures)) {
                foreach ($team_fixtures as $fixture) {
                    if (isset($fixture['challenger']) && isset($fixture['date'])) {
                        $all_fixtures[] = [
                            'challenger' => $fixture['challenger'],
                            'opponent' => $team->post_title,
                            'date' => $fixture['date'],
                            'timestamp' => strtotime($fixture['date']),
                        ];
                    }
                }
            }
        }
        
        // Sort fixtures by date
        usort($all_fixtures, function($a, $b) {
            return $a['timestamp'] - $b['timestamp'];
        });
        
        // Limit the number of fixtures
        $all_fixtures = array_slice($all_fixtures, 0, $atts['limit']);
        
        if (!empty($all_fixtures)) {
            echo '<h3>Upcoming Fixtures</h3>';
            echo '<ul class="team-fixture-list">';
            
            foreach ($all_fixtures as $fixture) {
                // Format the date nicely
                $display_date = date('F j, Y', $fixture['timestamp']);
                
                echo "<li><strong>{$fixture['challenger']}</strong> vs <strong>{$fixture['opponent']}</strong> - <em>{$display_date}</em></li>";
            }
            
            echo '</ul>';
        } else {
            echo '<p>No upcoming fixtures found.</p>';
        }
        
        wp_reset_postdata();
        return ob_get_clean();
    }
}