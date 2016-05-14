--iterator
SELECT
    cfile.id as fileid,
    cfile.title,
    cfile.artist,
    cfile.album,
    cfile.content_type,
    cfile.name,
    cfolder.path,
    cfolder.id as folderid,
    rating
FROM
    content_file as cfile
LEFT JOIN
    content_folder as cfolder
ON
    cfile.parent_id = cfolder.id
INNER JOIN
    rating_file as rfile
ON
    cfile.hash = rfile.hash
WHERE
    rating > 0
ORDER BY
    cfile.title,
    cfile.artist
