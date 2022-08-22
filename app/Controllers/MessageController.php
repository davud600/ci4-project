<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;
use CodeIgniter\Files\File;

class MessageController extends BaseController
{
  public function create($request_id)
  {
    $message_obj = new MessageModel();

    $user_file = $this->request->getFile('userfile');
    $file_path = null;

    if (!$user_file->hasMoved()) {
      $file_path = WRITEPATH . 'uploads/' . $user_file->store();
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
    return $this->response->download($_GET['file_uri'], null);
  }
}
