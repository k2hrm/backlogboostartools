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
        $from_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $frommonth, $fromday, $fromyear));
        $to_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $tomonth, $today, $toyear));
        $from_date_for_api = date('Y-m-d', mktime(0, 0, 0, $frommonth, $fromday, $fromyear));
        $cnt = 0;
        $result = array();
        while (1) {
            $offset = $cnt * 100;
            $params = array(
                'projectId[]' => $proj_id,
                'count' => 100,
                'offset' => $offset,
                'sort' => "created",
                'order' => "asc",
                'updatedSince' => $from_date_for_api,
            );

            $headers = array('Content-Type:application/x-www-form-urlencoded');
            $context = array(
                'http' => array(
                    'method' => 'GET',
                    'header' => $headers,
                    'ignore_errors' => false
                )
            );
            $url = 'https://' . $hostname . '/api/v2/issues?apiKey=' . $apiKey . '&' . http_build_query($params, '', '&');
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
        //Jsonから必要なデータを取得・格納
        $totalHours = 0;
        $actualHours = 0;
        $issueKeyAndHoursArr = [];
        $issueKeyAndHoursArrs = [];
        foreach ($result as $value) {
            if ($value["updated"] >= $from_date) {
                if (
                    $value["created"] >= $from_date
                    && $value["updated"] <= $to_date
                ) {
                    if ($value["actualHours"]) {
                        $actualHours = $value["actualHours"];
                    }
                } else {
                    $actualHours = $this->getMonthlyHours($value["issueKey"], $from_date, $to_date, $apiKey, $hostname);
                }
                if ($value["created"] <= $to_date && $value["created"] >= $from_date || $actualHours > 0) {
                }
            }
            array_push($issueKeyAndHoursArr, $value["issueKey"]);
            array_push($issueKeyAndHoursArr, $value["summary"]);
            array_push($issueKeyAndHoursArr, $value["created"]);
            array_push($issueKeyAndHoursArr, $value["updated"]);
            array_push($issueKeyAndHoursArr, $actualHours);
            array_push($issueKeyAndHoursArrs, $issueKeyAndHoursArr);
            $totalHours += number_format($actualHours, 3);
            $issueKeyAndHoursArr = [];
        }
        $totalCol = [];
        $space = '';
        $totalChars = '合計';
        array_push($totalCol, $space);
        array_push($totalCol, $space);
        array_push($totalCol, $space);
        array_push($totalCol, $totalChars);
        array_push($totalCol, $totalHours);
        array_push($issueKeyAndHoursArrs, $totalCol);

        //dd($issueKeyAndHoursArrs);
        return view('aggregate/result', compact('issueKeyAndHoursArrs', 'proj_key', 'from_date', 'to_date'));
        //dd($result);
        //dd($totalHours);
    }


    function getMonthlyHours($issueKey, $from_date, $to_date, $apiKey, $hostname)
    {
        $cnt = 0;
        while (1) {
            $minId = 0;
            $headers = array('Content-Type:application/x-www-form-urlencoded');
            $context = array(
                'http' => array(
                    'method' => 'GET',
                    'header' => $headers,
                    'ignore_errors' => false,
                    'minId' => $minId,
                )
            );
            $url = 'https://' . $hostname . '/api/v2/issues/' . $issueKey . '/comments?apiKey=' . $apiKey . '&order=desc&count=100';
            $commentResponse = file_get_contents($url, false, stream_context_create($context));
            # レスポンスを変数で扱えるように変換
            $json = mb_convert_encoding($commentResponse, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
            $json = json_decode($json, true);
            if (count($json) < 100) {
                break;
            } else {
                echo '<p style="color:red;">100以上コメントのある課題があります。Backlog API仕様により最大取得可能なコメント数は100件となっております。下記コメントを含む課題は別途集計してください</p>';
                echo $commentResponse;
                break;
            }
        }
        $hoursInMonthTotal = 0;
        foreach ($json as $value) {
            $cnt = 0;
            if ($value["updated"] >= $from_date && $value["updated"] <= $to_date) {
                foreach ($value["changeLog"] as $changeLog) {
                    if ($changeLog["field"] === "actualHours") {
                        $hoursInMonth = number_format($changeLog["newValue"], 2) - number_format($changeLog["originalValue"], 2);
                        $hoursInMonthTotal += $hoursInMonth;
                    }
                }
            }
        }
        return $hoursInMonthTotal;
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
