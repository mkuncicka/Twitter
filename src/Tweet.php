<?php

class Tweet
{
    private $id;
    private $user_id;
    private $text;

    public function __construct($user_id = "", $text = "", $id = -1)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getTweet()
    {

    }

    public function create()
    {

    }

    public function save(mysqli $conn)
    {
        if (-1 === $this->id) {
            $query = "INSERT INTO tweets (user_id, content)"
                . "VALUES ('{$this->user_id}', '{$this->text}')";
            $result = $conn->query($query);

            if(true == $result) {
                $this->id = $conn->insert_id;

                return true;
            } else {
                return false;
            }
        } else {
            $query = "UPDATE tweets SET "
                . "content = {$this->text}"
                . "WHERE id={$this->id}";

            $result = $conn->query($query);

            return $result;
        }
    }

    public function show()
    {

    }

    public function getAllComments()
    {

    }

    public static function getUserTweets($conn, $user_id)
    {
        $query = "SELECT * FROM tweets WHERE user_id='$user_id'";

        $result = $conn->query($query);

        if (!$result) {
            die('Error: ' .$conn->error);
        }

        $tweets = [];

        foreach ($result as $tweet) {
            $tweetObj = new Tweet(
                $tweet['user_id'],
                $tweet['content'],
                $tweet['id']
            );

            $tweets[] = $tweetObj;
        }

        return $tweets;
    }
}