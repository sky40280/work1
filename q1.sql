SELECT
    bnbs.id AS bnb_id,
    bnbs.name AS bnb_name,
    SUM(orders.amount) AS may_amount
FROM
    bnbs
        INNER JOIN
    orders
    ON
        orders.bnb_id = bnbs.id
            AND orders.currency = 'TWD'
            AND orders.created_at BETWEEN '2023-05-01' AND '2023-05-31'
GROUP BY
    bnbs.id, bnbs.name
ORDER BY
    may_amount DESC
    LIMIT 10;
