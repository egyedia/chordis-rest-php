--singleRowOrNull
SELECT
    cfile.id as fileid,
    cfolder.id as folderid,
    cfile.*,
    cfolder.path,
    rfile.rating
FROM
    content_file cfile
LEFT JOIN
    content_folder cfolder
ON
    cfile.parent_id = cfolder.id
LEFT JOIN
    rating_file as rfile
ON
    cfile.hash = rfile.hash
WHERE
    cfile.hash = {hash}