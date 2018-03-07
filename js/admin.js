function fill() {
    $('#CustomersTable').append('<tr><td class="collapsing"><div class="ui fitted slider checkbox"><input type="checkbox"> <label></label></div></td><td>John Lilki</td><td>September 14, 2013</td><td>jhlilk22@yahoo.com</td><td>No</td><td>1234</td></tr>');
}

function getCustomers(){
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: {"action":"GetCustomers"},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            alert(data)
        }
    })
}