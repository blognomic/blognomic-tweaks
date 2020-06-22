<?php

class BlogNomic_Tweaks_Current_Active_Players_Widget extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'blognomic_tweaks_current_active_players_widget',
      'BlogNomic Current Active Players',
      [
        'description' => __('Current Active Players', 'blognomic-tweaks'),
      ]
    );
  }

  public function widget($args, $instance) {
    $title = apply_filters('widget_title', __('Current Active Players', 'blognomic-tweaks'));

    $user_query = new WP_User_Query([
      'meta_query' => [
        [
          'key' => 'is_player',
          'value' => TRUE,
          'compare' => '='
        ],
      ],
      'fields' => 'all',
    ]);

    $base_users = $user_query->get_results();

    $users = [];

    foreach($base_users as $user) {
      $status = bp_get_profile_field_data([
        'field' => 40,
        'user_id' => $user->ID,
      ]);

      if(!in_array($status, ['Active'])) {
        continue;
      }

      $is_admin = FALSE;

      foreach($user->roles as $role) {
        if(in_array($role, ['editor', 'administrator'])) {
          $is_admin = TRUE;
          break;
        }
      }

      $attributes = '';
      $classes = [];

      if($is_admin) {
        $classes[] = 'admin';
      }

      if(!empty($classes)) {
        $attributes .= ' class="' . implode(' ', $classes) . '"';
      }

      $users[] = [
        'name' => $user->user_login,
        'slug' => $user->user_nicename,
        'avatar' => get_avatar_url($user->ID, [
          'size' => 80,
          'default' => 'identicon',
          'rating' => 'PG',
          'scheme' => 'relative',
        ]),
        'is_admin' => $is_admin,
        'status' => $status,
        'attributes' => $attributes,
      ];
    }

    $total_players = count($users);
    $quorum = floor($total_players / 2) + 1;

    include __DIR__ . '/../templates/active-users.php';
  }
}
