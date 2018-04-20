var customers = []
var employees = []
var companies = []
var accounts = []
var orders = []
var supplies = []
var reviews = []
//  ******************************************** CUSTOMER SECTION ******************************************** 
function addOrder() {
    var array = $('.customer.form').serializeArray();
    var supplyList = $('#supplySelect').val();
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "addCustomer", "data": array },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            getOrders();
        }
    })
    $('.customer.form').trigger("reset");
}

function getCustomers(){
    $('#customerButton').addClass("disabled");
    $('#deleteAllCustomers').removeClass("disabled");
    $('#deleteCustomers').addClass("disabled");
    customers = [];
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: {"action":"getCustomers"},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for(i=0; i < data.length; i++){
                $('#CustomersTable').append('<tr><td class="collapsing"><div class="ui fitted slider customer checkbox"><input id="' + data[i]['Username'] + '" type="checkbox"><label></label></div></td><td>' + data[i]['Name'] + '</td><td>' + data[i]['Username'] + '</td><td>' + data[i]['Email'] + '</td><td>' + data[i]['CompanyId'] + '</td><td>' + data[i]['CustomerId'] + '</td><td><button id="' + data[i]['CustomerId'] + '"onclick="showCustomerReviews(this.id)" class="ui right small primary button">View</button></td></tr>');
            }
            $('.customer.checkbox')
                .checkbox({
                    onChange: function () {
                        $('#deleteCustomers').removeClass("disabled");
                        username = $(this).attr("id");
                        if ($.inArray(username, customers) == -1){
                            customers.push(username);
                        }
                        else{
                            var index = customers.indexOf(username);
                            customers.splice(index, 1);
                            if(customers.length == 0){
                                $('#deleteCustomers').addClass("disabled");
                            }
                        }
                    }
                });
        }
    })
}

function deleteCustomers(){
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteCustomers", "customers" : customers},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#CustomersTable').empty();
            getCustomers();
        }
    })
}

function deleteAllCustomers(){
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAllCustomers" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#CustomersTable').empty();
            $('#customerButton').removeClass("disabled");
        }
    })
}

function addCustomer(){
    $('.special.modal.customer')
        .modal({
            centered: false
        })
        .modal('show')
        ;
}

function showCustomerReviews(customerId){
    $('.special.modal.customerReview')
        .modal({
            centered: false
        })
        .modal('show')
        ;
        getCustomerReview(customerId)
}

function getCustomerReview(customerId){
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getCustomerReviews", "customerId": customerId},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#customerReviewsTable').append('<tr><td>' + data[i]['ReviewId'] + '</td><td>' + data[i]['CustomerId'] + '</td><td>' + data[i]['SupplyId'] + '</td><td>' + data[i]['Rating'] + '</td><td>'+ data[i]['Text'] + '</td><td>' + data[i]['Date'] + '</td></tr>');
            }
        }
    })
}

// ********************************************  EMPLOYEE SECTION ******************************************** 
function getEmployees() {
    $('#employeeButton').addClass("disabled");
    $('#deleteAllEmployees').removeClass("disabled");
    $('#deleteEmployees').addClass("disabled");
    customers = [];
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getEmployees" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#EmployeesTable').append('<tr><td class="collapsing"><div class="ui fitted slider employee checkbox"><input id="' + data[i]['Username'] + '" type="checkbox"><label></label></div></td><td>' + data[i]['Name'] + '</td><td>' + data[i]['Username'] + '</td><td>' + data[i]['Email'] + '</td><td>' + data[i]['BranchId'] + '</td><td>' + data[i]['Admin'] + '</td></tr>');
            }
            $('.employee.checkbox')
                .checkbox({
                    onChange: function () {
                        $('#deleteEmployees').removeClass("disabled");
                        username = $(this).attr("id");
                        if ($.inArray(username, employees) == -1) {
                            employees.push(username);
                        }
                        else {
                            var index = employees.indexOf(username);
                            employees.splice(index, 1);
                            if (employees.length == 0) {
                                $('#deleteEmployees').addClass("disabled");
                            }
                        }
                    }
                });
        }
    })
}

function deleteEmployees() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteEmployees", "employees": employees },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#EmployeesTable').empty();
            getEmployees();
        }
    })
}

