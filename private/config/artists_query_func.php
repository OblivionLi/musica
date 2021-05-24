<?php 

// find result by id
function find_artist_by_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT id, name, album_id, group_id, created_at, updated_at FROM artists WHERE id = :id LIMIT 0, 1';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':id', $id);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// find result by id
function find_artists_by_album_id($id) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT 
                    artists.*, 
                    groups.name AS groups_name,
                    conductors.name AS conductors_name
                FROM artists 
                    INNER JOIN groups 
                        ON artists.group_id = groups.id  
                    JOIN conductors 
                        ON conductors.group_id = groups.id  
                WHERE album_id = :id
        ';

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
function get_all_artists() {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT 
                    artists.id AS artists_id,
                    artists.name AS artists_name,
                    artists.created_at AS artists_created_at,
                    artists.updated_at AS artists_updated_at,
                    albums.id AS albums_id,
                    albums.name AS albums_name,
                    albums.cover AS albums_cover,
                    albums.edition AS albums_edition,
                    groups.name AS groups_name
                FROM artists 
                    INNER JOIN albums 
                        ON artists.album_id = albums.id
                    INNER JOIN groups 
                        ON artists.group_id = groups.id

                ORDER BY artists.id
            ';

    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// get all results by keyword
function get_all_artists_by_search($search) {
    // connect to database
    $db = db_connect();

    // create keyword var
    $keyword = "%$search%";

    // create query
    $query = "SELECT 
                    artists.id AS artists_id,
                    artists.name AS artists_name,
                    artists.created_at AS artists_created_at,
                    artists.updated_at AS artists_updated_at,
                    albums.id AS albums_id,
                    albums.name AS albums_name,
                    albums.cover AS albums_cover,
                    albums.edition AS albums_edition,
                    groups.name AS groups_name
                FROM artists 
                    INNER JOIN albums 
                        ON artists.album_id = albums.id
                    INNER JOIN groups 
                        ON artists.group_id = groups.id

                WHERE artists.name LIKE ?
                    OR albums.name LIKE ?
                    OR groups.name LIKE ?

                GROUP BY artists.id
            ";

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindValue(1, "%$keyword%");
    $stmt->bindValue(2, "%$keyword%");
    $stmt->bindValue(3, "%$keyword%");

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 

}

// get all results by limit
function get_all_artists_with_pagination($start, $per_page) {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT 
                    artists.id AS artists_id,
                    artists.name AS artists_name,
                    artists.created_at AS artists_created_at,
                    artists.updated_at AS artists_updated_at,
                    albums.id AS albums_id,
                    albums.name AS albums_name,
                    albums.cover AS albums_cover,
                    albums.edition AS albums_edition,
                    groups.name AS groups_name
                FROM artists 
                    INNER JOIN albums 
                        ON artists.album_id = albums.id
                    INNER JOIN groups 
                        ON artists.group_id = groups.id

                LIMIT :start, :per_page
            ';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':per_page', $per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// count all results
function count_artists() {
    // connect to database
    $db = db_connect();

    // create query
    $query = 'SELECT * FROM artists ';

    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt;  
}
