<?php

/**
 * 1) Please, fully explain this function: document iterations, conditionals, and the function objective as a whole
 */

/**
 * Description: The function is designed to handle product details, 
 * quantities, and deletion flags based on certain conditions and flags. 
 * The returned $items array represents the processed information about each 
 * item in the order.
 * 
 * $p:   Details about product
 * $o:   Information about an order, including items
 * $ext: Additional details related to the products in the order
 */
function processItems($p, $o, $ext)
{
    // Initialize an empty array to store processed items
    $items = [];

    // Initialize flags for special product and custom deletion
    $sp = false;
    $cd = false;

    // Initialize an array to store extended product quantities
    $ext_p = [];

    // Populate $ext_p with quantities from the external array ($ext)
    foreach ($ext as $i => $e) {
        $ext_p[$e['price']['id']] = $e['qty'];
    }

    // Loop through items in the order ($o)
    foreach ($o['items']['data'] as $i => $item) {
        // Initialize a product array with the product ID
        $product = [
            'id' => $item['id']
        ];

        // Check if the product has additional options (extended details)
        if (isset($ext_p[$item['price']['id']])) {
            $qty = $ext_p[$item['price']['id']];
            // Check if quantity is less than 1
            if ($qty < 1) {
                $product['deleted'] = true; // Mark product as deleted
            } else {
                $product['qty'] = $qty; // Set product quantity
            }
            unset($ext_p[$item['price']['id']]); // Remove processed extended detail
        } elseif ($item['price']['id'] == $p['id']) {
            $sp = true; // Set special product flag if the product matches
        } else {
            $product['deleted'] = true; // Mark product as deleted
            $cd = true; // Set custom deletion flag
        }

        // Add the processed product to the items array
        $items[] = $product;
    }

    // Check if the special product flag is not set
    if (!$sp) {
        // Add a default item for the main product if not already present
        $items[] = [
            'id' => $p['id'],
            'qty' => 1
        ];
    }

    // Process any remaining extended product quantities
    foreach ($ext_p as $i => $details) {
        // Check if the quantity is less than 1
        if ($details['qty'] < 1) {
            continue; // Skip processing for quantities less than 1
        }

        // Add the processed extended product to the items array
        $items[] = [
            'id' => $details['price'],
            'qty' => $details['qty']
        ];
    }

    // Return the final array of processed items
    return $items;
}
