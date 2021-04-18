<?php

namespace Madsis\Core;

use Carbon\Carbon;
use Madsis\Core\Models\Channel;
use Madsis\Core\Repositories\CatalogRepository;
use Madsis\Core\Repositories\ExchangeRateRepository;
use Madsis\Core\Repositories\CountryStateRepository;
use Madsis\Core\Repositories\ChannelRepository;
use Madsis\Core\Repositories\LocaleRepository;
use Madsis\Core\Repositories\CoreConfigRepository;
use Illuminate\Support\Facades\Config;
use Madsis\Customer\Repositories\CustomerGroupRepository;
use Madsis\Core\Repositories\UbicacionGeograficaRepository;

class Core
{
    protected $channelRepository;
    protected $catalogRepository;
    protected $exchangeRateRepository;
    protected $countryRepository;
    protected $localeRepository;
    protected $customerGroupRepository;
    protected $coreConfigRepository;
    protected $ubicaciongeograficaRepository;

    private static $channel;

    public function __construct(
        CatalogRepository $catalogRepository,
        CoreConfigRepository $coreConfigRepository,
        UbicacionGeograficaRepository $ubicaciongeograficaRepository
    )
    {
        $this->catalogRepository = $catalogRepository;
        $this->coreConfigRepository = $coreConfigRepository;
        $this->ubicaciongeograficaRepository = $ubicaciongeograficaRepository;
    }

    public function getAllChannels()
    {
        static $channels;

        if ($channels) {
            return $channels;
        }

        return $channels = $this->channelRepository->all();
    }

    public function getCurrentChannel()
    {
        if (self::$channel) {
            return self::$channel;
        }

        self::$channel = $this->channelRepository->findWhereIn('hostname', [
            request()->getHttpHost(),
            'http://' . request()->getHttpHost(),
            'https://' . request()->getHttpHost(),
        ])->first();

        if (! self::$channel) {
            self::$channel = $this->channelRepository->first();
        }

        return self::$channel;
    }

    public function setCurrentChannel(Channel $channel): void
    {
        self::$channel = $channel;
    }

