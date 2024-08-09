<?php
if (!class_exists('CCT_Case_Filter')) {
    class CCT_Case_Filter
    {
        /**
         * Singleton local instance
         * 
         * @var $_instance object
         */
        private static $_instance;


        /**
         * Summary of __construct
         * 
         * A singleton constructor
         * 
         * All hooks should trigger from here for the class
         * 
         */
        private final function __construct()
        {
            add_filter('posts_where', array(__CLASS__, 'cases_where'), 10, 2);

        }



        /**
         * Summary of cases_where
         * 
         * Custom search query setup for case post
         * 
         * @param mixed $where
         * @param mixed $query
         * @return mixed
         */
        public static function cases_where($where, $query)
        {
            global $wpdb;

            // return $where;

            if ($query->get('cct-search') && !is_admin()) {
                // Search term
                $search_term = $query->get('cct-search');

                // Add the OR conditions to the WHERE clause
                $where .= " OR ({$wpdb->postmeta}.meta_key = 'nature_of_the_case' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%')";
                $where .= " OR ({$wpdb->postmeta}.meta_key = 'summary_of_the_case' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%')";
            }

            return $where;
        }

        /**
         * Summary of getInstance
         * 
         * Get the singleton instance
         * 
         * @return CCT_Case_Filter
         */
        public static function getInstance()
        {
            if (!isset(self::$_instance)) {
                self::$_instance = new CCT_Case_Filter();
            }
            return self::$_instance;
        }
    }
}

// Trigger Hooks
CCT_Case_Filter::getInstance();
