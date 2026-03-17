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
use Drupal\Core\Url;

class BookListBuilder extends EntityListBuilder {

  /**
   * Defines the columns for the admin table.
   */
  public function buildHeader() {
    $header['id']        = $this->t('ID');
    $header['title']     = $this->t('Title');
    $header['shortcode'] = $this->t('Shortcode');
    $header['color']     = $this->t('Card Color');
    $header['image']     = $this->t('Cover Image');
    $header['pdf']       = $this->t('Download PDF');
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
        '#markup' => '<code style="background:#f1f5f9; padding:4px 8px; border-radius:4px;">book_cards id="' . $entity->id() . '"</code>',
      ],
    ];

    $color = $entity->get('color')->value ?: '#6c5ce7';
    $row['color'] = [
      'data' => [
        '#markup' => '<div style="display:flex;align-items:center;gap:10px;">'
          . '<span style="display:inline-block;width:18px;height:18px;border-radius:50%;background:' . $color . ';border:1px solid rgba(0,0,0,0.1);"></span>'
          . '<span>' . $color . '</span>'
          . '</div>',
      ],
    ];

    $image = $entity->get('image')->entity;
    if ($image) {
      $row['image'] = [
        'data' => [
          '#theme'      => 'image_style',
          '#style_name' => 'thumbnail',
          '#uri'        => $image->getFileUri(),
          '#attributes' => ['style' => 'border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'],
          '#width'      => 40,
        ],
      ];
    }
    else {
      $row['image'] = $this->t('—');
    }

    $pdf = $entity->get('pdf')->entity;
    if ($pdf) {
      $pdf_url = \Drupal::service('file_url_generator')->generateAbsoluteString($pdf->getFileUri());
      $row['pdf'] = [
        'data' => [
          '#markup' => '<a href="' . $pdf_url . '" target="_blank" style="display:inline-flex; align-items:center; gap:6px; color:#ef4444; font-weight:600; text-decoration:none; padding:4px 8px; background:#fee2e2; border-radius:4px;"><span style="font-size:16px;">📄</span> View PDF</a>',
        ],
      ];
    }
    else {
      $row['pdf'] = $this->t('—');
    }

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
