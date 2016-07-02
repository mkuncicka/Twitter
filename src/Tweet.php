<?php

class Tweet
{
    private $id;
    private $user_id;
    private $text;

    public function __construct($id = -1, $user_id = "", $text = "")
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

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function loadFromDB()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function show()
    {

    }

    public function getAllComments()
    {

    }

    public function loadAllTweets()
    {
        
    }
}