# Q1
```sql
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
```

# Q2
1. 使用 EXPLAIN 語法，查看目前 SQL 中是否有正確使用 index
2. 如果表很大，可以使用 partition 分割資料表

# Q3
此專案使用了 SOLID 中的 S L I D 部分
設計模式使用的是 Dependency Injection 以及 Service Layer
