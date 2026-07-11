<?php

namespace {

    use SilverStripe\Assets\Image;
    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Forms\DateField;
    use SilverStripe\Forms\FieldList;
    use SilverStripe\Forms\TextareaField;

    class BlogPost extends Page
    {
        private static $singular_name = 'Blog Post';
        private static $plural_name = 'Blog Posts';

        private static $can_be_root = false;
        private static $allowed_children = [];

        private static $db = [
            'PublishDate' => 'Date',
            'Summary'     => 'Text',
        ];

        private static $has_one = [
            'FeaturedImage' => Image::class,
        ];

        private static $owns = [
            'FeaturedImage',
        ];

        public function getCMSFields(): FieldList
        {
            $fields = parent::getCMSFields();

            $fields->addFieldsToTab('Root.Main', [
                DateField::create('PublishDate', 'Publish Date'),
                TextareaField::create('Summary', 'Summary')->setRows(4),
                UploadField::create('FeaturedImage', 'Featured Image')
                    ->setAllowedFileCategories('image'),
            ], 'Content');

            return $fields;
        }
    }
}
