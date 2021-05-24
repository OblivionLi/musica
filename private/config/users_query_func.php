<?php

// find result by email
function check_email_unique($email) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT * FROM users WHERE email = :email LIMIT 0, 1';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':email', $email);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt;
}

// find result by username
function read_user($username) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT * FROM users WHERE username = :username LIMIT 0, 1';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':username', $username);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// get all results
function get_all_users() {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, username, email, role, created_at, updated_at FROM users';

    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt;  
}

// find result by id
function find_by_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, username, email, role, created_at, updated_at FROM users WHERE id = :id LIMIT 0, 1';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':id', $id);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

?>