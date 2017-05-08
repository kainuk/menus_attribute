<?php

namespace Drupal\menus_attribute\Template;

use Drupal\menus_attribute\StorageHelper;

/**
 * TwigExtension class returns menus attribute for each menu item and link.
 */

class TwigExtension extends \Twig_Extension {

  /**
   * In this function we define a twig extension name.
   */
  public function getName() {
    return 'menus_attribute';
  }

  /**
   * In this function we can declare the extension function.
   */
  public function getFunctions() {
    return [
      new \Twig_SimpleFunction('menus_attribute', [$this, 'menusAttribute']),
      new \Twig_SimpleFunction('test_menu', [$this, 'test']),
      ];
  }

  /**
   * In this function we get data from Helper class.
   */
  public function test($id) {
    return StorageHelper::getData($id)[0]->id;
  }

  /**
   * Returns added attributes for list.
   */
  public function menusAttribute($plugin_id) {
    $attributes = NULL;
    if (StorageHelper::exists($plugin_id)) {
      $data = StorageHelper::getData($plugin_id)[0];
      $attributes['id'] = $data->link_id;
      $attributes['name'] = $data->link_name;
      $attributes['rel'] = $data->link_rel;
      $attributes['class'] = $data->link_classes;
      $attributes['style'] = $data->link_style;
      $attributes['target'] = $data->link_target;
      $attributes['accesskey'] = $data->link_accesskey;
      $attributes['item_id'] = $data->item_id;
      $attributes['item_class'] = $data->item_classes;
      $attributes['item_style'] = $data->item_style;
    }
    return $attributes;
  }

}
