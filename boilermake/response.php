<!-- Lock users from editing their polls after submitted once -->
<?php mysql_query("insert into Poll (Question, PollDate, latitude, longitude) values ('Question', now()," . $_SESSION['user_long'] . ", " . $_SESSION['user_lat'] . ");")
                        or die (mysql_error());


insert into Poll (Question, PollDate, latitude, longitude) values ('Question', now(), 1, 1);
insert into Response (PollID, Response, Count) values (16, 'Test me2', 1+1);