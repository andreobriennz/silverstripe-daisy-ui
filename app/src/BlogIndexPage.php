<?php

namespace {

    use SilverStripe\ORM\DataList;

    class BlogIndexPage extends Page
    {
        private static $singular_name = 'Blog Index Page';
        private static $plural_name = 'Blog Index Pages';

        private static $can_be_root = false;
        private static $allowed_children = [BlogPost::class];

        public function getPosts(): DataList
        {
            return BlogPost::get()
                ->filter('ParentID', $this->ID)
                ->sort('PublishDate', 'DESC');
        }
    }
}
