<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\RequestModel;

class RequestController extends BaseController
{
  public function makeRequest()
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
      'created_by' => $logged_user_data['name']
    ];

    if ($request_obj->makeRequest($request)) {
      return redirect()->to('/customer-project');
    }

    return redirect()->to('/customer-project');
  }

  public function request($id)
  {
    $request_obj = new RequestModel();
    $request = $request_obj->getRequestById($id);

    return view('Request/request', ['request' => $request]);
  }
}
