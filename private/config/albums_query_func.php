<?php

// find result by id
function find_album_by_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, name, edition, cover, created_at, updated_at FROM albums WHERE id = :id LIMIT 0, 1';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':id', $id);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// get all results
function get_all_albums() {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, name, edition, cover, created_at, updated_at FROM albums';

    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

