var socket = new WebSocket("ws://" + window.location.hostname + ":8000");

// When a message is received
socket.onmessage = function(event) {
    // Append the message to the chat log
    var chatLog = document.getElementById("chatLog");
    var message = document.createElement("div");
    message.innerHTML = event.data;
    chatLog.appendChild(message);
};

// When the form is submitted
document.getElementById("chatForm").addEventListener("submit", function(event) {
    event.preventDefault();

    // Send the message through the WebSocket connection
    socket.send(document.getElementById("message").value);

    // Clear the input field
    document.getElementById("message").value = "";
});