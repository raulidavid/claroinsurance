<?php

namespace Madsis\Core\Helpers\Exchange;

use Madsis\Core\Helpers\Exchange\ExchangeRate;
use Madsis\Core\Repositories\CurrencyRepository;
use Madsis\Core\Repositories\ExchangeRateRepository;

class FixerExchange extends ExchangeRate
{
    /**
     * Api key
     * 
     * @var string 
     */
    protected $apiKey;

    /**
     * Api endpoint
     * 
     * @var string 
     */
    protected $apiEndPoint;

    /**
     * Holds CurrencyRepository instance
     * 
     * @var \Madsis\Core\Repositories\CurrencyRepository
     */
    protected $currencyRepository;

    /**
     * Holds ExchangeRateRepository instance
     * 
     * @var \Madsis\Core\Repositories\ExchangeRateRepository
     */
    protected $exchangeRateRepository;

    /**
     * Create a new helper instance.
     *
     * @param  \Madsis\Core\Repositories\CurrencyRepository  $currencyRepository
     * @param  \Madsis\Core\Repositories\ExchangeRateRepository  $exchangeRateRepository
     * @return void
     */
    public function  __construct(
        CurrencyRepository $currencyRepository,
        ExchangeRateRepository $exchangeRateRepository
    )
    {
        $this->currencyRepository = $currencyRepository;

        $this->exchangeRateRepository = $exchangeRateRepository;

        $this->apiEndPoint = 'http://data.fixer.io/api';

        $this->apiKey = config('services.exchange-api')['fixer']['key'];
    }

    /**
     * Fetch rates and updates in currency_exchange_rates table
     * 
     * @return \Exception|void
     */
    public function updateRates()
    {
        $client = new \GuzzleHttp\Client();

        foreach ($this->currencyRepository->all() as $currency) {
            if ($currency->code == config('app.currency')) {
                continue;
            }

            $result = $client->request('GET', $this->apiEndPoint . '/' . date('Y-m-d') . '?access_key=' . $this->apiKey .'&base=' . config('app.currency') . '&symbols=' . $currency->code);

            $result = json_decode($result->getBody()->getContents(), true);

            if (isset($result['success']) && ! $result['success']) {
                throw new \Exception(
                    isset($result['error']['info'])
                    ? $result['error']['info']
                    : $result['error']['type'], 1);
            }

            if ($exchangeRate = $currency->exchange_rate) {
                $this->exchangeRateRepository->update([
                    'rate' => $result['rates'][$currency->code],
                ], $exchangeRate->id);
            } else {
                $this->exchangeRateRepository->create([
                    'rate'            => $result['rates'][$currency->code],
                    'target_currency' => $currency->id,
                ]);
            }
        }
    }
}