function deleteAllEmployees() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAllEmployees" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#EmployeesTable').empty();
            $('#employeeButton').removeClass("disabled");
        }
    })
}

function addEmployee() {
    $('.special.modal.employee')
        .modal({
            centered: false
        })
        .modal('show')
        ;
}

//  ******************************************** COMPANY SECTION ******************************************** 
function getCompanies() {
    $('#companyButton').addClass("disabled");
    $('#deleteAllCompanies').removeClass("disabled");
    $('#deleteCompanies').addClass("disabled");
    customers = [];
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getCompanies" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#CompaniesTable').append('<tr id="main' + data[i]['CompanyId']+'"><td class="collapsing"><div class="ui fitted slider company checkbox"><input id="' + data[i]['CompanyId'] + '" type="checkbox"><label></label></div></td><td>' + data[i]['Name'] + '</td><td>' + data[i]['MailingAddress'] + '</td><td>' + data[i]['CompanyId'] + '</td>><td><button id="' + data[i]['CompanyId'] + '"onclick="getAccounts(this.id)" class="ui right small primary button">See Info</button></td></tr>');
            }
            $('.company.checkbox')
                .checkbox({
                    onChange: function () {
                        $('#deleteCompanies').removeClass("disabled");
                        username = $(this).attr("id");
                        if ($.inArray(username, companies) == -1) {
                            companies.push(username);
                        }
                        else {
                            var index = companies.indexOf(username);
                            companies.splice(index, 1);
                            if (companies.length == 0) {
                                $('#deleteCompanies').addClass("disabled");
                            }
                        }
                    }
                });
        }
    })
}

function deleteCompanies() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteCompanies", "companies": companies },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#CompaniesTable').empty();
            getCompanies();
        }
    })
}

function deleteAllCompanies() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAllCompanies" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#CompaniesTable').empty();
            $('#companyButton').removeClass("disabled");
        }
    })
}
function showCompany() {
    $('.special.modal.company')
        .modal({
            centered: false
        })
        .modal('show')
        ;
}

function addCompany() {
    var array = $('.company.form').serializeArray();
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "addCompany", "data": array },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#CompaniesTable').empty();
            getCompanies();
        }
    })
}

function getAccounts(companyId) {
    $('.special.modal.account')
        .modal({
            centered: false,
            onHidden: function () {
                $('#BankAccountTable').empty();
                $('#CardAccountTable').empty();
            },
        })
        .modal('show');
    $('#deleteAllAccounts').removeClass('disabled')
    $('#BankAccountTable').empty();
    $('#CardAccountTable').empty();
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getBankAccounts" , "companyId": companyId},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#BankAccountTable').append('<tr><td class="collapsing"><div class="ui fitted slider account checkbox"><input id="bank,' + data[i]['AccountId'] + "," + data[i]['AccountNumber'] + '" type="checkbox"><label></label></div></td><td>Bank Account</td><td>' + data[i]['AccountNumber'] + '</td><td>' + data[i]['RoutingNumber'] + '</td><td>' + data[i]['TypeOfAccount'] + '</td></tr>')
            }
            activate();
            accountIdFill(companyId);
        }
    })
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getCardAccounts", "companyId": companyId },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#CardAccountTable').append('<tr><td class="collapsing"><div class="ui fitted slider account checkbox"><input id="card,' + data[i]['AccountId']+ "," + data[i]['CardNumber'] + '" type="checkbox"><label></label></div></td><td>Card</td><td>' + data[i]['CardNumber'] + '</td><td>' + data[i]['CVV'] + '</td><td>' + data[i]['BillingAddress'] + '</td><td>' + data[i]['CardName'] + '</td></tr>')            
                $('.cardAccount.form').append('<div class="field" style="display:none"><input name="accountId" value="' + data[i]['AccountId'] + '"></div>')
            }
            if (data.length >= 1){
                $('#deleteAllAccounts').attr("id", data[0]['AccountId'])
                $('#' + data[0]['AccountId']).removeClass('disabled')
            }
            activate();
        }
    })
}

function accountIdFill(companyId){
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getAccountId", "companyId": companyId },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('.cardAccount.form').append('<div class="field" style="display:none"><input name="accountId" value="' + data + '"></div>')
            $('.bank.form').append('<div class="field" style="display:none"><input name="accountId" value="' + data + '"></div>')
        }
    })
}

