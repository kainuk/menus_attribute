<?php

namespace Drupal\menus_attribute;

/**
 * Helper Class for database interraction
 */

class StorageHelper {

  /**
  * function to getData.
  */
  public static function getData($uuid) {
    $result = db_query('SELECT * FROM {menus_attribute} WHERE plugin_id = :uuid', [':uuid' => $uuid])->fetchAll();
    return $result;
  }

  /**
  * function to getData.
  */
  public static function exists($uuid) {
    $result = db_query('SELECT 1 FROM {menus_attribute} WHERE plugin_id = :uuid', [':uuid' => $uuid])->fetchField();
    return (bool) $result;
  }

  /**
  * function to getData.
  */
  public static function add(&$arr, $plugin_id) {
    db_insert('menus_attribute')->fields(
      [
        'plugin_id' => $plugin_id,
        'link_id' => $arr['menu_link_id'],
        'link_name' => $arr['menu_link_name'],
        'link_rel' => $arr['menu_link_rel'],
        'link_classes' => $arr['menu_link_class'],
        'link_style' => $arr['menu_link_style'],
        'link_target' => $arr['menu_link_target'],
        'link_accesskey' => $arr['menu_link_access_key'],
        'item_id' => $arr['menu_item_id'],
        'item_classes' => $arr['menu_item_class'],
        'item_style' => $arr['menu_item_style'],
      ]
    )->execute();
  }
  
  /**
  * function to getData.
  */
  public static function update(&$arr, $plugin_id) {
    $query = \Drupal::database()->update('menus_attribute');
    $query->fields(
      [
        'plugin_id' => $plugin_id,
        'link_id' => $arr['menu_link_id'],
        'link_name' => $arr['menu_link_name'],
        'link_rel' => $arr['menu_link_rel'],
        'link_classes' => $arr['menu_link_class'],
        'link_style' => $arr['menu_link_style'],
        'link_target' => $arr['menu_link_target'],
        'link_accesskey' => $arr['menu_link_access_key'],
        'item_id' => $arr['menu_item_id'],
        'item_classes' => $arr['menu_item_class'],
        'item_style' => $arr['menu_item_style'],
      ]
    );
    $query->condition('plugin_id', $plugin_id);
    $query->execute();
  }
  
}
