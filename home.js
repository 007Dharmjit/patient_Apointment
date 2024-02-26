document.getElementById('BTN').addEventListener('click',()=>{
    window.location.href = "Login.php";
    // window.history.pushState(null, null, window.location.href);
    // window.history.replaceState(null, null, window.location.href);
    setTimeout(function() {
        window.history.go(1); // Move forward in history by one step
    }, 0);
})
