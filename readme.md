# php script to automatically export travelynx journeys to a mysql database 

the script can be run as a cronjob 

normally it should not produce a output 

## dependencies 
- php 8.1+ with enabled mysqli & curl extension  

## installation
1. rename `mysql_userdata_example.php` to `mysql_userdata.php` and fill the required fields
2. create a table using the `create_table.sql` or follow the structure given
3. export your cookies for [travelynx.de](https://travelynx.de) as a netscape cookies.txt file and place it in the same directory as `cronjob.php` 
4. either run `php cronjob.php` or add it to your crontab
> The script must be run in the directory where the `cookies.txt` is located so `cd` into it before running 
