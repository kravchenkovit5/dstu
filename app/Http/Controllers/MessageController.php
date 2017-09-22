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
        $userType = (isset($_COOKIE['usertype']) ? $_COOKIE['usertype'] : '');
        $user = (isset($_COOKIE['user']) ? $_COOKIE['user'] : '');
        $whereCondition = [];
        if ($userType == 'simple_user') {
            $whereCondition = ['recipient' => $user];
        }

        return $this->selectMessagesWithCondition($whereCondition);
    }

    public function selectNotReadMess($username)
    {
        if (!empty($username)) {
            $whereCondition = ['recipient' => $username, 'status' => 'notread'];
            $res = Message::select('id')->where($whereCondition)->get();
            $count = $res->count();
            return $count;
        }else{
            return 0;
        }

    }

    public function selectMessagesWithCondition($condition)
    {

        $res = Message::select('id', 'subject', 'sender', 'recipient', 'created_at', 'status', 'body')
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
