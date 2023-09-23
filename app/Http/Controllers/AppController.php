<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class AppController extends Controller
{
    public function index()
    {
        $workspaces = [];
        $channels = [];

        $error = '';

        try {
            $click_up = new ClickUpController();

            $workspaces = $click_up->workspace();

            $slack = new SlackController();

            $channels = $slack->getChannels();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }

        return view('index', ['workspaces' => $workspaces, 'channels' => $channels, 'error' => $error]);
    }

    public function getSpaces($workspace_id)
    {
        try {
            $click_up = new ClickUpController();

            $spaces = $click_up->spaces($workspace_id);

            return response()->json(['ok' => true, 'spaces' => $spaces]);
        } catch (\Throwable $th) {
            return response()->json(['ok' => false, 'error' => $th->getMessage()]);
        }
    }

    public function getLists($space_id)
    {
        try {
            $lists = new ClickUpController();
            $list = $lists->getLists($space_id);

            return response()->json(['ok' => true, 'list' => $list]);
        } catch (\Throwable $th) {
            return response()->json(['ok' => false, 'error' => $th->getMessage()]);
        }
    }

    public function getUsers($user_id)
    {
        try {
            $users = new ClickUpController();
            $members = $users->users($user_id);

            return response()->json(['ok' => true, 'members' => $members]);
        } catch (\Throwable $th) {
            return response()->json(['ok' => false, 'error' => $th->getMessage()]);
        }
    }

    public function addTask(Request $request)
    {
        try {
            $newTask = new ClickUpController();
            $task = $newTask->addTask($request->input('list_id'), $request->input('taskName'), $request->input('taskDescription'), $request->input('assegnat_id'), $request->input('osservatori_id'));

            if (!isset($task->id)) {
                throw new Exception('Error creating task');
            }

            $newNotification = new SlackController();
            $notific = $newNotification->sendNotificaton($request->input('slack_id'), $task->name, $task->description, $task->url);

            if (!isset($notific->ok) || !$notific->ok) {
                throw new Exception('Error sending slack notification');
            }

            return response()->json(['ok' => true]);
        } catch (\Throwable $th) {
            return response()->json(['ok' => false, 'error' => $th->getMessage()]);
        }
    }
}
