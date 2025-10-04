<?php
//
add_filter( 'rank_math/woocommerce/stock_status', function( $statuses ) {
return [ 'instock' ]; // 'onbackorder' and 'outofstock' is excluded
});