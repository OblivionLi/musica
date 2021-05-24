<?php 

// find result by id
function find_group_by_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, name, created_at, updated_at FROM groups WHERE id = :id LIMIT 0, 1';

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
function get_all_groups() {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT 
                    groups.id AS groups_id,
                    groups.name AS groups_name,
                    groups.created_at AS groups_created_at,
                    groups.updated_at AS groups_updated_at,
                    conductors.name AS conductors_name,

                    (SELECT COUNT(*) FROM artists
                        WHERE group_id = groups.id) AS artist
                FROM groups 
                    LEFT JOIN conductors
                        ON conductors.group_id = groups.id
                ORDER BY groups.id
            ';

    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

?>