    public function getConvenios(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 108)->orderBy('nombre')->get()->toJson();
    }

    public function getNacionalidades(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 19)->orderBy('nombre')->get()->toJson();
    }

    public function getTiposDocumentos(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 1)->where('id','!=',18)->where('id','!=',3)->orderBy('nombre')->get();//->except('id', '18');
    }

    public function getEstadoCivil(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 29)->orderBy('nombre')->get()->toArray();
    }

    public function getGeneros(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 26)->orderBy('nombre')->get()->toArray();
    }

    public function getOrdenEstados(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 12)->where('nombre','!=', 'CANCELADO')->where('nombre','!=', 'NO APLICA')->orderBy('nombre')->get();
    }

    public function getParentezco(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 36)->get()->toArray();
    }

    public function getDocumentosClienteCocina($documentosid){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', $documentosid)->get()->toArray();
    }

    public function getEntidadesFinancieras(){
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 119)->get();
    }

    public function getObsUsuarios() {
        return $this->catalogRepository->select('id', 'nombre')->where('idpadre', 130)->get();
    }

    public function getRoutesAngular() {
        return $this->catalogRepository->where('id', 129)->get('valor');
    }

    public function getDespachos() {
        $decoded = $this->catalogRepository->where('nombre', 'DESPACHO')->get('valor');
        return response()->json(json_decode($decoded[0]['valor']));
    }

    public function getTramacoTracking(){
        $decoded = $this->catalogRepository->where('nombre', 'TRAMACO')->get('valor');
        $production = json_decode($decoded[0]['valor'])->webservices->production;
        $tracking = json_decode($decoded[0]['valor'])->webservices->tracking;
        return $production.$tracking;
    }

    public function decodeBase64($data){
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        return $data;
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }
            $data = str_replace( ' ', '+', $data );
            $data = base64_decode($data);

            if ($data === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }
        return $data;
    }

    public function getCurrentChannelCode(): string
    {
        static $channelCode;

        if ($channelCode) {
            return $channelCode;
        }

        return ($channel = $this->getCurrentChannel()) ? $channelCode = $channel->code : '';
    }

    public function getDefaultChannel(): ?Channel
    {
        static $channel;

        if ($channel) {
            return $channel;
        }

        $channel = $this->channelRepository->findOneByField('code', config('app.channel'));

        if ($channel) {
            return $channel;
        }

        return $channel = $this->channelRepository->first();
    }

    public function getDefaultChannelCode(): string
    {
        static $channelCode;

        if ($channelCode) {
            return $channelCode;
        }

        return ($channel = $this->getDefaultChannel()) ? $channelCode = $channel->code : '';
    }

    public function getAllLocales()
    {
        static $locales;

        if ($locales) {
            return $locales;
        }

        return $locales = $this->localeRepository->all();
    }

    public function getCurrentLocale()
    {
        static $locale;

        if ($locale) {
            return $locale;
        }

        $locale = $this->localeRepository->findOneByField('code', app()->getLocale());

        if (! $locale) {
            $locale = $this->localeRepository->findOneByField('code', config('app.fallback_locale'));
        }

        return $locale;
    }

    public function getAllCustomerGroups()
    {
        static $customerGroups;

        if ($customerGroups) {
            return $customerGroups;
        }

        return $customerGroups = $this->customerGroupRepository->all();
    }

    public function getAllCurrencies()
    {
        static $currencies;

        if ($currencies) {
            return $currencies;
        }

        return $currencies = $this->currencyRepository->all();
    }

    public function getBaseCurrency()
    {
        static $currency;

        if ($currency) {
            return $currency;
        }

        $baseCurrency = $this->currencyRepository->findOneByField('code', config('app.currency'));

        if (! $baseCurrency) {
            $baseCurrency = $this->currencyRepository->first();
        }

        return $currency = $baseCurrency;
    }

    public function getBaseCurrencyCode()
    {
        static $currencyCode;

        if ($currencyCode) {
            return $currencyCode;
        }

        return ($currency = $this->getBaseCurrency()) ? $currencyCode = $currency->code : '';
    }

    public function getChannelBaseCurrency()
    {
        static $currency;

        if ($currency) {
            return $currency;
        }

        $currenctChannel = $this->getCurrentChannel();

        return $currency = $currenctChannel->base_currency;
    }

    public function getChannelBaseCurrencyCode()
    {
        static $currencyCode;

        if ($currencyCode) {
            return $currencyCode;
        }

        return ($currency = $this->getChannelBaseCurrency()) ? $currencyCode = $currency->code : '';
    }

    public function getCurrentCurrency()
    {
        static $currency;

        if ($currency) {
            return $currency;
        }

        if ($currencyCode = session()->get('currency')) {
            if ($currency = $this->currencyRepository->findOneByField('code', $currencyCode)) {
                return $currency;
            }
        }

        return $currency = $this->getChannelBaseCurrency();
    }

    public function getCurrentCurrencyCode()
    {
        static $currencyCode;

        if ($currencyCode) {
            return $currencyCode;
        }

        return ($currency = $this->getCurrentCurrency()) ? $currencyCode = $currency->code : '';
    }

    public function convertPrice($amount, $targetCurrencyCode = null, $orderCurrencyCode = null)
    {
        if (! isset($this->lastCurrencyCode)) {
            $this->lastCurrencyCode = $this->getBaseCurrency()->code;
        }

        if ($orderCurrencyCode) {
            if (! isset($this->lastOrderCode)) {
                $this->lastOrderCode = $orderCurrencyCode;
            }

            if (($targetCurrencyCode != $this->lastOrderCode)
                && ($targetCurrencyCode != $orderCurrencyCode)
                && ($orderCurrencyCode != $this->getBaseCurrencyCode())
                && ($orderCurrencyCode != $this->lastCurrencyCode)
            ) {
                $amount = $this->convertToBasePrice($amount, $orderCurrencyCode);
            }
        }

        $targetCurrency = ! $targetCurrencyCode
            ? $this->getCurrentCurrency()
            : $this->currencyRepository->findOneByField('code', $targetCurrencyCode);

        if (! $targetCurrency) {
            return $amount;
        }

        $exchangeRate = $this->exchangeRateRepository->findOneWhere([
            'target_currency' => $targetCurrency->id,
        ]);

        if (null === $exchangeRate || ! $exchangeRate->rate) {
            return $amount;
        }

        $result = (float)$amount * (float)($this->lastCurrencyCode == $targetCurrency->code ? 1.0 : $exchangeRate->rate);

        if ($this->lastCurrencyCode != $targetCurrency->code) {
            $this->lastCurrencyCode = $targetCurrency->code;
        }

        return $result;
    }

    public function convertToBasePrice($amount, $targetCurrencyCode = null)
    {
        $targetCurrency = ! $targetCurrencyCode
            ? $this->getCurrentCurrency()
            : $this->currencyRepository->findOneByField('code', $targetCurrencyCode);

        if (! $targetCurrency) {
            return $amount;
        }

        $exchangeRate = $this->exchangeRateRepository->findOneWhere([
            'target_currency' => $targetCurrency->id,
        ]);

        if (null === $exchangeRate || ! $exchangeRate->rate) {
            return $amount;
        }

        return (float)$amount / $exchangeRate->rate;
    }

    public function currency($amount = 0)
    {
        if (is_null($amount)) {
            $amount = 0;
        }

        return $this->formatPrice($this->convertPrice($amount), $this->getCurrentCurrency()->code);
    }

    public function currencySymbol($code)
    {
        $formatter = new \NumberFormatter(app()->getLocale() . '@currency=' . $code, \NumberFormatter::CURRENCY);

        return $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }

    public function formatPrice($price, $currencyCode)
    {
        if (is_null($price))
            $price = 0;

        $formatter = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($price, $currencyCode);
    }

    public function getAccountJsSymbols()
    {
        $formater = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);

        $pattern = $formater->getPattern();

        $pattern = str_replace("¤", "%s", $pattern);

        $pattern = str_replace("#,##0.00", "%v", $pattern);

        return [
            'symbol'  => core()->currencySymbol(core()->getCurrentCurrencyCode()),
            'decimal' => $formater->getSymbol(\NumberFormatter::DECIMAL_SEPARATOR_SYMBOL),
            'format'  => $pattern,
        ];
    }

    public function formatBasePrice($price)
    {
        if (is_null($price)) {
            $price = 0;
        }

        $formater = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);

        if ($symbol = $this->getBaseCurrency()->symbol) {
            if ($this->currencySymbol($this->getBaseCurrencyCode()) == $symbol) {
                return $formater->formatCurrency($price, $this->getBaseCurrencyCode());
            } else {
                $formater->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, $symbol);

                return $formater->format($this->convertPrice($price));
            }
        } else {
            return $formater->formatCurrency($price, $this->getBaseCurrencyCode());
        }
    }

    public function isChannelDateInInterval($dateFrom = null, $dateTo = null)
    {
        $channel = $this->getCurrentChannel();

        $channelTimeStamp = $this->channelTimeStamp($channel);

        $fromTimeStamp = strtotime($dateFrom);

        $toTimeStamp = strtotime($dateTo);

        if ($dateTo) {
            $toTimeStamp += 86400;
        }

        if (! $this->is_empty_date($dateFrom) && $channelTimeStamp < $fromTimeStamp) {
            $result = false;
        } elseif (! $this->is_empty_date($dateTo) && $channelTimeStamp > $toTimeStamp) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    public function channelTimeStamp($channel)
    {
        $timezone = $channel->timezone;

        $currentTimezone = @date_default_timezone_get();

        @date_default_timezone_set($timezone);

        $date = date('Y-m-d H:i:s');

        @date_default_timezone_set($currentTimezone);

        return strtotime($date);
    }

    function is_empty_date($date)
    {
        return preg_replace('#[ 0:-]#', '', $date) === '';
    }

    public function formatDate($date = null, $format = 'Y-m-d H:i:s')
    {
        if (is_null($date)) {
            $date = Carbon::now();
        }
        else {
            $date = Carbon::create($date);
        }
        return $date->format($format);
    }

    public function CustomCarbon($date = null)
    {
        if (is_null($date)) {
            $date = Carbon::now();
        }
        else {
            $date = Carbon::create($date);
        }
        return $date;
    }

    public function addDays($date = null, $days = 0)
    {
        if (!is_null($date)) {
            $date = Carbon::create($date)->addDays($days);
        }
        return $date;
    }

    public function retrieveGroupConfig($criteria)
    {
        return $criteria;
    }

    public function getAllProvincias()
    {
        return $this->ubicaciongeograficaRepository->where('idpadre',null)->get();
    }

    public function getCantones($id = null)
    {
        if($id!='null'){
            return $this->ubicaciongeograficaRepository->where('idpadre',$id)->orderBy('nombre', 'asc')->get();
        }
    }

    public function getParroquias($id=null)
    {
        if($id!='null'){
            return $this->ubicaciongeograficaRepository->where('idpadre',$id)->orderBy('nombre', 'asc')->get();
        }
    }

    public function country_name($code)
    {
        $country = $this->countryRepository->findOneByField('code', $code);

        return $country ? $country->name : '';
    }

    public function states($countryCode)
    {
        return $this->countryStateRepository->findByField('country_code', $countryCode);
    }

    public function groupedStatesByCountries()
    {
        $collection = [];

        foreach ($this->countryStateRepository->all() as $state) {
            $collection[$state->country_code][] = $state->toArray();
        }

        return $collection;
    }

    public function findStateByCountryCode($countryCode = null, $stateCode = null)
    {
        $collection = array();

        $collection = $this->countryStateRepository->findByField(['country_code' => $countryCode, 'code' => $stateCode]);

        if (count($collection)) {
            return $collection->first();
        } else {
            return false;
        }
    }

    public function getTimeInterval($startDate, $endDate)
    {
        $timeIntervals = [];

        $totalDays = $startDate->diffInDays($endDate) + 1;
        $totalMonths = $startDate->diffInMonths($endDate) + 1;

        $startWeekDay = Carbon::createFromTimeString($this->xWeekRange($startDate, 0) . ' 00:00:01');
        $endWeekDay = Carbon::createFromTimeString($this->xWeekRange($endDate, 1) . ' 23:59:59');
        $totalWeeks = $startWeekDay->diffInWeeks($endWeekDay);

        if ($totalMonths > 5) {
            for ($i = 0; $i < $totalMonths; $i++) {
                $date = clone $startDate;
                $date->addMonths($i);

                $start = Carbon::createFromTimeString($date->format('Y-m-d') . ' 00:00:01');
                $end = $totalMonths - 1 == $i
                    ? $endDate
                    : Carbon::createFromTimeString($date->format('Y-m-d') . ' 23:59:59');

                $timeIntervals[] = ['start' => $start, 'end' => $end, 'formatedDate' => $date->format('M')];
            }
        } elseif ($totalWeeks > 6) {
            for ($i = 0; $i < $totalWeeks; $i++) {
                $date = clone $startDate;
                $date->addWeeks($i);

                $start = $i == 0
                    ? $startDate
                    : Carbon::createFromTimeString($this->xWeekRange($date, 0) . ' 00:00:01');
                $end = $totalWeeks - 1 == $i
                    ? $endDate
                    : Carbon::createFromTimeString($this->xWeekRange($date, 1) . ' 23:59:59');

                $timeIntervals[] = ['start' => $start, 'end' => $end, 'formatedDate' => $date->format('d M')];
            }
        } else {
            for ($i = 0; $i < $totalDays; $i++) {
                $date = clone $startDate;
                $date->addDays($i);

                $start = Carbon::createFromTimeString($date->format('Y-m-d') . ' 00:00:01');
                $end = Carbon::createFromTimeString($date->format('Y-m-d') . ' 23:59:59');

                $timeIntervals[] = ['start' => $start, 'end' => $end, 'formatedDate' => $date->format('d M')];
            }
        }

        return $timeIntervals;
    }

    public function xWeekRange($date, $day)
    {
        $ts = strtotime($date);

        if (! $day) {
            $start = (date('D', $ts) == 'Sun') ? $ts : strtotime('last sunday', $ts);

            return date('Y-m-d', $start);
        } else {
            $end = (date('D', $ts) == 'Sat') ? $ts : strtotime('next saturday', $ts);

            return date('Y-m-d', $end);
        }
    }

    public function sortItems($items)
    {
        foreach ($items as &$item) {
            if (count($item['children'])) {
                $item['children'] = $this->sortItems($item['children']);
            }
        }

        usort($items, function ($a, $b) {
            if ($a['sort'] == $b['sort']) {
                return 0;
            }

            return ($a['sort'] < $b['sort']) ? -1 : 1;
        });

        return $this->convertToAssociativeArray($items);
    }

    public function getConfigField($fieldName)
    {
        foreach (config('core') as $coreData) {
            if (isset($coreData['fields'])) {
                foreach ($coreData['fields'] as $field) {
                    $name = $coreData['key'] . '.' . $field['name'];

                    if ($name == $fieldName) {
                        return $field;
                    }
                }
            }
        }
    }

    public function convertToAssociativeArray($items)
    {
        foreach ($items as $key1 => $level1) {
            unset($items[$key1]);
            $items[$level1['key']] = $level1;

            if (count($level1['children'])) {
                foreach ($level1['children'] as $key2 => $level2) {
                    $temp2 = explode('.', $level2['key']);
                    $finalKey2 = end($temp2);
                    unset($items[$level1['key']]['children'][$key2]);
                    $items[$level1['key']]['children'][$finalKey2] = $level2;

                    if (count($level2['children'])) {
                        foreach ($level2['children'] as $key3 => $level3) {
                            $temp3 = explode('.', $level3['key']);
                            $finalKey3 = end($temp3);
                            unset($items[$level1['key']]['children'][$finalKey2]['children'][$key3]);
                            $items[$level1['key']]['children'][$finalKey2]['children'][$finalKey3] = $level3;
                        }
                    }

                }
            }
        }

        return $items;
    }

    public function array_set(&$array, $key, $value)
    {
        if (is_null($key)) {
            return $array = $value;
        }

        $keys = explode('.', $key);
        $count = count($keys);

        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (! isset($array[$key]) || ! is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $finalKey = array_shift($keys);

        if (isset($array[$finalKey])) {
            $array[$finalKey] = $this->arrayMerge($array[$finalKey], $value);
        } else {
            $array[$finalKey] = $value;
        }

        return $array;
    }

    protected function arrayMerge(array &$array1, array &$array2)
    {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = $this->arrayMerge($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }

    public function convertEmptyStringsToNull($array)
    {
        foreach ($array as $key => $value) {
            if ($value == "" || $value == "null") {
                $array[$key] = null;
            }
        }

        return $array;
    }

    public function getSingletonInstance($className)
    {
        static $instance = [];

        if (array_key_exists($className, $instance)) {
            return $instance[$className];
        }

        return $instance[$className] = app($className);
    }

    public static function taxRateAsIdentifier(float $taxRate): string
    {
        return str_replace('.', '_', (string)$taxRate);
    }

    public function getSenderEmailDetails()
    {
        $sender_name = core()->getConfigData('general.general.email_settings.sender_name') ? core()->getConfigData('general.general.email_settings.sender_name') : config('mail.from.name');

        $sender_email = core()->getConfigData('general.general.email_settings.shop_email_from') ? core()->getConfigData('general.general.email_settings.shop_email_from') : config('mail.from.address');

        return [
            'name'  => $sender_name,
            'email' => $sender_email,
        ];
    }

    public function getAdminEmailDetails()
    {
        $admin_name = core()->getConfigData('general.general.email_settings.admin_name') ? core()->getConfigData('general.general.email_settings.admin_name') : config('mail.admin.name');

        $admin_email = core()->getConfigData('general.general.email_settings.admin_email') ? core()->getConfigData('general.general.email_settings.admin_email') : config('mail.admin.address');

        return [
            'name'  => $admin_name,
            'email' => $admin_email,
        ];
    }
}