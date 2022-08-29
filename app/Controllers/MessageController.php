<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;

class MessageController extends BaseController
{
  public function __construct()
  {
    $this->message_obj = new MessageModel();
  }

  public function create($request_id)
  {
    $user_file = $this->request->getFile('userfile');

    $file_path = null;
    if (is_uploaded_file($user_file)) {
      if (!$user_file->hasMoved()) {
        $file_path = WRITEPATH . 'uploads/' . $user_file->store();
      }
    }

    $message = [
      'text' => $this->request->getPost('message'),
      'attach' => $file_path,
      'request_id' => $request_id,
      'created_by' => session()->get('logged_user')['id']
    ];

    if ($this->message_obj->insert($message)) {
      return redirect()->to('/request/' . $request_id);
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Message was not sent!');
    return redirect()->to('/request/' . $request_id);
  }

  public function downloadFile()
  {
    return $this->response->download($this->request->getGet('file_uri'), null);
  }
}
