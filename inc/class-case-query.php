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

            $paged = $paged = isset($_GET['c-page']) ? sanitize_text_field($_GET['c-page']) : 1;

            $query['posts_per_page'] = 12;
            $query['paged'] = $paged;


            $query['meta_query']['relation'] = 'AND';

            // Filter Query By Post Meta
            $meta_query_filter = array('relation' => 'AND');

            $case_status_filter = $this->get_filter('case_status');
            $case_status_filter && array_push($meta_query_filter, $case_status_filter);

            $jurisdiction_filter = $this->get_filter('jurisdiction');
            $jurisdiction_filter && array_push($meta_query_filter, $jurisdiction_filter);

            $sector_filter = $this->get_filter('sector_of_the_case', 'LIKE');
            $sector_filter && array_push($meta_query_filter, $sector_filter);

            $level_of_government_filter = $this->get_filter('level_of_government');
            $level_of_government_filter && array_push($meta_query_filter, $level_of_government_filter);

            $forms_of_corruption_filter = $this->get_filter('forms_of_corruption', compare: 'LIKE');
            $forms_of_corruption_filter && array_push($meta_query_filter, $forms_of_corruption_filter);


            // Search Query on Post Meta
            $meta_query_search = array('relation' => 'OR');
            if (isset($_GET['cct-search']) && !empty($_GET['cct-search'])) {
                $title_of_the_case = $this->get_search('cct_case_title');
                $nature_of_the_case = $this->get_search('nature_of_the_case');
                $summary_of_the_case = $this->get_search('summary_of_the_case');
                $number_of_the_case = $this->get_search('case_number');
                array_push($meta_query_search, $title_of_the_case, $nature_of_the_case, $summary_of_the_case, $number_of_the_case);
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
        public function get_filter($key, $compare = '=')
        {
            if (!isset($_GET[$key]) || empty($_GET[$key]))
                return false;

            $value = $_GET[$key];

            return [
                'key' => $key,
                'value' => $value,
                'compare' => $compare,
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
                'key' => $key,
                'value' => $search_term,
                'compare' => 'LIKE',
            ];
        }
    }
}
