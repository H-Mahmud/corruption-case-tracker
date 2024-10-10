<?php
defined('ABSPATH') || exit();

/**
 * Add Sanction content archive card
 * 
 * @param string $content
 * @return string
 */
function cct_sanction_card_content($content)
{
    if (is_archive() && 'sanction' == get_post_type()) {
        $date = get_field('date_of_sanction');
        $sanction_by = get_field('sanctioned_by');
        $permalink = get_the_permalink();
        $content = <<<HTML
            <table class="sanction-header">
                <tr>
                    <th>Date of Sanction</th>
                    <td>$date</td>
                </tr>
                <tr>
                    <th>Sanctioned By</th>
                    <td>$sanction_by</td>
                </tr>
        </table>
        <a href="$permalink">Details</a>
        HTML;
    }

    return $content;
}
add_filter('the_excerpt', 'cct_sanction_card_content');



/**
 * Modify the archive header to include a search form for Sanction archive page
 *
 * @since 1.0.0
 *
 * @param string $content
 * @return string
 */
function cct_sanction_archive_header($content)
{
    if (is_archive() && 'sanction' == get_queried_object()->name) {
        remove_action('astra_archive_header', 'astra_archive_page_info');
        add_action('astra_archive_header', 'cct_sanction_search_form');
    }
    return $content;
}
add_action('archive_template', 'cct_sanction_archive_header', 999);


/**
 * Render search form for Sanction archive page
 *
 * @since 1.0.0
 */
function cct_sanction_search_form()
{
?>
    <section class="ast-author-box ast-archive-description">
        <div class="ast-author-bio sanction-search">
            <form method="get" class="cct-search-form">
                <div class="search-input-group">
                    <input class="search-input" type="search" name="s-search" placeholder="Search here..."
                        value="<?php echo isset($_GET['s-search']) ? $_GET['s-search'] : '' ?>">
                    <input class="search-btn" type="submit" value="Search">
                </div>
            </form>
            <?php
            if (isset($_GET['s-search']) && !empty($_GET['s-search'])) {
                echo '<p class="page-title">Search results for: <b>' . $_GET['s-search'] . '</b></p>';
            }
            ?>
        </div>
    </section>
<?php
}

/**
 * Modify the main query to search for Sanctions
 *
 * @param WP_Query $query The main query object.
 *
 * @return void
 */
function cct_sanction_search_query($query)
{
    if (!is_admin() && $query->is_main_query() && isset($_GET['s-search']) && !empty($_GET['s-search'])) {
        $query->set('post_type', 'sanction');

        $search_term = sanitize_text_field($_GET['s-search']);

        // Set up a meta query to search in postmeta
        $meta_query = array(
            'relation' => 'OR',
            array(
                'key'     => 'sanction_title',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'sanctioned_by',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'date_of_sanction',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'reason_for_sanction',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'scope_of_sanction',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        );

        // Add the meta query to the main query
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'cct_sanction_search_query');
