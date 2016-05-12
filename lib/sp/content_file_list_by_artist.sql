--iterator
SELECT
    cfile.id as fileid,
    cfile.title,
    cfile.artist,
    cfile.album,
    cfile.name,
    cfile.content_type,
    cfolder.id as folderid,
    cfolder.path
FROM
    content_file cfile
LEFT JOIN
    content_folder cfolder
ON
    cfile.parent_id = cfolder.id
WHERE
    cfile.artist LIKE "%#artist#%"
ORDER BY
    cfile.artist, cfile.title, cfile.name
