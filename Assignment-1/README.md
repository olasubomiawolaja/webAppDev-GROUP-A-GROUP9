# webAppDev-GROUP-A-GROUP9
Web application assignment for group A(Group 9)
Group A -> Group 9
1. EBAH OGHENEOGAGA | 23/0813 | Ogheneogaga (Github Username) Task-display.php
2. ITUA OSEIMUOHAN | 23/0800 | OseimuohanI(Github Username)|Task-filter.php
4. ATU OBINNA |Task-filter.php
5. ERHIRHIE-OROUWIGHO  OGHENEKEVWE | Task-filter.php
6. FAKOREDE OLADAPO |23/0755| Fakky2007(Github Username)| Task-connection.php
7. BANJO OLAMIDE| Task-process.php
8. AWOLAJA OLASUBOMI | 23/2020 | olasubomiawolaja(Github user name) | Task- feedback.html, feedback_portal.sql
9. AKINNIBOSUN OLUMIDE | Task-display.php

                CONTRIBUTION

AWOLAJA OLASUBOMI MICHEAL 23/2020| 
I added the feeback.html and  the internal styling for the feedback.html file. This file creates a page where user can input their name, email , rating, comments for the feedback portal. The feedback form is submited to the process.php file for processing. The code is written in a way that its compulsory for the user to fill all the input space on the page. Lets say for example if the user should skip the last name and try to submit a pop up messgage shows that its compulsory for the user fill that input field.
, also the user cant input any rating higher than 5 or lower than 1. There are two links in the page as well that leads to display.php and filter.php. The display.php wil show the all the feedbacks from the database while the filter.php link will sow a page where we can filter the feedbacks I also  stlyed the page using internal styling.
Also i added the file feedback_portal.sql file which shows how we created our database showing the name of tghe database the table name and the columns in the table.

ITUA OSEIMUOHAN 23/0800
I worked on index.php, index.php is a fix to the issue of the Apache Web server not finding the default file
I also worked on filter.php
Purpose:
Allows users to search and filter feedback records by keyword or rating, and view the average rating of filtered results.
Features:
Search Filter: Users can search feedback by first name, last name, email, or comments using a keyword input.
Rating Filter: Users can filter feedback by selecting a specific rating (1–5).
Average Rating Display: Dynamically calculates and displays the average rating of the filtered results.
Secure Output: All displayed data uses htmlspecialchars() to prevent HTML injection.

FAKOREDE OLADAPO 23/0755| 
I was given the task of handling the connection.php file. The file acts as a centralised database connection script, basically it allows other PHP files to easily connect to the database without rewriting connection code. This connection.php file also ensures error handling, so the application will not silently fail if the database is not accessible.
TLDR; it connects your application to your database so you can read/write data safely and efficiently. 
