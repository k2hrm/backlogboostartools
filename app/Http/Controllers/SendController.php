<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendController extends Controller
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
        return view('send/index');
    }

    public function result(Request $request)
    {
        $projKeys = $request->proj_key;
        $projKeysArr = explode(",", $projKeys);
        $summary = $request->title;
        $description = $request->description;
        $hostname = $request->hostname;
        $apiKey = $request->api_key;
        foreach ($projKeysArr as $projKey) {
            $projId = $this->getProjectIdFromKey($projKey, $hostname, $apiKey);
            $params = array(
                'summary' => $summary,
                'description' => $description,
                'projectId'       => $projId,                                 // プロジェクトID
                'issueTypeId'     => $this->getIssueIdFromProjId($projId, $hostname, $apiKey),                                 // 種別ID
                'priorityId'      => 4,                                    // 優先度
            );
            $headers = array('Content-Type:application/x-www-form-urlencoded');
            $context = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => $headers,
                    'ignore_errors' => true
                )
            );
            $url = 'https://' . $hostname . '/api/v2/issues?apiKey=' . $apiKey . '&' . http_build_query($params, '', '&');
            $response = file_get_contents($url, false, stream_context_create($context));
        }
        return view('send/result');
    }

    function getIssueIdFromProjId($projId, $hostname, $apiKey)
    {
        $headers = array('Content-Type:application/x-www-form-urlencoded');
        $context = array(
            'http' => array(
                'method' => 'GET',
                'header' => $headers,
                'ignore_errors' => true
            )
        );
        $url = 'https://' . $hostname . '/api/v2/projects/' . $projId . '/issueTypes?apiKey=' . $apiKey;
        $response = file_get_contents($url, false, stream_context_create($context));
        $json = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = json_decode($json, true);
        foreach ($json as $v) {
            if ($v["name"] === "その他") {
                return $v["id"];
            }
        }
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
