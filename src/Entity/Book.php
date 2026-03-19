<?php

namespace Drupal\book_management\Entity;

/**
 * @file src/Entity/Book.php
 * PURPOSE: This file defines the core "book_item" Content Entity.
 * It is essentially the "Custom Post Type" (CPT) of the module.
 * It specifies how the data (Title, Description, Color, Image, PDF) is stored in the database.
 */

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Book entity.
 *
 * @ContentEntityType(
 *   id = "book_item",
 *   label = @Translation("Book"),
 *   base_table = "book_management_data",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid",
 *   },
 *   handlers = {
 *     "list_builder" = "Drupal\book_management\BookListBuilder",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\ContentEntityForm",
 *       "add" = "Drupal\Core\Entity\ContentEntityForm",
 *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer site configuration",
 *   links = {
 *     "canonical" = "/admin/book-management/{book_item}",
 *     "add-form" = "/admin/book-management/add",
 *     "edit-form" = "/admin/book-management/{book_item}/edit",
 *     "delete-form" = "/admin/book-management/{book_item}/delete",
 *     "collection" = "/admin/book-management",
 *   },
 * )
 */
class Book extends ContentEntityBase {

  /**
   * Defines the field structure for our "Book" CPT.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -5])
      ->setDisplayConfigurable('form', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('form', ['type' => 'text_textarea', 'weight' => 0])
      ->setDisplayConfigurable('form', TRUE);

    $config = \Drupal::config('book_management.settings');
    $fields['color'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Background Color'))
      ->setDefaultValue($config->get('default_color') ?: '#6c5ce7')
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => 5])
      ->setDisplayConfigurable('form', TRUE);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Cover Image'))
      ->setSettings(['file_extensions' => 'png jpg jpeg'])
      ->setDisplayOptions('form', ['type' => 'image_image', 'weight' => 10])
      ->setDisplayConfigurable('form', TRUE);

    $fields['pdf'] = BaseFieldDefinition::create('file')
      ->setLabel(t('PDF File'))
      ->setSettings(['file_extensions' => 'pdf'])
      ->setDisplayOptions('form', ['type' => 'file_generic', 'weight' => 15])
      ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }
}
