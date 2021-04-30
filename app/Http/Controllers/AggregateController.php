<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AggregateController extends Controller
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
        $vip_issueType = $request->vip_issueType;
        $vip_key = $request->vip_key;
        $vip_summary = $request->vip_summary;
        $vip_assigner = $request->vip_assigner;
        $vip_status = $request->vip_status;
        $vip_priority = $request->vip_priority;
        $vip_component = $request->vip_component;
        $vip_version = $request->vip_version;
        $vip_milestone = $request->vip_milestone;
        $vip_created = $request->vip_created;
        $vip_startDate = $request->vip_startDate;
        $vip_limitDate = $request->vip_limitDate;
        $vip_estimatedHours = $request->vip_estimatedHours;
        $vip_actualHours = $request->vip_actualHours;
        $vip_updated = $request->vip_updated;
        $vip_createdUser = $request->vip_createdUser;
        $vip_fileAttachment = $request->vip_fileAttachment;
        $vip_fileShared = $request->vip_fileShared;
        $proj_id = $this->getProjectIdFromKey($proj_key, $hostname, $apiKey);
        $from_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $frommonth, $fromday, $fromyear));
        $from_date_jst = new DateTime($from_date);
        $from_date_jst->setTime(00, 00, 00);
        $to_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $tomonth, $today, $toyear));
        $to_date_jst = new DateTime($to_date);
        $to_date_jst->setTime(23, 59, 59);
        date_default_timezone_set("Asia/Tokyo");
        $from_date_for_api = date('Y-m-d', mktime(0, 0, 0, $frommonth, $fromday, $fromyear));
        Cookie::queue('api_key', $request->api_key, 10);
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
        //ヘッダ行作成
        $csvHeader = [];
        $totalCol = [];
        if ($vip_issueType === 'vip_issueType') {
            array_push($csvHeader, "種別");
            array_push($totalCol, "");
        }
        if ($vip_key === 'vip_key') {
            array_push($csvHeader, "キー");
            array_push($totalCol, "");
        }
        if ($vip_summary === 'vip_summary') {
            array_push($csvHeader, "件名");
            array_push($totalCol, "");
        }
        if ($vip_assigner === 'vip_assigner') {
            array_push($csvHeader, "担当者");
            array_push($totalCol, "");
        }
        if ($vip_status === 'vip_status') {
            array_push($csvHeader, "状態");
            array_push($totalCol, "");
        }
        if ($vip_priority === 'vip_priority') {
            array_push($csvHeader, "優先度");
            array_push($totalCol, "");
        }
        if ($vip_created === 'vip_created') {
            array_push($csvHeader, "登録日");
            array_push($totalCol, "");
        }
        if ($vip_startDate === 'vip_startDate') {
            array_push($csvHeader, "開始日");
            array_push($totalCol, "");
        }
        if ($vip_estimatedHours === 'vip_estimatedHours') {
            array_push($csvHeader, "予定時間");
            array_push($totalCol, "");
        }
        if ($vip_updated === 'vip_updated') {
            array_push($csvHeader, "更新日");
            array_push($totalCol, "");
        };
        if ($vip_createdUser === 'vip_createdUser') {
            array_push($csvHeader, "登録者");
            array_push($totalCol, "");
        }
        array_push($csvHeader, "実績時間集計結果(h)");
        array_push($issueKeyAndHoursArrs, $csvHeader);
        foreach ($result as $value) {
            $created = new DateTime($value["created"]);
            $updated = new DateTime($value["updated"]);
            date_default_timezone_set("Asia/Tokyo");
            if ($updated >= $from_date_jst) {
                if (
                    $created >= $from_date_jst
                    && $updated <= $to_date_jst
                ) {
                    if ($value["actualHours"]) {
                        $actualHours = $value["actualHours"];
                    }
                } else {
                    $actualHours = $this->getMonthlyHours($value["issueKey"], $from_date_jst, $to_date_jst, $apiKey, $hostname);
                }
                if ($created <= $to_date_jst && $created >= $from_date_jst || $actualHours > 0) {
                }
            }

            if ($actualHours > 0) {
                if ($vip_issueType === 'vip_issueType') {
                    if ($value["issueType"]["name"]) {
                        array_push($issueKeyAndHoursArr, $value["issueType"]["name"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_key === 'vip_key') {
                    if ($value["issueKey"]) {
                        array_push($issueKeyAndHoursArr, $value["issueKey"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_summary === 'vip_summary') {
                    if ($value["summary"]) {
                        array_push($issueKeyAndHoursArr, $value["summary"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_assigner === 'vip_assigner') {
                    if ($value["assignee"]["name"]) {
                        array_push($issueKeyAndHoursArr, $value["assignee"]["name"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_status === 'vip_status') {
                    if ($value["status"]["name"]) {
                        array_push($issueKeyAndHoursArr, $value["status"]["name"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_priority === 'vip_priority') {
                    if ($value["priority"]["name"]) {
                        array_push($issueKeyAndHoursArr, $value["priority"]["name"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_created === 'vip_created') {
                    if ($value["created"]) {
                        array_push($issueKeyAndHoursArr, $value["created"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_startDate === 'vip_startDate') {
                    if ($value["startDate"]) {
                        array_push($issueKeyAndHoursArr, $value["startDate"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_estimatedHours === 'vip_estimatedHours') {
                    if ($value["estimatedHours"]) {
                        array_push($issueKeyAndHoursArr, $value["estimatedHours"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                if ($vip_updated === 'vip_updated') {
                    if ($value["updated"]) {
                        array_push($issueKeyAndHoursArr, $value["updated"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                };
                if ($vip_createdUser === 'vip_createdUser') {
                    if ($value["createdUser"]["name"]) {
                        array_push($issueKeyAndHoursArr, $value["createdUser"]["name"]);
                    } else {
                        array_push($issueKeyAndHoursArr, "");
                    }
                }
                array_push($issueKeyAndHoursArr, $actualHours);
                array_push($issueKeyAndHoursArrs, $issueKeyAndHoursArr);
            }
            $totalHours += number_format($actualHours, 3);
            $issueKeyAndHoursArr = [];
            $actualHours = 0;
        }
        array_push($totalCol, $totalHours);
        array_push($issueKeyAndHoursArrs, $totalCol);
        //dd($issueKeyAndHoursArrs);
        return view('aggregate/result', compact('issueKeyAndHoursArrs', 'proj_key', 'from_date', 'to_date'));
        //dd($result);
        //dd($totalHours);
    }

    public function csv(Request $request)
    {
        $now = Carbon::now();
        $response = new StreamedResponse(
            function () use ($request) {
                $stream = fopen('php://output', 'w');
                if ($request->result) {
                    foreach ($request->result as $line) {
                        mb_convert_variables('SJIS-win', 'UTF-8', $line);
                        fputcsv($stream, $line);
                    }
                }
                fclose($stream);
            },
            \Illuminate\Http\Response::HTTP_OK,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename=' . $now->format('YmdHis') . '.csv',
            ]
        );

        return $response;
    }


    function getMonthlyHours($issueKey, $from_date_jst, $to_date_jst, $apiKey, $hostname)
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
            $updated = new DateTime($value["updated"]);
            date_default_timezone_set("Asia/Tokyo");
            if ($updated >= $from_date_jst && $updated <= $to_date_jst) {
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
