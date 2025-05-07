<?php
// inc/PostTypes/FixturePostType.php
namespace Inc\PostTypes;

class FixturePostType {
    public function register() {
        add_action('init', [$this, 'registerFixtureCPT']);
        add_filter('manage_fixture_posts_columns', [$this, 'custom_columns']);
        add_action('manage_fixture_posts_custom_column', [$this, 'custom_column_content'], 10, 2);
    }

    public function registerFixtureCPT() {
        $labels = [
            'name'               => 'Fixtures',
            'singular_name'      => 'Fixture',
            'add_new'            => 'Add New Fixture',
            'add_new_item'       => 'Add New Fixture',
            'edit_item'          => 'Edit Fixture',
            'new_item'           => 'New Fixture',
            'view_item'          => 'View Fixture',
            'search_items'       => 'Search Fixtures',
            'not_found'          => 'No Fixtures found',
        ];

        $args = [
            'label'              => 'Fixtures',
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => true,
            'menu_icon'          => 'dashicons-calendar-alt',
            'supports'           => ['title', 'editor', 'custom-fields'],
            'show_in_rest'       => true,
        ];

        register_post_type('fixture', $args); // lowercase slug
    }

    public function custom_columns($columns) {
        $new = [];
        foreach ($columns as $key => $value) {
            $new[$key] = $value;
            if ($key === 'title') {
                $new['challenger'] = __('Challenger', 'your-textdomain');
                $new['opponent']   = __('Opponent', 'your-textdomain');
                $new['match_date'] = __('Match Date', 'your-textdomain');
            }
        }
        return $new;
    }

    public function custom_column_content($column, $post_id) {
        switch ($column) {
            case 'challenger':
                echo esc_html(get_post_meta($post_id, 'challenger_team', true));
                break;
            case 'opponent':
                echo esc_html(get_post_meta($post_id, 'opponent_team', true));
                break;
            case 'match_date':
                echo esc_html(get_post_meta($post_id, 'match_date', true));
                break;
        }
    }
}
