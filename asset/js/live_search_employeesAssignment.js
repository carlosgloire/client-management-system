
document.getElementById('employeeSearch').addEventListener('input', function() {
    // Get the search query
    var searchQuery = this.value.toLowerCase();
    
    // Get all table rows in the tbody
    var tableRows = document.querySelectorAll('tbody tr');

    // Loop through each row and check for a match
    tableRows.forEach(function(row) {
        var employeeName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        var taskCount = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

        // Check if the search query matches the employee name or task count
        if (employeeName.includes(searchQuery) || taskCount.includes(searchQuery)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
});
