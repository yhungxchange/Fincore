<?php

class Notification
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($userId, $title, $message, $type = "general")
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO notifications
            (
                user_id,
                title,
                message,
                type
            )
            VALUES
            (
                :user_id,
                :title,
                :message,
                :type
            )
        ");

        $stmt->execute([

            "user_id" => $userId,

            "title" => $title,

            "message" => $message,

            "type" => $type

        ]);
    }
}
