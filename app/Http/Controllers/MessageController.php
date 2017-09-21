<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageController extends Controller
{
    public function selectAllMess()
    {
        return $this->selectMessagesWithCondition('');
    }
    public function selectUserMess()
    {
        $userType = ( isset($_COOKIE['usertype']) ? $_COOKIE['usertype'] : '' );
        $user = ( isset($_COOKIE['user']) ? $_COOKIE['user'] : '' );
        $whereCondition = [];
        if ($userType == 'simple_user'){
            $whereCondition = ['recipient' => $user];
        }

        return $this->selectMessagesWithCondition($whereCondition);
    }

    public function selectNotReadMess()
    {
        $user = ( isset($_COOKIE['user']) ? $_COOKIE['user'] : '' );
        $whereCondition = ['recipient' => $user, 'status' => 'notread'];
        $notReadMess = json_decode($this->selectMessagesWithCondition($whereCondition));
        $count = count($notReadMess->data);
        return $count;
    }

    public function selectMessagesWithCondition($condition)
    {

        $res = Message::select('id', 'subject', 'sender', 'created_at', 'status', 'body')
            ->where($condition)
            ->get()
            ->toArray();

        $fech['data'] = $res;

        return json_encode($fech);
    }

    public function setStatusMess($num)
    {
      $mess = Message::find($num);
      $mess->status = "read";
      $mess->save();
    }
}
