<?php

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = 'coderslab';
const DB_NAME = 'twitter';

require_once 'src/functions.php';

$conn = connectToDataBase();
redirectIfNotLoggedIn();
