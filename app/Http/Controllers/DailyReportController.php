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
        if ($day == "this") {
            $tgt_day_from = new \DateTime("now 00:00:00", new \DateTimeZone('Asia/Tokyo'));
            $tgt_day_from->setTimezone(new \DateTimeZone('UTC'));
            $tgt_day_from = $tgt_day_from->format('Y-m-d\TH:i:s') . 'Z';
            $tgt_day_to = new \DateTime("now 23:59:59", new \DateTimeZone('Asia/Tokyo'));
            $tgt_day_to->setTimezone(new \DateTimeZone('UTC'));
            $tgt_day_to = $tgt_day_to->format('Y-m-d\TH:i:s') . 'Z';
        } else {
            $tgt_day_from = new \DateTime("-1 day 00:00:00", new \DateTimeZone('Asia/Tokyo'));
            $tgt_day_from->setTimezone(new \DateTimeZone('UTC'));
            $tgt_day_from = $tgt_day_from->format('Y-m-d\TH:i:s') . 'Z';
            $tgt_day_to = new \DateTime("-1 day 23:59:59", new \DateTimeZone('Asia/Tokyo'));
            $tgt_day_to->setTimezone(new \DateTimeZone('UTC'));
            $tgt_day_to = $tgt_day_to->format('Y-m-d\TH:i:s') . 'Z';
        }
        $headers = array('Content-Type:application/x-www-form-urlencoded');
        $context = array(
            'http' => array(
                'method' => 'GET',
                'header' => $headers,
                'ignore_errors' => false
            )
        );
        $url = 'https://' . $hostname . '/api/v2/users/' . $userId . '/activities?apiKey=' . $myApiKey . '&count=100';;
        $response = file_get_contents($url, false, stream_context_create($context));
        # レスポンスを変数で扱えるように変換
        $json = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = json_decode($json, true);

        $projKeys = [];
        foreach ($json as $value) {
            if (
                $value["created"] >= $tgt_day_from
            ) {
                $projKeys[] = $value["project"]["projectKey"];
            }
        }
        $projKeys = array_unique($projKeys);

        $issues = [];
        foreach ($json as $value) {
            if (
                $value["created"] >= $tgt_day_from &&
                $value["created"] <= $tgt_day_to
            ) {
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
        if (count($issues) !== 0) {
            array_multisort($sort, SORT_ASC, $issues);
        }
        return view('dailyreport/result', compact('issues', 'projKeys', 'userId', 'day'));
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
