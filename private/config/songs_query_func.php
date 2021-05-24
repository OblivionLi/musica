<?php

// find result by id
function find_song_by_id($id)
{
    // connect to database
    $db = db_connect();

    // create query
    $query = "SELECT s.*,
                    GROUP_CONCAT(DISTINCT g.name SEPARATOR ', ') genres
                FROM song_genre sg
                    INNER JOIN songs s ON s.id = sg.song_id
                    INNER JOIN genres g ON g.id = sg.genre_id
                WHERE s.id = :id

                GROUP BY s.id
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

// find result by id
function find_songs_by_album_id($id)
{
    // connect to database
    $db = db_connect();

    // create query
    $query = "SELECT s.*,
                    GROUP_CONCAT(DISTINCT g.name SEPARATOR ', ') genres
                FROM song_genre sg
                    INNER JOIN songs s ON s.id = sg.song_id
                    INNER JOIN genres g ON g.id = sg.genre_id
                WHERE s.album_id = :id

                GROUP BY s.id
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


// get all results
function get_all_songs()
{
    // connect to database
    $db = db_connect();

    // create query
    $query = "SELECT 
                    s.id AS songs_id,
                    s.name AS songs_name,
                    s.description AS songs_description,
                    s.song_length AS songs_song_length,
                    s.published_at AS songs_published_at,
                    s.created_at AS songs_created_at,
                    s.updated_at AS songs_updated_at,
                    a.name AS albums_name,
                    GROUP_CONCAT(DISTINCT g.name ORDER BY g.name ASC SEPARATOR ', ') AS genres
                FROM songs AS s
                    LEFT JOIN albums AS a
                        ON s.album_id = a.id
                    LEFT JOIN song_genre AS sg
                        ON s.id = sg.song_id
                    LEFT JOIN genres AS g
                        ON sg.genre_id = g.id
                GROUP BY s.name
            ";

    // prepare query
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt; 
}

// insert into many-to-many
function songs_sync_genres($genres, $song)
{
    // connect to database
    $db = db_connect();

    foreach ($genres as $genre) {

        // create query
        $query = 'INSERT INTO song_genre 
                        SET 
                            song_id = :song_id,
                            genre_id = :genre_id,
                            created_at = NOW()
                ';

        // prepare query
        $stmt = $db->prepare($query);

        // bind value to query
        $stmt->bindParam(':song_id', $song);
        $stmt->bindParam(':genre_id', $genre);

        // execute query
        $stmt->execute();
    }
    // return stmt
    return $stmt;
}

// delete result by id
function delete_songs_genres_records($song)
{
    // connect to database
    $db = db_connect();

    // create query
    $query = 'DELETE FROM song_genre WHERE song_id = :song_id';

    // prepare query
    $stmt = $db->prepare($query);

    // bind value to query
    $stmt->bindParam(':song_id', $song);

    // execute query
    $stmt->execute();

    // return stmt
    return $stmt;
}
