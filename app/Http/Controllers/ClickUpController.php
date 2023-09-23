<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ClickUpController extends Controller
{
    public function workspace()
    {
        $workspaces = $this->callApi("team", "GET");

        return $workspaces->teams;
    }

    public function spaces($workspace_id)
    {
        $spaces = $this->callApi("team/" . $workspace_id . "/space", "GET");
        return $spaces->spaces;
    }

    public function getLists($space_id)
    {
        $lists = $this->callApi('space/' . $space_id . '/list', 'GET');
        return $lists->lists;
    }

    public function users($list_id)
    {
        $users = $this->callApi('list/' . $list_id . '/member', 'GET');
        return $users->members;
    }

    public function addTask($list_id, $name, $description, $assignees, $watchers)
    {
        $task = $this->callApi('list/' . $list_id . '/task', 'POST', [
            "name" => $name,
            "description" => $description,
            "assignees" => $assignees,
            "watchers" => $watchers
        ]);
        return $task;
    }

    private function callApi($endpoint, $http_method, $payload = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Authorization: " . env('CLICKUP_API_KEY'),
                "Content-Type: application/json"
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_URL => "https://api.clickup.com/api/v2/" . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $http_method,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            throw new Exception("cURL Error #:" . $error);
        } else {
            return json_decode($response);
        }
    }
}
