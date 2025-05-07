<?php

// inc/PostTypes/TeamPostType.php
namespace Inc\PostTypes;

class TeamPostType {
    public function register() {
        add_action('init', [$this, 'registerTeamCPT']);
    }

    public function registerTeamCPT() {
        $labels = [
            'name' => 'Teams',
            'singular_name' => 'Team',
            'add_new' => 'Add New Team',
            'add_new_item' => 'Add New Team',
            'edit_item' => 'Edit Team',
            'new_item' => 'New Team',
            'view_item' => 'View Team',
            'search_items' => 'Search Teams',
            'not_found' => 'No teams found',
        ];

        $args = [
            'label' => 'Teams',
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-groups',
            'supports' => ['title', 'editor', 'custom-fields'],
            'show_in_rest' => true,
        ];

        register_post_type('team', $args);
    }
}
