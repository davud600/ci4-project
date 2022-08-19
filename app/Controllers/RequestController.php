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
    if ($this->request->getMethod() == 'get') {
      return view('Request/make-request');
    }

    $logged_user_data = session()->get('logged_user');
    $request_obj = new RequestModel();
    $project_obj = new ProjectModel();

    $project = $project_obj->getProjectByCustomer($logged_user_data['id']);

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

  public function request($id)
  {
    $logged_user_data = session()->get('logged_user');
    $request_obj = new RequestModel();
    $message_obj = new MessageModel();

    $request = $request_obj->getRequestById($id);
    $messages = $message_obj->getMessagesOfRequest($id);

    return view('Request/request', [
      'request' => $request,
      'messages' => $messages,
      'logged_user_data' => $logged_user_data
    ]);
  }
}
