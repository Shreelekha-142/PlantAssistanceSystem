<?php
// Function to display messages to an instructor
function displayMessagesToInstructor($messages) {
    foreach ($messages as $message) {
        echo "Sender ID: " . $message['sender_id'] . "<br>";
        echo "Message: " . $message['message_text'] . "<br>";
        echo "Timestamp: " . $message['timestamp'] . "<br>";
        echo "<hr>";
    }
}

// Usage example
displayMessagesToInstructor($instructorMessages);
?>
