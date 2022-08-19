<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;

class MessageController extends BaseController
{
  public function create($request_id)
  {
    $message_obj = new MessageModel();

    $message = [
      'text' => $this->request->getPost('message'),
      // 'attach' => $this->request->getPost(''),
      'request_id' => $request_id,
      'created_by' => session()->get('logged_user')['id']
    ];

    if ($message_obj->createMessage($message)) {
      return redirect()->to('/request/' . $request_id);
    }
  }
}
