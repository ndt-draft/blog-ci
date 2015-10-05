<?php
/**
 * Separate & sort items by their level
 */
function menus_sort_level($items) {
    $levels = array();
    $level_items = array();

    // get all levels
    foreach ($items as $item) {
        if (!in_array($item['menu_parent'], $levels)) {
            $levels[] = $item['menu_parent'];
        }
    }

    // sort by level value
    asort($levels);

    foreach ($levels as $level) {
        foreach ($items as $item) {
            if ($level == $item['menu_parent']) {
                $level = (int)$level;
                $level_items[ $level ][] = $item;
            }
        }
    }

    return $level_items;
}

/**
 * Sort items by their weight
 */
function menus_sort_weight($items) {
    for ($i = 0; $i < count($items) - 1; $i++) {
        for ($j = $i + 1; $j < count($items); $j++) {
            if ($items[ $i ]['menu_weight'] > $items[ $j ]['menu_weight']) {
                $temp = $items[ $i ];
                $items[ $i ] = $items[ $j ];
                $items[ $j ] = $temp;
            }
        }
    }
    return $items;
}

/**
 * Merge by level and weight
 */
function menus_merge_level_weight($level_items) {
    $menu_items = array();
    $inserted = array();
    $menu_items = $level_items[0];

    for ($i = 0; $i < count($menu_items); $i++) {
        $menu_id = $menu_items[ $i ]['menu_id'];

        if (!in_array($menu_id, $inserted)) {
            if (isset($level_items[ $menu_id ])) {
                $all_children = $level_items[ $menu_id ];
                $sub1 = array_slice($menu_items, 0, $i + 1);
                $sub2 = array_slice($menu_items, $i + 1);

                $menu_items = array_merge($sub1, $all_children);
                $menu_items = array_merge($menu_items, $sub2);
                
                $inserted[] = $menu_id;
                $i = -1; // reload again
            }
        }
    }

    return $menu_items;
}

/**
 * Separate & sort items by level
 * Sort items in each level by weight
 * Merge all to 1 array
 */
function menus_sort_level_weight($items) {
    $level_items = menus_sort_level($items);
    $level_items = array_map('menus_sort_weight', $level_items);
    return menus_merge_level_weight($level_items);
}

/**
 * Calculate menu item depth
 */
function menus_items_depth($items) {
    // determine depth
    for ($i = 0; $i < count($items); $i++) {
        $depth = 0;
        $parent_id = $items[ $i ]['menu_parent'];

        for ($j = 0; $j < count($items); $j++) {
            if ($parent_id == $items[ $j ]['menu_id']) {
                $depth++; // = 1
                
                $parent_id = $items[ $j ]['menu_parent'];
                $j = -1; // reload again

                if ($parent_id == 0) {
                    break;
                }
            }
        }

        $items[ $i ]['depth'] = $depth;
    }

    return $items;
}

function menus_parent_options($menu_items, $first_option = '') {
    $menu_parent_options[0] = $first_option;

    foreach ($menu_items as $item) {
        $prefix = '--';
        if ($item['depth']) {
            for ($i = 0; $i < $item['depth']; $i++) {
                $prefix .= '--';
            }
        }
        $menu_parent_options[ $item['menu_id'] ] = $prefix . ' ' . $item['menu_title'];
    }

    return $menu_parent_options;
}

function menus_item_parent_options($item_id, $menu_items, $first_options = '') {
    $parent_options = menus_parent_options($menu_items, $first_options);
    $excluded = array();

    foreach ($menu_items as $index => $item) {
        if ($item['menu_id'] == $item_id) {
            $excluded[] = $item_id;
            $depth = $item['depth'];
        } elseif (isset($depth)) {
            if ($depth >= $item['depth']) {
                break;
            } else {
                $excluded[] = $item['menu_id'];
            }
        }
    }

    foreach ($parent_options as $index => $options) {
        if (in_array($index, $excluded)) {
            unset($parent_options[ $index ]);
        }
    }

    return $parent_options;
}

function menus_items_parent_options($menu_items, $first_option) {
    $parents_options = array();

    foreach ($menu_items as $item) {
        $menu_id = $item['menu_id'];
        $parents_options[ $menu_id ] = menus_item_parent_options($menu_id, $menu_items, $first_option);
    }

    return $parents_options;
}

function menu_slug($name) {
    $CI = get_instance();
    $CI->load->helper('url');
    return url_title($name, 'dash', true);
}