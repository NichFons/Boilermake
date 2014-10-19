<?php
 
    // start the session
    session_start();
    $sessionid = session_id();
    include('connection.php');
 
    // output the counter response
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Sms><?php 
            $response = explode(" ", $_POST['Body']);
            if (strcasecmp($response[0], 'stroll') == 0) {
                $pollnum = replace_null($response[1], '0');
                $_SESSION['pollnum'] = $pollnum;
                $query = mysql_query("SELECT * FROM Poll where PollID not in (select PollID from User_Response where sessionid = '$sessionid') and Poll.PollID = $pollnum limit 1")
                        or die (mysql_error());
                if (!mysql_num_rows($query)) { 
                    echo "No stroll found at $pollnum";
                }
                while($result = mysql_fetch_array($query)){
                    echo "Q: " .$result['Question'] . "\n";
                    $answerq = 'SELECT * FROM Response where PollID = ' . $result['PollID'] . ' order by Number';
                    $answer = mysql_query($answerq)
                        or die (mysql_error());
                    while ($row = mysql_fetch_array($answer))
                    {   
                        echo $row['Number'] . ": " . $row['Response'] . "\n"; 
                    }
                    echo 'To vote, press number corresponding to response.';
                }
            }
            else if(strcasecmp($response[0], 'view') == 0){
                $pollid = replace_null($response[1], '0');
                $query = mysql_query("SELECT * FROM Poll where Poll.PollID = $pollid limit 1")
                        or die (mysql_error());
                if (!mysql_num_rows($query)) { 
                    echo "No stroll found at $pollid";
                }
                while($result = mysql_fetch_array($query)){
                    echo "Q: " .$result['Question'] . "\n";
                    $answerq = 'SELECT * FROM Response where PollID = ' . $result['PollID'] . ' order by Number';
                    $answer = mysql_query($answerq)
                        or die (mysql_error());
                    while ($row = mysql_fetch_array($answer))
                    {   
                        echo "R" . $row['Number'] . ": " . $row['Response'] . "\n";
                        echo "Votes: " . $row['Count'] . "\n";
                    }
                }
            }
            else if($_SESSION['pollnum'] == null){
                echo 'Please select a stroll by responding "stroll #"';
            }
            else {
                $vote = replace_null($response[0], '0');
                if($vote == '0' || $vote == '1' || $vote == '2' || $vote == '3' ){
                    $pollid = $_SESSION['pollnum'];
                    mysql_query("UPDATE Response SET count = count + 1 WHERE Number = '$vote' and PollID = $pollid")
                            or die (mysql_error());
                    mysql_query("insert into User_Response (pollid, sessionid) values ($pollid , '$sessionid')")
                                            or die (mysql_error());
                    echo "Vote counted! \n";
                    $query = mysql_query("SELECT * FROM Poll where Poll.PollID = $pollid limit 1")
                            or die (mysql_error());
                    if (!mysql_num_rows($query)) { 
                        echo "No stroll found at $pollid";
                    }
                    while($result = mysql_fetch_array($query)){
                        echo "Q: " .$result['Question'] . "\n";
                        $answerq = 'SELECT * FROM Response where PollID = ' . $result['PollID'] . ' order by Number';
                        $answer = mysql_query($answerq)
                            or die (mysql_error());
                        while ($row = mysql_fetch_array($answer))
                        {   
                            echo "R" . $row['Number'] . ": " . $row['Response'] . "\n";
                            echo "Votes: " . $row['Count'] . "\n";
                        }
                    }
                    $_SESSION['pollnum'] = null;
                }
                else {
                    echo 'Please input a valid number';
                }
            }
        ?></Sms>
</Response>