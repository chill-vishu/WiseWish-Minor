document.addEventListener('DOMContentLoaded', function() {
    fetchScholarships();
    fetchUsers();
    fetchContacts();
});


function fetchScholarships() {
    fetch('fetch_scholarships.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('scholarshipTableBody');
            tableBody.innerHTML = '';
            data.forEach(scholarship => {
                let row = `<tr>
                    <td>${scholarship.id}</td>
                    <td>${scholarship.applicant_name}</td>
                    <td>${scholarship.applicant_email}</td>
                    <td>${scholarship.institution}</td>
                    <td>${scholarship.gpa}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error:', error));
}


function fetchUsers() {
    fetch('fetch_users.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('userTableBody');
            tableBody.innerHTML = '';
            data.forEach(user => {
                let row = `<tr>
                    <td>${user.id}</td>
                    <td>${user.full_name}</td>
                    <td>${user.email}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error:', error));
}


function fetchContacts() {
    fetch('fetch_contacts.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('contactTableBody');
            tableBody.innerHTML = '';
            data.forEach(contact => {
                let row = `<tr>
                    <td>${contact.id}</td>
                    <td>${contact.name}</td>
                    <td>${contact.email}</td>
                    <td>${contact.message}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error:', error));
}
