SELECT SQL_NO_CACHE DISTINCT nomeR, ano, SUM(precoTotal) FROM Encomenda WHERE desconto=0 GROUP BY ano, nomeR;

create index Encomenda_idx on Encomenda(nomeR,ano);

mysql> show profiles;
+----------+------------+-------------------------------------------------------------------------------+
| Query_ID | Duration   | Query                                                                         |
+----------+------------+-------------------------------------------------------------------------------+
|        1 | 3.40734600 | SELECT SQL_NO_CACHE nomeR, ano, sum(precoTotal) from Encomenda group by nomeR |
|        2 | 0.26380800 | CREATE INDEX idx ON Encomenda(nomeR, ano)                                     |
|        3 | 0.00257900 | SELECT SQL_NO_CACHE nomeR, ano, sum(precoTotal) from Encomenda group by nomeR |
|        4 | 0.00184500 | SELECT nomeR, ano, sum(precoTotal) from Encomenda group by nomeR              |
+----------+------------+-------------------------------------------------------------------------------+
4 rows in set (0.00 sec)

mysql> show profile for query 1;
+----------------------+----------+
| Status               | Duration |
+----------------------+----------+
| starting             | 0.000113 |
| checking permissions | 0.000011 |
| Opening tables       | 3.404116 |
| System lock          | 0.000034 |
| Table lock           | 0.000012 |
| init                 | 0.000049 |
| optimizing           | 0.000009 |
| statistics           | 0.000014 |
| preparing            | 0.000041 |
| Creating tmp table   | 0.000067 |
| executing            | 0.000007 |
| Copying to tmp table | 0.002397 |
| Sorting result       | 0.000140 |
| Sending data         | 0.000109 |
| end                  | 0.000012 |
| removing tmp table   | 0.000068 |
| end                  | 0.000013 |
| query end            | 0.000011 |
| freeing items        | 0.000099 |
| logging slow query   | 0.000009 |
| cleaning up          | 0.000015 |
+----------------------+----------+
21 rows in set (0.00 sec)

mysql> show profile for query 3;
+----------------------+----------+
| Status               | Duration |
+----------------------+----------+
| starting             | 0.000129 |
| checking permissions | 0.000014 |
| Opening tables       | 0.000205 |
| System lock          | 0.000006 |
| Table lock           | 0.000013 |
| init                 | 0.000033 |
| optimizing           | 0.000008 |
| statistics           | 0.000032 |
| preparing            | 0.000023 |
| executing            | 0.000013 |
| Sorting result       | 0.000007 |
| Sending data         | 0.002004 |
| end                  | 0.000007 |
| query end            | 0.000005 |
| freeing items        | 0.000071 |
| logging slow query   | 0.000004 |
| cleaning up          | 0.000005 |
+----------------------+----------+
17 rows in set (0.00 sec)

mysql> show profile for query 4;
+--------------------------------+----------+
| Status                         | Duration |
+--------------------------------+----------+
| starting                       | 0.000027 |
| checking query cache for query | 0.000047 |
| checking permissions           | 0.000026 |
| Opening tables                 | 0.000016 |
| System lock                    | 0.000005 |
| Table lock                     | 0.000028 |
| init                           | 0.000021 |
| optimizing                     | 0.000006 |
| statistics                     | 0.000022 |
| preparing                      | 0.000017 |
| executing                      | 0.000012 |
| Sorting result                 | 0.000007 |
| Sending data                   | 0.001549 |
| end                            | 0.000006 |
| query end                      | 0.000004 |
| freeing items                  | 0.000030 |
| storing result in query cache  | 0.000013 |
| logging slow query             | 0.000003 |
| cleaning up                    | 0.000006 |
+--------------------------------+----------+
19 rows in set (0.00 sec)



