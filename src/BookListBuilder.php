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

    return $row + parent::buildRow($entity);
  }

  /**
   * Renders the final table along with the "Master Your Library" help guide.
   */
  public function render() {
    $build = parent::render();
    
    $build['help'] = [
      '#type' => 'container',
      '#weight' => -100,
      '#attributes' => [
        'class' => ['messages', 'messages--status'],
        'style' => 'margin-bottom: 25px; border-left: 6px solid #6366f1; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); background: #ffffff;',
      ],
      'content' => [
        '#markup' => '
          <div style="padding: 15px 10px;">
            <h3 style="margin: 0 0 12px 0; color: #1e293b; display: flex; align-items: center; gap: 10px;">
               <span style="font-size: 24px;">📚</span> Master Your Library
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
              <div>
                <p style="margin: 0 0 8px 0; font-size: 14px;"><strong>Single Book:</strong></p>
                <code style="background: #eef2ff; padding: 4px 10px; border-radius: 6px; color: #4338ca; font-weight: 800;">[book_cards id="8"]</code>
              </div>
              <div>
                <p style="margin: 0 0 8px 0; font-size: 14px;"><strong>Multiple Books (Grid):</strong></p>
                <code style="background: #eef2ff; padding: 4px 10px; border-radius: 6px; color: #4338ca; font-weight: 800;">[book_cards id="8,10,12"]</code>
              </div>
            </div>
            <p style="margin: 15px 0 0 0; font-size: 13px; color: #64748b; font-style: italic;">
              ✨ Tip: Typing <code style="font-weight:700;">[book_cards]</code> alone will display every book in your collection.
            </p>
          </div>
        ',
      ],
    ];

    return $build;
  }
}