function activate(){
    $('.account.checkbox')
        .checkbox({
            onChange: function () {
                $('#deleteAccounts').removeClass("disabled");

                username = $(this).attr("id");
                if ($.inArray(username, accounts) == -1) {
                    accounts.push(username);
                }
                else {
                    var index = accounts.indexOf(username);
                    accounts.splice(index, 1);
                    if (accounts.length == 0) {
                        $('#deleteAccounts').addClass("disabled");
                    }
                }
            }
        });
}

function deleteAccounts() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAccounts", "accounts": accounts },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#BankAccountTable').empty();
            $('#CardAccountTable').empty();
            getAccounts(data);
        }
    })
}

function deleteAllAccounts(accountId) {
    alert(accountId)
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAllAccounts", "accountId": accountId },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#BankAccountTable').empty();
            $('#CardAccountTable').empty();
        }
    })
}

function showBank(){
    $('#addCardAccount').addClass("disabled");
    $('.bank.form').removeClass("hidden");
    $('#accountConfirm').removeClass("hidden");
    $('#accountCancel').removeClass("hidden");
}

function showCard() {
    $('#addBankAccount').addClass("disabled");
    $('.cardAccount.form').removeClass("hidden");
    $('#accountConfirm').removeClass("hidden");
    $('#accountCancel').removeClass("hidden");
}

function addAccount(){
    if ($('#addCardAccount').hasClass("disabled")){
        var array = $('.bank.form').serializeArray();
    }
    else {
        var array = $('.cardAccount.form').serializeArray();
    }
    if (array[0]['value'] == "bank"){
        var accountId = array[4]['value']
        $.ajax({
            type: "POST",
            url: "../admin/admin.php",
            data: { "action": "addBankAccount", "accountId": accountId, "data" : array},
            error: function () {
                alert("Failed to get Elements")
            },
            success: function (data) {
                closeNewAccount()
                getAccounts(data);
            }
        })
    }
    else{
        var accountId = array[5]['value']
        $.ajax({
            type: "POST",
            url: "../admin/admin.php",
            data: { "action": "addCardAccount", "accountId": accountId, "data": array},
            error: function () {
                alert("Failed to get Elements")
            },
            success: function (data) {
                closeNewAccount()
                $('#addCardAccount').removeClass("disabled");
                $('#addBankAccount').removeClass("disabled");
                getAccounts(data);
            }
        })
    }
    closeNewAccount()
}

function closeNewAccount(){
    $('#addCardAccount').removeClass("disabled");
    $('#addBankAccount').removeClass("disabled");
    $('.bank.form').addClass("hidden");
    $('.cardAccount.form').addClass("hidden");
    $('#accountConfirm').addClass("hidden");
    $('#accountCancel').addClass("hidden");
    $('.bank.form').trigger("reset");
    $('.cardAccount.form').trigger("reset");

}

// ******************************************** ORDER SECTION ***************************************************

function getOrders() {
    $('#OrdersTable').empty();
    $('#orderButton').addClass("disabled");
    $('#deleteAllOrders').removeClass("disabled");
    $('#deleteOrders').addClass("disabled");
    orders = [];
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getOrders" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#OrdersTable').append('<tr><td class="collapsing"><div class="ui fitted slider order checkbox"><input id="' + data[i]['OrderId'] + '" type="checkbox"><label></label></div></td><td>' + data[i]['OrderId'] + '</td><td>' + data[i]['CompanyId'] + '</td><td>' + data[i]['AccountId'] + '</td><td><button id="' + data[i]['OrderId'] + '"onclick="listSupplies(this.id)" class="ui right small primary button">View</button></td><td>' + data[i]['CustomerId'] + '</td><td>' + data[i]['Shipped'] + '</td></tr>');
            }
            $('.order.checkbox')
                .checkbox({
                    onChange: function () {
                        $('#deleteOrders').removeClass("disabled");
                        username = $(this).attr("id");
                        if ($.inArray(username, orders) == -1) {
                            orders.push(username);
                        }
                        else {
                            var index = orders.indexOf(username);
                            orders.splice(index, 1);
                            if (orders.length == 0) {
                                $('#deleteOrders').addClass("disabled");
                            }
                        }
                    }
                });
        }
    })
}

function deleteOrders() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteOrders", "orders": orders },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#OrdersTable').empty();
            getOrders();
        }
    })
}

