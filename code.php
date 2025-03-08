<?php


// pooyan-shabani- order sale shop page
add_filter('woocommerce_get_catalog_ordering_args', 'add_on_sale_sorting_option');
add_filter('woocommerce_default_catalog_orderby_options', 'add_on_sale_sorting_option');
add_filter('woocommerce_catalog_orderby', 'add_on_sale_sorting_option');

function add_on_sale_sorting_option($sortby) {
    $sortby['on_sale'] = 'Sort by Sale';
    return $sortby;
}

add_action('woocommerce_product_query', 'sort_products_by_on_sale');

function sort_products_by_on_sale($query) {
    if (isset($_GET['orderby']) && 'on_sale' === $_GET['orderby']) {
        $meta_query = $query->get('meta_query');

        $meta_query[] = array(
            'key' => '_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'NUMERIC'
        );

        $query->set('meta_query', $meta_query);
    }
}
