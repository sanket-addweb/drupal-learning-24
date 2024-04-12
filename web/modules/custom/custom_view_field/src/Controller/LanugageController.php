<?php

namespace Drupal\custom_view_field\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Language\LanguageManager;
use Drupal\language\Plugin\LanguageNegotiation;

// class LanugageController extends ControllerBase{

// }

use Drupal\Core\Language\LanguageNegotiationMethodManager;
use Drupal\Core\Language\LanguageNegotiator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class LanugageController extends ControllerBase {

//   /**
//    * The language negotiator manager.
//    *
//    * @var \Drupal\Core\Language\LanguageNegotiationMethodManager
//    */
//   protected $languageNegotiationManager;

  /**
   * The language negotiator.
   *
   * @var \Drupal\Core\Language\LanguageNegotiator
   */
  protected $languageNegotiator;

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  protected $language;

  /**
   * Constructs a new YourController object.
   *
   * @param \Drupal\Core\Language\LanguageNegotiator $language_negotiator
   *   The language negotiator.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack.
   */
  public function __construct(LanguageManager $language/*LanguageNegotiator $language_negotiator */ , RequestStack $request_stack ) {
    // $this->languageNegotiator = $language_negotiator;
    $this->language = $language;
    $this->requestStack = $request_stack;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
    //   $container->get('language_negotiation.method_manager'),
    //   $container->get('language.negotation'),
      $container->get('language_manager'),
      $container->get('request_stack')
    );
  }

  /**
   * Your controller method.
   */
  public function getLanguage() {
    // Get the current request object.
    $request = $this->requestStack->getCurrentRequest();

    // // Get the negotiated language.
    // $language = $this->languageNegotiator->getNegotiationMethodInstance($request)->getLangcode($request);

    // Do something with the language.
    // For example, print the language code.
    $language = $this->language->getCurrentLanguage();
    $languageCode = $language->getId();
    return [
      '#markup' => 'Negotiated language: ' . $languageCode,
    ];
  }

}