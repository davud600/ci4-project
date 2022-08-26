<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;
use App\Models\ProjectModel;
use App\Models\RequestModel;

class RequestController extends BaseController
{
  public function __construct()
  {
    $this->request_obj = new RequestModel();
    $this->project_obj = new ProjectModel();
    $this->message_obj = new MessageModel();
  }

  public function create()
  {
    $logged_user_data = session()->get('logged_user');
    $project = $this->project_obj->getProjectByCustomer($logged_user_data['id']);

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

    if ($this->request_obj->createRequest($request)) {
      session()->setFlashdata('status', 'success');
      session()->setFlashdata('message', 'Successfully created request!');
      return redirect()->to('/customer-project/' . $project['id']);
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to create request!');
    return redirect()->to('/customer-project/' . $project['id']);
  }

  public function approve($id)
  {
    $logged_user_data = session()->get('logged_user');
    $request = $this->request_obj->getRequestById($id);

    if ($this->request_obj->approveRequest($id)) {
      session()->setFlashdata('status', 'success');
      session()->setFlashdata('message', 'Successfully approved request!');

      return $logged_user_data['role'] == 2 ?
        redirect()->to('/project/' . $request['project_id']) :
        redirect()->to('/employee-project/' . $request['project_id']);
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to approve request!');

    return $logged_user_data['role'] == 2 ?
      redirect()->to('/project/' . $request['project_id']) :
      redirect()->to('/employee-project/' . $request['project_id']);
  }

  public function cancel($id)
  {
    $logged_user_data = session()->get('logged_user');
    $request = $this->request_obj->getRequestById($id);

    if ($this->request_obj->cancelRequest($id)) {
      session()->setFlashdata('status', 'success');
      session()->setFlashdata('message', 'Successfully canceled request!');

      return $logged_user_data['role'] == 2 ?
        redirect()->to('/project/' . $request['project_id']) :
        redirect()->to('/employee-project/' . $request['project_id']);
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to cancel request!');

    return $logged_user_data['role'] == 2 ?
      redirect()->to('/project/' . $request['project_id']) :
      redirect()->to('/employee-project/' . $request['project_id']);
  }

  public function request($id)
  {
    $logged_user_data = session()->get('logged_user');
    $request = $this->request_obj->getRequestById($id);
    $messages = $this->message_obj->getMessagesOfRequest($id);
    $project = $this->project_obj->getProjectById($request['project_id']);

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
