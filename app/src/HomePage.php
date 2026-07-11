<?php

namespace {

    class HomePage extends Page
    {
        private static $singular_name = 'Home Page';
        private static $plural_name = 'Home Pages';

        private static $can_be_root = true;
        private static $allowed_children = [];
    }
}
