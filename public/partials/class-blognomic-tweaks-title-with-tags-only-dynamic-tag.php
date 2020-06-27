<?php

Class BlogNomic_Title_With_Tags_Only_Tag extends \Elementor\Core\DynamicTags\Tag {
	public function get_name() {
    return 'blognomic-title-with-tags-only';
  }

	public function get_title() {
    return __('BlogNomic title with tags only', 'blognomic-tweaks');
  }

	public function get_group() {
    return 'post';
  }

	public function get_categories() {
    return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
  }

	public function render() {
    $post = get_post();

    $tags = get_the_terms($post, 'tag');

    $title_tags = '';

    $if ( $tags ) {
      $title_tags = ' [';
      foreach($tags as $tag) {
        if ( $title_tags !== ' [' ) {
            $title_tags = $title_tags . ', ';
        }
        $title_tags = $title_tags . $tag->name;
      }
      $title_tags = $title_tags . "]"
    }

    print $post->post_title . $title_tags;
  }
}
