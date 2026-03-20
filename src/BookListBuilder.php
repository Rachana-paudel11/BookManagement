<?php

namespace Drupal\book_management;

/**
 * @file src/BookListBuilder.php
 * PURPOSE: This file builds the administrative list (table) of books.
 * It creates the "Manage Books" page where admins can see thumbnails, 
 * copy shortcodes, and edit existing entries.
 */

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Url;

class BookListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage) {
    parent::__construct($entity_type, $storage);
    $this->limit = \Drupal::config('book_management.settings')->get('items_per_page') ?: 20;
  }

  /**
   * Defines the columns for the admin table.
   */
  public function buildHeader() {
    $header['id']        = $this->t('ID');
    $header['title']     = $this->t('Title');
    $header['shortcode'] = $this->t('Shortcode');
    return $header + parent::buildHeader();
  }

  /**
   * Fills the table rows with book data.
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\book_management\Entity\Book $entity */
    $row['id'] = [
      'data' => [
        '#markup' => '<strong style="color: #6366f1;">#' . $entity->id() . '</strong>',
      ],
    ];
    
    $row['title'] = $entity->toLink();

    $row['shortcode'] = [
      'data' => [
        '#markup' => '<code style="background:#f1f5f9; padding:4px 8px; border-radius:4px;">[book_cards id="' . $entity->id() . '"]</code>',
      ],
    ];

    return $row + parent::buildRow($entity);
  }

  /**
   * Renders the final table.
   */
  public function render() {
    $build = parent::render();
    return $build;
  }
}
