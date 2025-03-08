#Adding a “Sale” Option to Display Discounted Products in WooCommerce

Just drop this snippet of code into the `functions.php` file of your WordPress theme, and you’re good to go! It’ll add a new sorting option, labeled “On Sale” (you can rename this), to the default WooCommerce sort dropdown (like “Newest” or “Lowest Price”). When users select this option, all products with discounts will be displayed.

```php
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
```

Another cool thing? You can generate a URL for this sorting option and use it anywhere on your site! Plus, you can customize the query string parameter of the link to fit your needs.

For example:
`yourdomain.com/shop/?orderby=on_sale`

Tips for Customization:
– In line 6 of the code, you can change the text “Sort by Sale” to anything you like.
– In line 12, feel free to customize both instances of `orderby` and the term `on_sale`. (Just avoid using spaces in these terms!)
