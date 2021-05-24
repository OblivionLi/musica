<?php 

// find result by id
function find_genre_by_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, name, created_at, updated_at FROM genres WHERE id = :id LIMIT 0, 1';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':id', $id);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// find all results
function get_all_genres() {
    // connect to database
    $db = db_connect();

    // create query
    $query = "SELECT * FROM genres";
    
    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// find all results by id
function get_all_genres_edit($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = "SELECT 
                    g.*,
                    group_concat(DISTINCT s.name ORDER BY s.name WHERE id = :id DESC SEPARATOR ', ') AS songs
                FROM genres g

                JOIN song_genre sg
                    ON g.id = sg.genre_id
                JOIN songs s
                    ON sg.song_id = s.id
                GROUP BY g.id, g.name
    ";
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