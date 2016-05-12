--iterator
SELECT
    artist,
    COUNT(*) as cnt
FROM
    content_file
GROUP BY
    artist
ORDER BY
    artist