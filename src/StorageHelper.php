<?php

/* 
 * Helper Class for database interraction
 */
namespace Drupal\menus_attribute;

class StorageHelper {

//  static function getAll() {
//    $result = db_query('SELECT * FROM {MyFormDb}')->fetchAllAssoc('id');
//	return $result;
//  }
  
  static function  getData($uuid){
    $result = db_query('SELECT * FROM {menus_attribute} WHERE plugin_id = :uuid', [':uuid' => $uuid])->fetchAll();
    return $result;
  }

  static function exists($uuid) {
    $result = db_query('SELECT 1 FROM {menus_attribute} WHERE plugin_id = :uuid', [':uuid' => $uuid])->fetchField();
    return (bool) $result;
  }

  static function add(&$arr,$plugin_id) {
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
  
  static function update(&$arr,$plugin_id) {
    $query = \Drupal::database()->update('menus_attribute');
    $query->fields((
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
    ));
    $query->condition('plugin_id',$plugin_id);
    $query->execute();
  }
  
//  static function delete($id) {
//    db_delete('bd_contact')->condition('id', $id)->execute();
//  }

}


