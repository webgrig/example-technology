<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        set_time_limit(10000000000);
        ini_set('max_execution_time', 10000000000);
        ini_set('memory_limit', '5095M');
        $firstDateAPI = '1999-01-04';
        $amountFirstDateAPI = 27;
        $reader = new \XMLReader();
        if (!$reader->open("https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml")) {
            die("Failed to open 'eurofxref-hist.xml'");
        }
        while ($reader->read() && $reader->localName !== 'Cube') {
            continue;
        }
        while ($reader->read()) {
            $amountFirstDateDB = Currency::where('date', '=', $firstDateAPI)->count();
            $SimpleXML = new \SimpleXMLElement($reader->readOuterXml());
            $amountChildrenXML = $SimpleXML->count();
            $time = $reader->getAttribute('time');
            $lastAPIDate = !isset($lastAPIDate) ? $time : $lastAPIDate;
            $amountCurrentDateDB = Currency::where('date', '=', $time)->count();
            if (($amountCurrentDateDB == $amountChildrenXML) && ($amountFirstDateDB == $amountFirstDateAPI)){
                break;
            }
            if ($time && ($amountCurrentDateDB < $amountChildrenXML)) {
                foreach ($SimpleXML->Cube as $attributes) {
                    $currencyName = strval($attributes->attributes()['currency']);
                    $currencyRate = strval($attributes->attributes()['rate']);
                    $data = [
                        'date' => $time,
                        'currency' => $currencyName,
                        'rate' => $currencyRate
                    ];
                    $existItem = Currency::where('date', '=', $time)->where('currency', '=', $currencyName)->count();
                    if (!$existItem) {
                        $currency = Currency::factory()
                            ->create($data);
                        Cache::rememberForever('currency_' . $time . '_' . $currency->id, function () use ($data) {
                            return json_encode([
                                'currency' => $data['currency'],
                                'rate' => $data['rate']
                            ]);
                        });
                    }
                }
            }
            else{$reader->next();}
        }
        $reader->close();
        echo 'OK';
    }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public
        function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function show($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($id)
        {
            //
        }
    }
