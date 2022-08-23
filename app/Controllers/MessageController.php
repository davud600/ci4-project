<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;

class MessageController extends BaseController
{
  public function create($request_id)
  {
    $message_obj = new MessageModel();

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
      'created_by' => session()->get('logged_user')['name']
    ];

    if ($message_obj->createMessage($message)) {
      return redirect()->to('/request/' . $request_id);
    }
  }

  public function downloadFile()
  {
    return $this->response->download($this->request->getGet('file_uri'), null);
  }
}
