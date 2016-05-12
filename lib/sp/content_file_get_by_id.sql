--singleRowOrNull
SELECT
    cfile.id as fileid,
    cfolder.id as folderid,
    cfile.*,
    cfolder.path
FROM
    content_file cfile
LEFT JOIN
    content_folder cfolder
ON
    cfile.parent_id = cfolder.id
WHERE
    cfile.id = {id}