function deleteAllOrders() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAllOrders" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#OrdersTable').empty();
            $('#deleteAllOrders').addClass("disabled");
            $('#orderButton').removeClass("disabled");
        }
    })
}

function showOrder() {
    $('.special.modal.order')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    $('select.dropdown')
        .dropdown();
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getSupplies" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#supplySelect').append('<option value="' + data[i]['SupplyId'] + '">' + data[i]['Name'] + '</option>')
            }
        }
    })
    
}

function addOrder() {
    var array = $('.order.form').serializeArray();
    console.log(array)
    var supplyList = $('#supplySelect').val();
    console.log(supplyList)
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "addOrder", "data": array, "supplyList": supplyList },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            getOrders();
        }
    })
    $('.order.form').trigger("reset");
    $('.dropdown').dropdown('clear');
}

function listSupplies(orderId) {
    $('.special.modal.orderSupplies')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getOrderSupplies", "orderId":orderId },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#stickyQuipsOrderSupply').addClass("hidden")
            $('#officeSuppliesOrderSupply').addClass("hidden")
            $('#printersOrderSupply').addClass("hidden")
            $('#printTonerOrderSupply').addClass("hidden")
            $('#paperOrderSupply').addClass("hidden")
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                value = i
                if (data[i] == null){
                    continue
                }
                object = JSON.parse(data[i])
                keys = Object.keys(object)
                for (j = 0; j < keys.length; j++) {
                    key = keys[j]
                    if (value == 0) {
                        $('#paperOrderSupply').removeClass("hidden")
                        $('#paperOrderSupplyHeaderTable').append('<th>' + key + '</th>');
                        $('#paperOrderSupplyInfoTable').append('<th>' + object[key] + '</th>');
                    }
                    else if (value == 1) {
                        $('#printTonerOrderSupply').removeClass("hidden")
                        $('#printTonerOrderSupplyHeaderTable').append('<th>' + key + '</th>');
                        $('#printTonerOrderSupplyInfoTable').append('<th>' + object[key] + '</th>');
                    }
                    else if (value == 2) {
                        $('#printersOrderSupply').removeClass("hidden")
                        $('#printersOrderSupplyHeaderTable').append('<th>' + key + '</th>');
                        $('#printersOrderSupplyInfoTable').append('<th>' + object[key] + '</th>');
                    }
                    else if (value == 3) {
                        $('#stickyQuipsOrderSupply').removeClass("hidden")
                        $('#stickyQuipsOrderSupplyHeaderTable').append('<th>' + key + '</th>');
                        $('#stickyQuipsOrderSupplyInfoTable').append('<th>' + object[key] + '</th>');
                    }
                    else if (value == 4) {
                        $('#officeSuppliesOrderSupply').removeClass("hidden")
                        $('#officeSuppliesOrderSupplyHeaderTable').append('<th>' + key + '</th>');
                        $('#officeSuppliesOrderSupplyInfoTable').append('<th>' + object[key] + '</th>');
                    }
                }
            }
        }
    })
}

function closeSupplyOrder() {
    $('#stickyQuipsOrderSupply').addClass("hidden")
    $('#officeSuppliesOrderSupply').addClass("hidden")
    $('#printersOrderSupply').addClass("hidden")
    $('#printTonerOrderSupply').addClass("hidden")
    $('#paperOrderSupply').addClass("hidden")

    $('#paperOrderSupplyHeaderTable').empty();
    $('#paperOrderSupplyInfoTable').empty();
    $('#printTonerOrderSupplyHeaderTable').empty();
    $('#printTonerOrderSupplyInfoTable').empty();
    $('#printersOrderSupplyHeaderTable').empty();
    $('#printersOrderSupplyInfoTable').empty();
    $('#officeSuppliesOrderSupplyHeaderTable').empty();
    $('#officeSuppliesOrderSupplyInfoTable').empty();
    $('#stickyQuipsOrderSupplyHeaderTable').empty();
    $('#officeSuppliesOrderSupplyInfoTable').empty();
    
}



// ******************************************** Supplies SECTION ***************************************************

