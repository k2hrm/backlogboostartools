<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dailyreport/index');
    }

    public function result(Request $request)
    {
        $userId = $request->bl_user_id;
        $myApiKey = $request->api_key;
        $hostname = $request->hostname;
        $day = $request->day;
        header('Content-Type: text/html; charset=UTF-8');
        $cnt = 0;
        date_default_timezone_set("Asia/Tokyo");
        $timestamp = strtotime('2021/1/22 10:20:30');
        if ($day == "this") {
            $tgt_day = date("Y-m-d 00:00:00");
        } else {
            $tgt_day = date('Y-m-d 00:00:00', strtotime('-1 day'));
        }
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
            $url = 'https://' . $hostname . '/api/v2/users/' . $userId . '/activities?apiKey=' . $myApiKey;
            $response = file_get_contents($url, false, stream_context_create($context));
            # レスポンスを変数で扱えるように変換
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

        $projKeys = [];
        foreach ($result as $value) {
            if ($value["created"] >= $tgt_day) {
                $projKeys[] = $value["project"]["projectKey"];
            }
        }
        $projKeys = array_unique($projKeys);

        $issues = [];
        foreach ($result as $value) {
            if ($value["created"] >= $tgt_day) {
                $issue['key'] = $this->getKey($value["content"]["id"], $hostname, $myApiKey);
                $issue['title'] = $value["content"]["summary"];
                $issue['pjkey'] = $value["project"]["projectKey"];
                $issues[] = $issue;
                $issue = [];
            }
        }
        $issues = $this->myArrayUnique($issues);
        foreach ($issues as $key => $value) {
            $sort[$key] = $value['pjkey'];
        }
        array_multisort($sort, SORT_ASC, $issues);
        $f_tgt_day = substr($tgt_day, 0, 10);
        return view('dailyreport/result', compact('issues', 'projKeys', 'userId', 'f_tgt_day'));
    }

    function myArrayUnique($array)
    {
        $uniqueArray = [];
        foreach ($array as $key => $value) {
            if (!in_array($value, $uniqueArray)) {
                $uniqueArray[$key] = $value;
            }
        }
        return $uniqueArray;
    }
    function getKey($keyid, $host, $apiKey)
    {
        $result = [];
        $headers = array('Content-Type:application/x-www-form-urlencoded');
        $context = array(
            'http' => array(
                'method' => 'GET',
                'header' => $headers,
                'ignore_errors' => false
            )
        );

        $url = 'https://' . $host . '/api/v2/issues/' . $keyid . '?apiKey=' . $apiKey;
        $response = file_get_contents($url, false, stream_context_create($context));
        # レスポンスを変数で扱えるように変換
        $json = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = json_decode($json, true);
        return  $json["issueKey"];
    }
}
