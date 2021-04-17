<?php

namespace App\Http\Controllers;

use App\Models\UserProject;
use App\Models\Setting;
use App\Models\Outputitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            $settings = Setting::where('user_id', Auth::user()->id)->get();
            $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
            $user_projects = UserProject::where('user_id', Auth::user()->id)->get();
            return view('/send/member', [
                'settings' => $settings,
                'outputitems' => $outputitems,
                'user_projects' => $user_projects,
            ]);
        } else {
            return view('/send/nomember');
        }
    }

    public function result(Request $request)
    {
        $projKeysArr = $request->project_keys;
        $asigneeIdsArr = $request->asignee_ids;

        $summary = $request->title;
        $description = $request->description;
        $hostname = $request->hostname;
        $apiKey = $request->api_key;

        if ($projKeysArr) {
            for ($i = 0; $i <= count($projKeysArr) - 1; $i++) {
                $projId = $this->getProjectIdFromKey(trim($projKeysArr[$i]), $hostname, $apiKey);
                $params = array(
                    'summary' => $summary,
                    'description' => $description,
                    'projectId'       => $projId,
                    'issueTypeId'     => $this->getIssueIdFromProjId($projId, $hostname, $apiKey),
                    'priorityId'      => 4,
                    'assigneeId' => trim($asigneeIdsArr[$i])
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
