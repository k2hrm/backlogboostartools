<?php

namespace App\Http\Controllers;

use App\Models\Outputitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Setting;
use App\Models\Outputitems;
use App\Models\Project;
use App\Models\UserProject;
use Validator;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
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
            $userIdNames = [];
            return view('/settings/list', [
                'settings' => $settings,
                'outputitems' => $outputitems,
                'user_projects' => $user_projects,
                'userIdNames' => $userIdNames
            ]);
        } else {
            return view('/settings/nomember');
        }
    }

    function getUserNameFromId($userId, $hostname, $apiKey)
    {
        $headers = array('Content-Type:application/x-www-form-urlencoded');
        $context = array(
            'http' => array(
                'method' => 'GET',
                'header' => $headers,
                'ignore_errors' => true
            )
        );
        $url = 'https://' . $hostname . '/api/v2/users/' . $userId . '?apiKey=' . $apiKey;
        $response = file_get_contents($url, false, stream_context_create($context));
        $json = mb_convert_encoding($response, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = json_decode($json, true);
        return $json["name"];
    }

    public function edit(Request $request)
    {
        $user_id = Auth::id();
        $settings = Setting::where('user_id', $user_id)->first();
        $outputitems = Outputitem::where('user_id', $user_id)->first();
        $user_projects = UserProject::where('user_id', $user_id)->get();
        $api_key = Cookie::get('api_key');
        if ($api_key) {
            return view('settings/edit', compact('settings', 'outputitems', 'user_projects', 'request'));
        } else {
            return redirect('timeout');
        }
    }

    public function confirm(Request $request)
    {
        $api_key = Cookie::get('api_key');
        if ($api_key) {
            $userIdNames = [];
            foreach ($request->asignee_ids_old as $asignee_id_old) {
                if (!empty($asignee_id_old)) {
                    $userIdName[] = $asignee_id_old;
                    $userIdName[] = $this->getUserNameFromId($asignee_id_old, $request->hostname, $api_key);
                }
                $userIdNames[] = $userIdName;
                $userIdName = [];
            }
            return view('settings/confirm', compact('userIdNames', 'request'));
        } else {
            return redirect('timeout');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hostname' => 'required|max:255',
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // Eloquentモデル（登録処理）
        $settings = Setting::where('user_id', $request->user_id)->first();
        if ($settings === null) {
            $settings = new Setting;
        }
        $settings->user_id = $request->user_id;
        $settings->hostname = $request->hostname;
        $settings->bl_user_id = $request->bl_user_id;
        $settings->save();

        $outputitems = Outputitem::where('user_id', $request->user_id)->first();
        if ($outputitems === null) {
            $outputitems = new Outputitem;
        }
        $outputitems->user_id = $request->user_id;
        if ($request->vip_issueType === "vip_issueType") {
            $outputitems->vip_issueType = true;
        } else {
            $outputitems->vip_issueType = false;
        }
        if ($request->vip_key === "vip_key") {
            $outputitems->vip_key = true;
        } else {
            $outputitems->vip_key = false;
        }
        if ($request->vip_summary === "vip_summary") {
            $outputitems->vip_summary = true;
        } else {
            $outputitems->vip_summary = false;
        }
        if ($request->vip_assigner === "vip_assigner") {
            $outputitems->vip_assigner = true;
        } else {
            $outputitems->vip_assigner = false;
        }
        if ($request->vip_status === "vip_status") {
            $outputitems->vip_status = true;
        } else {
            $outputitems->vip_status = false;
        }
        if ($request->vip_priority === "vip_priority") {
            $outputitems->vip_priority = true;
        } else {
            $outputitems->vip_priority = false;
        }
        if ($request->vip_created === "vip_created") {
            $outputitems->vip_created = true;
        } else {
            $outputitems->vip_created = false;
        }
        if ($request->vip_startDate === "vip_startDate") {
            $outputitems->vip_startDate = true;
        } else {
            $outputitems->vip_startDate = false;
        }
        if ($request->vip_estimatedHours === "vip_estimatedHours") {
            $outputitems->vip_estimatedHours = true;
        } else {
            $outputitems->vip_estimatedHours = false;
        }
        if ($request->vip_updated === "vip_updated") {
            $outputitems->vip_updated = true;
        } else {
            $outputitems->vip_updated = false;
        }
        if ($request->vip_createdUser === "vip_createdUser") {
            $outputitems->vip_createdUser = true;
        } else {
            $outputitems->vip_createdUser = false;
        }

        $outputitems->save();
        if ($request->project_keys) {
            foreach ($request->project_keys as $pkey) {
                $user_projects = new UserProject;
                $user_projects->project_key = $pkey;

                foreach ($request->asignee_ids as $aid) {
                    $user_projects->asignee_id = $aid;
                    $user_projects->user_id = $request->user_id;
                    $user_projects->save();
                }
            }
        }

        if ($request->user_project_ids > 0) {
            for ($i = 0; $i <= count($request->user_project_ids) - 1; $i++) {
                $user_projects_old = UserProject::find($request->user_project_ids[$i]);
                $user_projects_old->project_key = $request->project_keys_old[$i];
                $user_projects_old->asignee_id = $request->asignee_ids_old[$i];
                $user_projects_old->save();
            }
        }

        return redirect('/settings');
    }
}
