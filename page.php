<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ludocaz
 */

get_header();
?>

<?php
$page = get_post();
echo apply_filters('the_content', $page->post_content);
?>


<?php
get_footer();
