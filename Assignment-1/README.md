# webAppDev-GROUP-A-GROUP9
Web application assignment for group A(Group 9)
Group A -> Group 9
1. EBAH OGHENEOGAGA | Task-display.php
2. ITUA OSEIMUOHAN | Task-filter.php
4. ATU OBINNA |Task-filter.php
5. ERHIRHIE-OROUWIGHO  OGHENEKEVWE | Task-filter.php
6. FAKOREDE OLADAPO | Task-connection.php
7. BANJO OLAMIDE| Task-process.php
8. AWOLAJA OLASUBOMI | 23/2020 | olasubomiawolaja(Github user name) | Task- feedback.html, feedback_portal.sql
9. AKINNIBOSUN OLUMIDE | Task-display.php

                CONTRIBUTION

AWOLAJA OLASUBOMI MICHEAL 23/2020| 
I added the feeback.html and  the internal styling for the feedback.html file. This file creates a page where user can input their name, email , rating, comments for the feedback portal. The feedback form is submited to the process.php file for processing. The code is written in a way that its compulsory for the user to fill all the input space on the page. Lets say for example if the user should skip the last name and try to submit a pop up messgage shows that its compulsory for the user fill that input field.
, also the user cant input any rating higher than 5 or lower than 1. There are two links in the page as well that leads to display.php and filter.php. The display.php wil show the all the feedbacks from the database while the filter.php link will sow a page where we can filter the feedbacks I also  stlyed the page using internal styling.
Also i added the file feedback_portal.sql file which shows how we created our database showing the name of tghe database the table name and the columns in the table.
Olamide Banjo  Jadesola 23/1150
i worked on the process.php file in the customer feedback portal,it  is the server-side script responsible for receiving, validating, and storing the data submitted from the feedback form.
Post was recommended to ensures the form was submitted correctly.Prevents unauthorized  access to the processing code.
using trim() removes whitespace and using(int) safely casts rating to an integer.which would help in preventing malicious input and keeps the data clean.
bind_param securely binds each variable to the SQL query.If the insert is successful, show a thank-you alert and redirect to display.php. If there's an error, show the SQL error for debugging.
