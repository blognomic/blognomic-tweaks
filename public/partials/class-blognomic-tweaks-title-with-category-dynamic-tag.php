<?php

Class BlogNomic_Title_With_Category_Tag extends \Elementor\Core\DynamicTags\Tag {
	public function get_name() {
    return 'blognomic-title-with-category';
  }

	public function get_title() {
    return __('BlogNomic title with category and tags', 'blognomic-tweaks');
  }

	public function get_group() {
    return 'post';
  }

	public function get_categories() {
    return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
  }

	public function render() {
    $post = get_post();

    $categories = get_the_terms($post, 'category');

    $title_category = '';

    foreach($categories as $category) {
      if($category->slug !== 'uncategorized') {
        $title_category = $category->name . ': ';
        break;
      }
    }

    $tags = get_the_terms($post, 'post_tag');

    $title_tags = '';

    if(!empty($tags)) {
      $tags = array_map(
        function($tag) {
          return $tag->name;
        },
        $tags
      );

      $title_tags = ' [' . implode(', ', $tags). ']';
    }

    print $title_category . $post->post_title . $title_tags;
  }
}
