document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('adminLoginForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        fetch('admin_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'username': username,
                'password': password
            })
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('Invalid')) {
                alert(data);
            } else {
                window.location.href = 'admin_dashboard.html';
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
