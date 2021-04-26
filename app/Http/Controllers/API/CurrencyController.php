<?php

namespace App\Http\Controllers\API;

use App\Events\AddCurrency;
use App\Events\NewConnection;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CurrencyController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $start = microtime(true);
        event(new NewConnection());
        $file = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml';
        $curDate = date("Y-m-d");
        $newFileName = 'currencies_' . $curDate . '.xml';
        $newFile = storage_path() . '\\' . $newFileName;
        if (!file_exists($newFile)) {
            array_map('unlink', array_filter((array) glob(storage_path() . '\currencies_*.xml')));
            if (copy($file, $newFile)){
                $reader = new \XMLReader();
                Redis::select(0);
                if ($reader->open($newFile)) {
                    while ($reader->read() && $reader->localName !== 'Cube') {
                        continue;
                    }
                    $allDatesInFile = substr_count(file_get_contents($newFile), 'Cube time="');
                    exec('redis-cli KEYS "currency_*" | wc -l', $output, $retval);
                    $execFirstTime = ($allDatesInFile - $output[0]) > 10 ? true : false;
                    while ($reader->read()) {
                        if (!$execFirstTime){
                            exec('redis-cli KEYS "currency_*" | wc -l', $output, $retval);
                            if ($allDatesInFile == $output[0]){
                                break;
                            }
                        }
                        $SimpleXML = new \SimpleXMLElement($reader->readOuterXml());
                        $amountChildrenXML = $SimpleXML->count();
                        $date = $reader->getAttribute('time');
                        if (!$amountChildrenXML || !$date){
                            continue;
                        }
                        $lastAPIDate = !isset($lastAPIDate) ? $date : $lastAPIDate;
                        if ($date) {
                            foreach ($SimpleXML->Cube as $attributes) {
                                $currencyName = strval($attributes->attributes()['currency']);
                                $currencyRate = strval($attributes->attributes()['rate']);
                                $hKey = 'currency_' . $date;
                                Redis::hSet($hKey, $currencyName, $currencyRate);
                            }
                            AddCurrency::dispatch($date);
                        }
                        else{$reader->next();}
                    }
                    $reader->close();
                }
                else{
                    return "Failed to open " . basename($file);
                }
            }
            else{
                return "Failed to copy remote file " . basename($file);
            }

        }
        echo 'Script execution time: ' . (microtime(true) - $start) . ' sec.';
        return true;
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