function getSupplies() {
    $('#SuppliesTable').empty();
    $('#supplyButton').addClass("disabled");
    $('#deleteAllSupplies').removeClass("disabled");
    $('#deleteSupplies').addClass("disabled");
    orders = [];
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getSupplies" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#SuppliesTable').append('<tr><td class="collapsing"><div class="ui fitted slider supply checkbox"><input id="' + data[i]['SupplyId'] + '" type="checkbox"><label></label></div></td><td>' + data[i]['SupplyId'] + '</td><td>' + data[i]['Name'] + '</td><td>' + data[i]['InStock'] + '</td><td>' + data[i]['Price'] + '</td><td>' + data[i]['Picture'] + '</td><td><button id="' + data[i]['SupplyId'] + '"onclick="showSupplyInfo(this.id)" class="ui right small primary button">View</button></td></tr>');
            }
            $('.supply.checkbox')
                .checkbox({
                    onChange: function () {
                        $('#deleteSupplies').removeClass("disabled");
                        username = $(this).attr("id");
                        if ($.inArray(username, supplies) == -1) {
                            supplies.push(username);
                        }
                        else {
                            var index = supplies.indexOf(username);
                            supplies.splice(index, 1);
                            if (supplies.length == 0) {
                                $('#deleteSupplies').addClass("disabled");
                            }
                        }
                    }
                });
        }
    })
}

function deleteSupplies() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteSupplies", "supplies": supplies },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#SuppliesTable').empty();
            getSupplies();
        }
    })
}

function deleteAllSupplies() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAllSupplies" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#SuppliesTable').empty();
            $('#deleteAllSupplies').addClass("disabled");
            $('#supplyButton').removeClass("disabled");
        }
    })
}

function showSupply() {
    $('.special.modal.supply')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    $('.dropdown.supplyDrop')
        .dropdown({
            onChange: function (value, text, $selectedItem) {
                if(value == 1){
                    $('.paper.form').removeClass("hidden").trigger("reset");
                    $('.printers.form').addClass("hidden").trigger("reset");
                    $('.printToner.form').addClass("hidden").trigger("reset");
                    $('.stickyQuips.form').addClass("hidden").trigger("reset");
                    $('.officeSupplies.form').addClass("hidden").trigger("reset");

                }
                else if(value == 2){
                    $('.paper.form').addClass("hidden").trigger("reset");
                    $('.printers.form').removeClass("hidden").trigger("reset");
                    $('.printToner.form').addClass("hidden").trigger("reset");
                    $('.stickyQuips.form').addClass("hidden").trigger("reset");
                    $('.officeSupplies.form').addClass("hidden").trigger("reset");
                }
                else if(value == 3){
                    $('.paper.form').addClass("hidden").trigger("reset");
                    $('.printers.form').addClass("hidden").trigger("reset");
                    $('.printToner.form').removeClass("hidden").trigger("reset");
                    $('.stickyQuips.form').addClass("hidden").trigger("reset");
                    $('.officeSupplies.form').addClass("hidden").trigger("reset");
                }
                else if(value == 4){
                    $('.paper.form').addClass("hidden").trigger("reset");
                    $('.printers.form').addClass("hidden").trigger("reset");
                    $('.printToner.form').addClass("hidden").trigger("reset");
                    $('.stickyQuips.form').removeClass("hidden").trigger("reset");
                    $('.officeSupplies.form').addClass("hidden").trigger("reset");                 
                }
                else if(value == 5){
                    $('.paper.form').addClass("hidden").trigger("reset");
                    $('.printers.form').addClass("hidden").trigger("reset");
                    $('.printToner.form').addClass("hidden").trigger("reset");
                    $('.stickyQuips.form').addClass("hidden").trigger("reset");
                    $('.officeSupplies.form').removeClass("hidden").trigger("reset");   
                }
            }
        });
}

function addSupply() {
    console.log($('#subSelect').val())
    if ($('#subSelect').val() == 1) {
        var array = $('.paper.form').serializeArray();
        type = array[0]['value']
    }
    else if ($('#subSelect').val() == 2) {
        var array = $('.printers.form').serializeArray();
        type = array[0]['value']
    }
    else if ($('#subSelect').val() == 3) {
        var array = $('.printToner.form').serializeArray();
        type = array[0]['value']
    }
    else if ($('#subSelect').val() == 4) {
        var array = $('.stickyQuips.form').serializeArray();
        type = array[0]['value']
    } else {
        var array = $('.officeSupplies.form').serializeArray();
        type = array[0]['value']
    }
    console.log(array)
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "addSupply", "data": array , "type" : type },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            getSupplies();
        }
    })

    $('.paper.form').trigger("reset");
    $('.printers.form').trigger("reset");
    $('.printToner.form').trigger("reset");
    $('.stickyQuips.form').trigger("reset");
    $('.officeSupplies.form').trigger("reset");
    $('.dropdown').dropdown('clear');
}


