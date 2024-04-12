<?php

namespace Drupal\custom_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;

class ArticleDataController extends ControllerBase{

  public function getArticleData(){

    $nodes = \Drupal::entityTypeManager()->getStorage('node')
      ->loadByProperties(['type' => 'article_new', 'status' => 1]);

    $node_data = [];
    foreach($nodes as $node){
      $nid = $node->nid->value;
      // dump($node);
      // $title = $node->title->value;
      $node_data[$nid]['title'] = $node->title->value;
      $node_data[$nid]['body'] = $body = $node->body->value;
      // $body = $node->body->value;
      $image_uri = $node->field_featured_image->entity->field_media_image->entity->getFileUri();
      $feature_image_url =  \Drupal::service('file_url_generator')->generateAbsoluteString($image_uri);
      
      $node_data[$nid]['feature_image_url'] = $feature_image_url;
      // Qoute paragraph reference
      $node_data[$nid]['quote']['quote_title'] =  $node->field_quote->entity->field_quote->value;
      $node_data[$nid]['quote']['quote_author'] =  $node->field_quote->entity->field_quote_autor->value;


      //Content reference
      $related_articles_title = $node->field_related_articles->entity->title->value;
      if(!empty($related_articles_title)){
        $related_articles_nid = $node->field_related_articles->entity->nid->value;
        $related_articles_path_alias = \Drupal::service('path_alias.manager')->getAliasByPath("/node/$related_articles_nid");///test-article1
        $node_data[$nid]['related_article']['title'] = $related_articles_title;
        $node_data[$nid]['related_article']['path_alias'] = $related_articles_path_alias;
      }

    }
    dump($node_data);
    return [
      '#type' => 'markup',
      '#markup' => "This text is comming from controller"
    ];
  } 
}