<?php

namespace Drupal\menus_attribute;

/**
 * Helper Class for database interaction.
 */
class StorageHelper {
  
  public $db;
  
  public static function Instance()
  {
    static $inst = NULL;
    if ($inst === NULL) {
      $inst = new StorageHelper();
    }
    return $inst;
  }
  
  public function __construct() {
    $this->db = \Drupal::database();
  }
  
  /**
   * Function to getData.
   */
  public function getData($plugin_id) {
    $data = $this->db->select('menus_attribute','ma')
            ->fields('ma')
            ->condition('plugin_id',$plugin_id,'=')
            ->execute()->fetchObject();
    return $data;
  }

  /**
   * Function to check existence of a menu in our table.
   */
  public static function exists($plugin_id) {
    $data = $this->db->select('menus_attribute')
            ->condition('plugin_id', $plugin_id,'=')->
    $result = db_query('SELECT 1 FROM {menus_attribute} WHERE plugin_id = :uuid', [':uuid' => $uuid])->fetchField();
    return (bool) $result;
  }

  /**
   * Function to add data.
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
   * Function to update data.
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
