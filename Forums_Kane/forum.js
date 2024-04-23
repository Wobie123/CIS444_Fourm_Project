document.addEventListener("DOMContentLoaded", function() {
    // Ajax request
    var xhr = new XMLHttpRequest();
    // specify request details (method: GET or POST, url, async: true or false, user, psw)
    xhr.open("GET", "getForumName.php", true);
    // defines a function to be called when readyState changes
    xhr.onreadystatechange = function() {
        // readyState holds the status of XMLHttpRequest
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // success: insert into dom
                document.getElementById('forum-name').innerHTML = xhr.responseText;
                // ...innerHTML += "<p>...</p>;" works as well
            } else {
                // error handling
                console.error("Error:", xhr.status, xhr.statusText);
            }
        }
    };
    xhr.send(); //send request
})