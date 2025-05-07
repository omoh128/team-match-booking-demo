<?php

namespace Inc\Forms;

class AvailabilityForm {
    public function register() {
        add_action('init', [$this, 'registerAvailabilityCPT']);
        add_shortcode('availability_form', [$this, 'renderForm']);

        // Admin columns
        add_filter('manage_availability_posts_columns', [$this, 'addAvailabilityColumns']);
        add_action('manage_availability_posts_custom_column', [$this, 'renderAvailabilityColumns'], 10, 2);
        add_filter('manage_edit-availability_sortable_columns', [$this, 'makeAvailabilityColumnSortable']);
        add_action('pre_get_posts', [$this, 'sortAvailabilityByMeta']);
    }

    // Add custom column to Availability admin list
    public function addAvailabilityColumns($columns) {
        $columns['available_date'] = 'Available Date';
        return $columns;
    }

    // Fill the custom column with data
    public function renderAvailabilityColumns($column, $post_id) {
        if ($column === 'available_date') {
            $date = get_post_meta($post_id, 'available_date', true);
            echo esc_html($date);
        }
    }

    // Make the column sortable
    public function makeAvailabilityColumnSortable($columns) {
        $columns['available_date'] = 'available_date';
        return $columns;
    }

    // Handle sorting by meta value
    public function sortAvailabilityByMeta($query) {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }

        $orderby = $query->get('orderby');
        if ('available_date' === $orderby) {
            $query->set('meta_key', 'available_date');
            $query->set('orderby', 'meta_value');
        }
    }

    public function registerAvailabilityCPT() {
        $labels = [
            'name' => 'Availabilities',
            'singular_name' => 'Availability',
            'menu_name' => 'Availabilities',
            'all_items' => 'All Availabilities',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Availability',
            'edit_item' => 'Edit Availability',
            'new_item' => 'New Availability',
            'view_item' => 'View Availability',
            'search_items' => 'Search Availabilities',
            'not_found' => 'No availabilities found',
            'not_found_in_trash' => 'No availabilities found in trash',
        ];

        $args = [
            'label' => 'Availabilities',
            'labels' => $labels,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 25,
            'supports' => ['title', 'custom-fields'],
            'menu_icon' => 'dashicons-calendar-alt',
        ];

        register_post_type('availability', $args);
    }

    public function renderForm() {
        ob_start();
        
        // Process form submission
        if (isset($_POST['submit_availability'])) {
            $team_name = sanitize_text_field($_POST['team_name'] ?? '');
            $available_date = sanitize_text_field($_POST['available_date'] ?? '');

            if (!empty($team_name) && !empty($available_date)) {
                $post_id = wp_insert_post([
                    'post_type' => 'availability',
                    'post_title' => $team_name,
                    'post_content' => 'Available on ' . $available_date,
                    'post_status' => 'publish',
                    'meta_input' => [
                        'available_date' => $available_date,
                        'team_name' => $team_name,
                    ],
                ]);

                if (!is_wp_error($post_id)) {
                    echo '<div class="availability-success-message" style="color: green; margin-bottom: 15px;">';
                    echo '<p>Availability submitted successfully for ' . esc_html($team_name) . ' on ' . esc_html($available_date) . '!</p>';
                    echo '</div>';
                } else {
                    echo '<div class="availability-error-message" style="color: red; margin-bottom: 15px;">';
                    echo '<p>Error: Could not save your availability. Please try again.</p>';
                    echo '</div>';
                }
            } else {
                echo '<div class="availability-error-message" style="color: red; margin-bottom: 15px;">';
                echo '<p>Error: Please complete all fields.</p>';
                echo '</div>';
            }
        }
        
        // Display the form
        ?>
        <div class="availability-form-container">
            <form method="post" class="availability-form">
                <div class="form-group">
                    <label for="team_name">Team Name:</label>
                    <input type="text" id="team_name" name="team_name" placeholder="Enter your team name" required>
                </div>
                
                <div class="form-group">
                    <label for="available_date">Available Date:</label>
                    <input type="date" id="available_date" name="available_date" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="submit_availability" class="submit-button">Submit Availability</button>
                </div>
            </form>
        </div>
        
        <style>
            .availability-form-container {
                max-width: 500px;
                margin: 0 auto;
            }
            .availability-form .form-group {
                margin-bottom: 15px;
            }
            .availability-form label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
            .availability-form input[type="text"],
            .availability-form input[type="date"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .availability-form .submit-button {
                background-color: #0073aa;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 4px;
                cursor: pointer;
            }
            .availability-form .submit-button:hover {
                background-color: #005177;
            }
        </style>
        <?php
        
        return ob_get_clean();
    }
}