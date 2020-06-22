<?php

Class BlogNomic_Post_Classes_Tag extends \Elementor\Core\DynamicTags\Tag {
	public function get_name() {
    return 'blognomic-post-classes';
  }

	public function get_title() {
    return __('BlogNomic post classes', 'blognomic-tweaks');
  }

	public function get_group() {
    return 'post';
  }

	public function get_categories() {
    return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
  }

	public function render() {
    $post = get_post();
    $classes = [];

    // Post status class.

    $classes[] = sanitize_html_class('status-' . $post->post_status);

    // Category classes.

    $terms = wp_get_post_terms($post->ID, get_object_taxonomies($post));


    foreach($terms as $term) {
      $classes[] = sanitize_html_class(sprintf('term-%s-%s', $term->taxonomy, $term->slug));
    }

    // "Freshness" class to highlight posts over 48 hours old.

    $published = (int)get_post_time('U', true, $post);
    $now = (int)current_time('U', true);

    $post_freshness = 'fresh';

    // If post is over 48 hours old...
    if($now - $published > (60 * 48)) {
      $post_freshness = 'stale';
    }

    $classes[] = sanitize_html_class('freshness-' . $post_freshness);

    print implode(' ', $classes);
    return implode(' ', $classes);
  }
}
