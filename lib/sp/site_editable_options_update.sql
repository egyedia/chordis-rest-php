--update
UPDATE
    site_editable_options
SET
    option_value = {value}
WHERE
    option_name = {name}