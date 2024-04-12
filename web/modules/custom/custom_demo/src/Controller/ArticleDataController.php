<?php

namespace Drupal\custom_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;

class ArticleDataController extends ControllerBase{

  public function getArticleData(){

    $nodes = \Drupal::entityTypeManager()->getStorage('node')
      ->loadByProperties(['type' => 'article_new', 'status' => 1]);

    foreach($nodes as $node){
      // dump($node);
      $title = $node->title->value;
      $body = $node->body->value;
      $image_uri = $node->field_featured_image->entity->field_media_image->entity->getFileUri();
      $feature_image_url =  \Drupal::service('file_url_generator')->generateAbsoluteString($image_uri);
      
      // Qoute paragraph reference
      $quote_title =  $node->field_quote->entity->field_quote->value;
      $quote_author =  $node->field_quote->entity->field_quote_autor->value;

      //Content reference
      $related_articles_title = $node->field_related_articles->entity->title->value;
      $related_articles_nid = $node->field_related_articles->entity->nid->value;
      $related_articles_path_alias = \Drupal::service('path_alias.manager')->getAliasByPath("/node/$related_articles_nid");///test-article1
      

    }
    return [
      '#type' => 'markup',
      '#markup' => "This text is comming from controller"
    ];
  } 
}