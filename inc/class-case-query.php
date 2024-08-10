<?php
if (!class_exists('CCT_Case_Query')) {
    class CCT_Case_Query
    {

        /**
         * Summary of get_query
         * 
         * case main main query
         * 
         * @return WP_Query
         */
        public function get_query()
        {
            // Initial query
            $query = [];

            // Set Post type
            $query['post_type'] = 'case';

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $query['posts_per_page'] = 10;
            $query['paged'] = $paged;


            $query['meta_query']['relation'] = 'AND';

            // Filter Query By Post Meta
            $meta_query_filter = array('relation' => 'AND');

            $case_status_filter = $this->get_filter('case_status');
            $case_status_filter && array_push($meta_query_filter, $case_status_filter);

            $jurisdiction_filter = $this->get_filter('jurisdiction');
            $jurisdiction_filter && array_push($meta_query_filter, $jurisdiction_filter);

            $section_filter = $this->get_filter('sector_of_the_case');
            $section_filter && array_push($meta_query_filter, $section_filter);


            // Search Query on Post Meta
            $meta_query_search = array('relation' => 'OR');
            if (isset($_GET['cct-search']) && !empty($_GET['cct-search'])) {
                $nature_of_the_case = $this->get_search('nature_of_the_case');
                $summary_of_the_case = $this->get_search('summary_of_the_case');
                array_push($meta_query_search, $nature_of_the_case, $summary_of_the_case);

                // Define search term on query to search on title
                $query['cct-search'] = $_GET['cct-search'];
            }

            $query['meta_query'][] = $meta_query_filter;
            $query['meta_query'][] = $meta_query_search;

            return new WP_Query($query);

        }



        /**
         * Summary of get_filter
         * 
         * Get wp query meta query by meta key for filter
         * 
         * @param string $key meta key
         * @return array|false
         */
        public function get_filter($key)
        {
            if (!isset($_GET[$key]) || empty($_GET[$key]))
                return false;

            $value = $_GET[$key];

            return [
                'key' => $key,
                'value' => $value,
                'compare' => '=',
            ];

        }

        /**
         * Summary of get_search
         * 
         * Get wp meta query by meta key for search
         * 
         * @param mixed $key
         * @return array
         */
        public function get_search($key)
        {
            $search_term = $_GET['cct-search'];

            return [
                'key' => 'nature_of_the_case',
                'value' => $search_term,
                'compare' => 'LIKE',
            ];
        }
    }
}
