<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;
use App\Models\ProjectModel;
use App\Models\RequestModel;

class RequestController extends BaseController
{
  public function create()
  {
    $logged_user_data = session()->get('logged_user');

    $request_obj = new RequestModel();
    $project_obj = new ProjectModel();

    $project = $project_obj->getProjectByCustomer($logged_user_data['id']);

    if ($this->request->getMethod() == 'get') {
      return view('Request/make-request', [
        'logged_user_data' => $logged_user_data,
        'project' => $project
      ]);
    }

    $request = [
      'title' => $this->request->getPost('title'),
      'description' => $this->request->getPost('description'),
      'status' => 0,
      'project_id' => $project['id'],
      'created_by' => $logged_user_data['id']
    ];

    if ($request_obj->createRequest($request)) {
      return redirect()->to('/customer-project');
    }

    return redirect()->to('/customer-project');
  }

  public function approve($id)
  {
    $request_obj = new RequestModel();

    $request = $request_obj->getRequestById($id);

    if ($request_obj->approveRequest($id)) {
      return redirect()->to('/employee-project/' . $request['project_id']);
    }

    return redirect()->to('/employee-project/' . $request['project_id']);
  }

  public function cancel($id)
  {
    $request_obj = new RequestModel();

    $request = $request_obj->getRequestById($id);

    if ($request_obj->cancelRequest($id)) {
      return redirect()->to('/employee-project/' . $request['project_id']);
    }

    return redirect()->to('/employee-project/' . $request['project_id']);
  }

  public function request($id)
  {
    $logged_user_data = session()->get('logged_user');

    $request_obj = new RequestModel();
    $message_obj = new MessageModel();
    $project_obj = new ProjectModel();

    $request = $request_obj->getRequestById($id);
    $messages = $message_obj->getMessagesOfRequest($id);
    $project = $project_obj->getProjectById($request['project_id']);

    $files = [];

    foreach ($messages as $message) {
      if ($message['attach'] != null) {
        $files['message' . $message['id']] = $message['attach'];
      }
    }

    return view('Request/request', [
      'request' => $request,
      'messages' => $messages,
      'project' => $project,
      'logged_user_data' => $logged_user_data,
      'files' => $files
    ]);
  }
}
