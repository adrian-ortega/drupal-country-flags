<?php

namespace Drupal\ao_custom\Controller;

use Drupal\Core\Controller\ControllerBase;

class ListController extends ControllerBase
{
  public function view()
  {
    $content = [];
    $content['name'] = 'AO';
    $content['countries'] = $this->createCountryCards();

    return [
      '#theme' => 'ao_custom.country-list',
      '#content' => $content,
      '#attached' => [
        'library' => [
          'ao_custom/ao-custom-styling'
        ]
      ]
    ];
  }

  protected function listCountries()
  {
    $service = \Drupal::service('ao_custom.countries_api');
    $countries = $service->all();
    return $countries;
  }

  protected function createCountryCards()
  {
    return array_map(function ($country) {
      return [
        '#theme' => 'ao_custom.country-card',
        '#content' => [
          'name' => $country->name->common,
          'name_long' => $country->name->official,
          'region' => $country->region,
          'subregion' => $country->subregion,
          'map' => $country->maps->googleMaps,
          'population' => $country->population,
          'flag_image' => $country->flags->png,
          'flag_alt' => $country->flags->alt
        ]
      ];
    }, $this->listCountries());
  }
}
