--iterator
SELECT
    *
FROM
    site_options
WHERE
    autoload = {autoload}
    UNION
SELECT
    *
FROM
    site_editable_options
WHERE
    autoload = {autoload}
