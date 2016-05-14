--iterator
SELECT
    cfile.id as fileid,
    cfile.title,
    cfile.artist,
    cfile.album,
    cfile.year,
    cfile.music,
    cfile.lyrics,
    cfile.content,
    cfile.content_type,
    cfile.name,
    cfolder.path,
    cfolder.id as folderid,
    cfile.hash,
    rfile.rating
FROM
    content_file as cfile
LEFT JOIN
    content_folder as cfolder
ON
    cfile.parent_id = cfolder.id
LEFT JOIN
    rating_file as rfile
ON
    cfile.hash = rfile.hash
WHERE
    cfile.hash in (#hash_list#)
ORDER BY
    cfile.name