first i was declare a variables have a information of databse (database name  , host and password also  username )

secondely i was use classification try() and catch() because if you try to make a connection with your  database   some times have errors and we can catch it by classification catch()


in classification try()  i try to make a connection with my database :
1_ declare a varailble its name is pdo this variable has a connection with the databse by use new PDO()
2_ make some preveliges in my connection : if has a error just throw it to ecxeption
3_ print in the page "connection is succese with database store_db" to verify if the connection is work

in classificaiton catch if has a eroor in connection just print type of the connection in the page.