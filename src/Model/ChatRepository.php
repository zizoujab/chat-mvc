<?php

namespace Zizoujab\Model;


class ChatRepository extends Repository
{

    protected static $tableName = 'chat';

    public function saveChat(Chat $chat)
    {
        $db = self::getDbConnection();
        $sql = 'INSERT INTO ' . static::$tableName . '(sender,receiver,msg, created_at) values (:sender,:receiver,:msg, :created_at)';
        $stmt = $db->prepare($sql);
        $stmt->execute(['sender' => $chat->getSender()->getId(),
            'receiver' => $chat->getReceiver()->getId(),
            'msg' => $chat->getMsg(),
            'created_at' => $chat->getCreatedAt()
        ]);

        return $stmt->rowCount();
    }

    function hydrate($array)
    {
        //@todo improve this
        $userRepo = new UserRepository();

        $chat = new Chat();
        $chat->setId($array['id']);
        $chat->setMsg(isset($array['msg']) ? $array['msg'] : '');
        $chat->setCreatedAt(isset($array['created_at']) ? $array['created_at'] : '');
        $chat->setSender($userRepo->find($array['sender']));
        $chat->setReceiver($userRepo->find($array['receiver']));

        return $chat;
    }

    public function getConversations($currentUserId, $partnerId)
    {

        //@todo not too clean , needs improvement
        $db = self::getDbConnection();
        $query = 'SELECT * FROM ' . static::$tableName
            . ' WHERE ((sender=:current_usr AND receiver=:partner) OR (sender=:partner1 AND receiver=:current_usr1))';
        $params = ['current_usr' => $currentUserId,
            'partner' => $partnerId,
            'current_usr1' => $currentUserId,
            'partner1' => $partnerId
        ];

        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $result = [];
        while ($array = $stmt->fetch()) {
            $result[] = $this->hydrate($array);
        }


        return $result;

    }
}