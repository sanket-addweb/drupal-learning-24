<?php

namespace Drupal\custom_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Drupal\Core\Url;
use Drupal\Core\Link;

class ReturnStatmentController extends ControllerBase{

  public function getReturnData(){

    //Return as Items
    $items = [
      'Item 1',
      'Item 2'
    ];

    return [
      '#theme' => 'item_list',
      '#items' => $items
    ]; 

    // Return as links
    $links = [
      [
        'title' => 'Home',
        'url' => Url::fromRoute('<front>'),//OR 
        // 'url' => Link::createFromRoute('Link 1', 'custom_view_field.user_form')->getUrl(),
      ],
      [
        'title' => 'Self Page',
        'url' => Url::fromRoute('custom_demo.get_return_data'),
      ],
      [
        'title' => 'Custom Form',
        'url' => Url::fromRoute('custom_view_field.user_form'),
      ],
    ];

    return [
      '#theme' => 'links',
      '#links' => $links,
      '#set_active_class' => true,
    ];

    // Return as table
    $rows = [
      ['data' => ['Cell 1', 'Cell 2']],
      ['data' => ['Cell 3', 'Cell 4']],
    ];

    $header = ['Header 1', 'Header 2'];

    $build = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
    return $build;

    // Redirect to custom route or url
    // $response = new RedirectResponse('/get-article-data');

    // $path_alias = "get-article-data";
    // $url = Url::fromUserInput('/' . $path_alias)->toString();
    // $response = new RedirectResponse($url);
    // return $response;

    // Return as json data
    $data = ['message' => 'Hello, World!'];
    $response = new JsonResponse($data);
    return $response;

    $response = new Response('Hello, World!', Response::HTTP_OK);//Load only data i.e, Hello, World!
    return $response;

    // Retrun as markup
    return [
      '#type' => 'markup',
      '#markup' => "This text is comming from controller"
    ];

    

  } 
}