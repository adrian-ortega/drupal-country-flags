<?php

namespace Drupal\ao_custom;

use \Drupal\Core\Http\ClientFactory;

class CountriesAPI
{
  private $client;

  public function __construct(ClientFactory $client)
  {
    $this->client = $client->fromOptions([
      'base_uri' => 'https://restcountries.com'
    ]);
  }

  public function all()
  {
    try {
      $request = $this->client->get('/v3.1/all');
      return json_decode($request->getBody()->getContents());
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      watchdog_exception('ao_custom', $e, $e->getMessage());
      return 'nothing';
    }
  }
}
