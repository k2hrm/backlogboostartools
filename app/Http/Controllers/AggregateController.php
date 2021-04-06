<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AggregateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('aggregate/index');
    }

    public function result(Request $request)
    {
        $proj_key = $request->proj_key;
        $fromyear = $request->periodyearfrom;
        $frommonth = $request->periodmonthfrom;
        $fromday = $request->perioddayfrom;
        $toyear =  $request->periodyearto;
        $tomonth =  $request->periodmonthto;
        $today =  $request->perioddayto;
        $apiKey =  $request->api_key;
        $hostname =  $request->hostname;
        $proj_id = $this->getProjectIdFromKey($proj_key, $hostname, $apiKey);
        dd($proj_id);
        $from_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $frommonth, $fromday, $fromyear));
        $to_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $tomonth, $today, $toyear));
        $from_date_for_api = date('Y-m-d', mktime(0, 0, 0, $frommonth, $fromday, $fromyear));
        return view('aggregate/result', compact('proj_key'));
    }

    function getProjectIdFromKey($projectKey, $hostname, $apiKey)
    {
        $cnt = 0;
        $result = array();

        while (1) {
            $offset = $cnt * 100;
            $headers = array('Content-Type:application/x-www-form-urlencoded');
            $context = array(
                'http' => array(
                    'method' => 'GET',
                    'header' => $headers,
                    'ignore_errors' => false
                )
            );

            $url = 'https://' . $hostname . '/api/v2/projects/' . $projectKey . '?apiKey=' . $apiKey;
            $response = file_get_contents($url, false, stream_context_create($context));
            $json = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
            $json = json_decode($json, true);
            if (count($json) < 100) {
                $result = array_merge($result, $json);
                break;
            } else {
                $cnt++;
                $result = array_merge($result, $json);
            }
        }
        return  $json["id"];
    }
}
