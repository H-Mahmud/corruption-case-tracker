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

