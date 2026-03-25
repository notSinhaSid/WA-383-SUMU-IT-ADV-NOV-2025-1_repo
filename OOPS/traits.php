<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

trait VoiceMail {
    public function messageLogging ($number) {
        echo "You have recieved a new Voice mail from $number";
    }
}

trait PushMail {
    public function messageLogging($number) {
        echo "You have recieved a new push mail from $number";
    }
}

trait Email {
    public function messageLogging($number) {
        echo "You will recieve a message on this $number number";
    }
}

class LogNotification {
    use VoiceMail, PushMail, Email {
        Email::messageLogging insteadof VoiceMail, PushMail;
        PushMail::messageLogging as PushMail;
        VoiceMail::messageLogging as phoneMessageLogger;
    }
}

$requestMessage = new LogNotification();
$requestMessage->messageLogging(9899644528);
echo "<br>";
$requestMessage->phoneMessageLogger(9654324520);
echo "<br>";
$requestMessage->PushMail(9818231998);
// $requestMessage->EmailMessage(9818231998);