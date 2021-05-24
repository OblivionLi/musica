<?php 

// gaseste conductor dupa id
function find_conductor_by_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, name, group_id, created_at, updated_at FROM conductors WHERE id = :id LIMIT 0, 1';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':id', $id);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// find all results by group_id
function find_conductor_by_group_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT * FROM conductors WHERE group_id = :id LIMIT 0, 1';

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
function get_all_conductors() {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT 
                    conductors.id AS conductors_id,
                    conductors.name AS conductors_name,
                    conductors.created_at AS conductors_created_at,
                    conductors.updated_at AS conductors_updated_at,
                    groups.name AS groups_name
                FROM conductors 
                    INNER JOIN groups 
                        ON conductors.group_id = groups.id'
            ;

    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}
