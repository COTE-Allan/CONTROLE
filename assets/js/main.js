$(document).ready(function() {
    setInterval(timestamp, 1000);
    
});

function timestamp() {
    $.ajax({
        url: 'http://localhost/td-SQL-PHP/budget_etudiant/site//usefulfunctions/timestamp.php',
        success: function(data) {
            $('#timestamp').html(data);
        },
    });
}