function showSupplyInfo(supplyId) {
    $('.special.modal.supplyInfo')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    supplyInfo(supplyId)
}

function supplyInfo(supplyId){
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getSupplyInfo", "supplyId":supplyId},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            console.log(data)
            data = JSON.parse(data)
            
            keys = Object.keys(data)
            $('#supplyHeaderTable').append('<th>SupplyId</th>');
            $('#supplyInfoTable').append('<th>' + supplyId + '</th>');
            for (i = 1; i < keys.length; i++) {
                var key = keys[i]
                $('#supplyHeaderTable').append('<th>' + key + '</th>');
                $('#supplyInfoTable').append('<th>' + data[key] + '</th>');
            }
        }
    })
}

function closeSupplyInfo() {
    $('#supplyHeaderTable').empty();
    $('#supplyInfoTable').empty();
}

function closeNewSupply(){
    $('.paper.form').addClass("hidden").trigger("reset");
    $('.printers.form').addClass("hidden").trigger("reset");
    $('.printToner.form').addClass("hidden").trigger("reset");
    $('.stickyQuips.form').addClass("hidden").trigger("reset");
    $('.officeSupplies.form').addClass("hidden").trigger("reset");
}

// ********************************************  REVIEW SECTION ******************************************** 
function getReviews() {
    $('#reviewButton').addClass("disabled");
    $('#deleteAllReviews').removeClass("disabled");
    $('#deleteReviews').addClass("disabled");
    customers = [];
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getReviews" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                $('#ReviewsTable').append('<tr><td class="collapsing"><div class="ui fitted slider review checkbox"><input id="' + data[i]['ReviewId'] + '" type="checkbox"><label></label></div></td><td>' + data[i]['ReviewId'] + '</td><td>' + data[i]['CustomerId'] + '</td><td>' + data[i]['SupplyId'] + '</td><td>' + data[i]['Rating'] + '</td><td><button id="' + data[i]['ReviewId'] + '"onclick="showReview(this.id)" class="ui right small primary button">View</button></td><td>' + data[i]['Date'] + '</td></tr>');
            }
            $('.review.checkbox')
                .checkbox({
                    onChange: function () {
                        $('#deleteReviews').removeClass("disabled");
                        username = $(this).attr("id");
                        if ($.inArray(username, reviews) == -1) {
                            reviews.push(username);
                        }
                        else {
                            var index = reviews.indexOf(username);
                            reviews.splice(index, 1);
                            if (reviews.length == 0) {
                                $('#deleteReviews').addClass("disabled");
                            }
                        }
                    }
                });
        }
    })
}

function deleteReviews() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteReviews", "reviews": reviews },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#ReviewsTable').empty();
            getReviews();
        }
    })
}

function deleteAllReviews() {
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "deleteAllReviews" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            $('#ReviewsTable').empty();
            $('#reviewButton').removeClass("disabled");
        }
    })
}

function clearReviews(){
    $('reviewText').empty()
}

function showReview(reviewId){
    $('.special.modal.review')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getReviewText", "reviewId" : reviewId },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            $('#reviewText').html(data['Text'])
        }
    })
}

// ********************************************  DB ADMIN ******************************************** 


function getMongoInfo(){
    $.ajax({
        type: "GET",
        url: "http://192.168.50.43:5000/mongo/status",
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            console.log(data)
            $('#MongoUsage').html(data)
        }
    });
}


function getMySQLInfo(){
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getNumberOfQueries"},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            console.log(JSON.parse(data))
            $('#MySQLUsage').html(data)
        }
    })
}

function getElasticSearchInfo(){
    $.ajax({
        type: "GET",
        url: "http://192.168.50.43:9200/_cluster/stats?human&pretty",
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            console.log(JSON.parse(data))
            $('#ElasticSearchUsage').html(data)
        }
    });
}

function elasticSearch1() {
    
}

function elasticSearch2() {

}

function elasticSearch3() {

}

