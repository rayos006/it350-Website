// ******************************************** PRODUCTS SECTION ***************************************************
$(document).ready(function () {
    $('.ui.dropdown')
        .dropdown({
            on: 'hover'
        })
        ;
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
                if (data[i]['InStock'] == 1){
                    InStock = "In Stock"
                }
                else{
                    InStock = "Out of Stock"
                }
                $('#productListings').append('<div class="column"><div class="ui segment"><div class="ui grid"><div class="eight wide column"><img src="./img/' + data[i]['Picture'] + '" height="225" width="225"></div><div class="eight wide column"><h1>' + data[i]['Name'] + '</h1><h2>Price: $' + data[i]['Price'] + '</h2><button id="' + data[i]['SupplyId'] + '"onclick="showSupplyInfo(this.id)" class="ui right small primary button">More Info</button><h2>' + InStock + '</h2><div class="ui right action mini input"><input id = "quantityField-' + data[i]['SupplyId'] +'" style="max-width: 75px; type="text" placeholder="Quantity"><button class="ui blue labeled icon button" id="' + data[i]['SupplyId'] + '"onclick="addToCart(this.id)"><i class="cart icon"></i>Add To Cart</button></div></div></div></div>');
            }
        }
    })
});

function showSupplyInfoCart(supplyId) {
    $('.special.modal.supplyInfo')
        .modal({
            closable: false,
            centered: false,
            onApprove: function () {
                openCart()
            }
        })
        .modal('show')
        ;
    supplyInfo(supplyId)
}

// ******************************************** CART SECTION ***************************************************
function addToCart(supplyId){
    quantity = $('#quantityField-'+ supplyId).val()
    if (quantity){
        if(loggedIn != null){
            $.ajax({
                type: "POST",
                url: "http://localhost:5000/cart",
                data: { "username": username, "supply": {"supplyId" : supplyId, "quantity": quantity }},
                error: function () {
                    alert("Failed to get Elements")
                },
                success: function (data) {
                    
                }
            });
        }
        else{
            alert('Please login to create a cart!')
        }
    }
    else{
        alert("Please provide a quantity.")
    }

}

function openCart(){
    $('.longer.modal.cart')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    getCart()
}

function getCart() {
    $('#supplyList').empty()
    $('#PurchaseCartButton').removeClass('disabled')
    $('#DeleteCartButton').removeClass('disabled')
    // $.ajax({
    //     type: "GET",
    //     url: "http://localhost:5000/cart?username="+ username,
    //     error: function () {
    //         alert("Failed to get Elements")
    //     },
    //     success: function (data) {
    supplies = [{ "supplyId": "4245627", "quantity": "1" }, { "supplyId": "9552854", "quantity": "55" }]
    //supplies = "Not Found"
    if (supplies == "Not Found") {
        $('#supplyList').append('<h1>You do not have anything in your cart!</h1>')
        $('#PurchaseCartButton').addClass('disabled')
        $('#DeleteCartButton').addClass('disabled')
    }
    else {
        for (i = 0; i < supplies.length; i++) {
            $.ajax({
                type: "GET",
                url: "../admin/admin.php",
                quantity: supplies[i]['quantity'],
                data: { "action": "getSupply", "supplyId": supplies[i]['supplyId'] },
                error: function () {
                    alert("Failed to get Elements")
                },
                success: function (data) {
                    data = JSON.parse(data)
                    supply = data
                    if (supply['InStock'] == 1) {
                        InStock = "In Stock"
                    }
                    else {
                        InStock = "Out of Stock"
                    }
                    $('#supplyList').append('<div class="column"><div class="ui segment"><div class="ui grid"><div class="eight wide column"><img src="../img/' + supply['Picture'] + '" height="200" width="200"></div><div class="eight wide column"><h1>' + supply['Name'] + '</h1><h2>Price: $' + supply['Price'] + '</h2><button id="' + supply['SupplyId'] + '"onclick="showSupplyInfoCart(this.id)" class="ui right small primary button">More Info</button><h2>' + InStock + '</h2><h2>Quantity: ' + this.quantity + '</h2></div></div>');
                }
            });
        }
    }
    //  }
    // });
}

function deleteCart(){
    $.ajax({
        type: "DELETE",
        url: "http://localhost:5000/cart?username="+ username,
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
        }
    });
}

function submitCart(dataString) {
    // $.ajax({
    //     type: "GET",
    //     url: "http://localhost:5000/cart?username="+ username,
    //     dataString: dataString,
    //     error: function () {
    //         alert("Failed to get Elements")
    //     },
    //     success: function (data) {
    supplies = [{ "supplyId": "4245627", "quantity": "1" }, { "supplyId": "9552854", "quantity": "55" }]
    supplyList = []
    for (i = 0; i < supplies.length; i++) {
        supplyList.push(supplies[i]['supplyId'])
    }
    splitString = dataString.split(".");
    customerId = splitString[0]
    companyId = splitString[1]
    accountId = splitString[2]
    data = [{ name: "CompanyId", value: companyId }, { name: "AccountId", value: accountId }, { name: "CustomerId", value: customerId }, { name: "Shipped", value: "0" }]
    $.ajax({
        type: "POST",
        url: "../admin/admin.php",
        data: { "action": "addOrder", "data": data, "supplyList": supplyList },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            //alert(data)
        }
    })
    //    }
    //    })

}


// ******************************************** MESSAGES SECTION ***************************************************

function showMessages() {
    $('#usernameList').empty()
    $('.longer.modal.messages')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getUsers" },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            for (i = 0; i < data.length; i++) {
                if (data[i]['Username'] == username){
                    continue
                }
                $('#usernameList').append('<div class="item" value="' + data[i]['Username'] +'">'+ data[i]['Username']+'</div >')
            }
        }
    });
    $('.ui.floating.dropdown')
        .dropdown({
            onChange: function (value) {
                getMessages(value)
            }
        })
        ;
}

function getMessages(receiver) {
    $('#messageInputDIV').removeClass('hidden')
    $('#messageList').empty()
    // $.ajax({
    //     type: "GET",
    //     url: "http://localhost:5000/messages?username="+ username + "&receiver=" + receiver,
    //     error: function () {
    //         alert("Failed to get Elements")
    //     },
    //     success: function (data) {
    messages = []
    if (messages.length == 0) {
        $('#messageList').append('<h1>No messages!</h1>')
    }
    else {
        for (i = 0; i < messages.length; i++) {
            if (messages[i]['sender'] == username) {
                $('#messageList').append('<div class="column"><div class="ui grey inverted raised segment"><button id="' + messages[i]['messageId'] + '" onclick="deleteMessage(this.id)" class="deleteMessageButton circular ui red icon button"><i class= "icon times"></i></button><p>' + messages[i]['text'] + '</p></div><p class="time">' + messages[i]['time'] + '</p></div><div class="column"></div>')
            }
            else {
                $('#messageList').append('<div class="column"></div><div class="column"><div class="ui blue inverted raised segment"><button id="' + messages[i]['messageId'] + '" onclick="deleteMessage(this.id)" class="deleteMessageButton circular ui red icon button"><i class= "icon times"></i></button><p>' + messages[i]['text'] + '</p></div><p class="time">' + messages[i]['time'] + '</p></div>')
            }
        }
    }
    //  }
    // });
}

function sendMessage(){
    text = $('messageText').val()
    receiver = $('#recipientText').text()
    alert(username)
    data = {
        "receiver": receiver,
        "sender": username,
        "text": text
    }
    $.ajax({
        type: "POST",
        url: "http://localhost:5000/messages",
        data: JSON.parse(data),
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {

        }
    });
}

function deleteMessage(messageId){
    $.ajax({
        type: "DELETE",
        url: "http://localhost:5000/messages?messageId=" + messageId,
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            getMessages($('#recipientText').text());
        }
    });
}

function refreshMessages(){
    getMessages($('#recipientText').text());
}

function purchaseCart(){
    $('#accountSelections').empty()
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getCustomer" , "username":username},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            data = JSON.parse(data)
            console.log(data)
            if(data == null){
                alert('Only Customers can place Orders!')
            }
            else{
                $('.special.modal.purchaseCart')
                    .modal({
                        centered: false
                    })
                    .modal('show')
                    ;
                companyId = data['CompanyId']
                customerId = data['CustomerId']
                $.ajax({
                    type: "GET",
                    url: "../admin/admin.php",
                    data: { "action": "getCompanyAccounts", "companyId": companyId },
                    companyId : companyId,
                    customerId: customerId,
                    error: function () {
                        alert("Failed to get Elements")
                    },
                    success: function (data) {
                        console.log(data)
                        data = JSON.parse(data)
                        for (i = 0; i < data.length; i++) {
                            $('.submitCartButton').attr('id', this.customerId + '.' + this.companyId + '.' + data[0]['AccountId'])
                            $('#CompanyIdH2').text('CompanyId: ' + this.companyId)
                            $('#AccountIdH2').text('AccountId: ' + data[0]['AccountId'])
                            $('#accountSelections').append('<div class="item" data-value="' + data[0]['AccountNumber'] + '">' + data[0]['AccountNumber'] +'</div>')
                            $('#accountSelections').append('<div class="item" data-value="' + data[0]['CardNumber'] + '">' + data[0]['CardNumber'] +'</div>')
                        }
                    }
                });
            }
        }
    });
}



// ******************************************** ORDERS SECTION ***************************************************

function showOrders() {
    $('#orderList').empty()
    $('.longer.modal.orders')
        .modal({
            centered: false
        })
        .modal('show')
        ;
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getCustomerOrders" , "username": username},
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
            console.log(data)
            data = JSON.parse(data)
            orderId = ""
            for (i = 0; i < data.length; i++) {
                
                console.log(data[i])
                data2 = JSON.parse(data[i])
                if(data2['CustomerId']){
                    orderId = data2['OrderId']
                    if(i != 0){
                        $('#orderList').append('<br><hr>')
                    }
                    $('#orderList').append('<h2>OrderId: ' + data2['OrderId'] + '   AccountId: ' + data2['AccountId'] + '   Shipped: ' + data2['Shipped'] +'</h2>')
                    $('#orderList').append('<div class="ui two column grid" id="' + data2['OrderId'] + '"></div>')
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: "../admin/admin.php",
                        data: { "action": "getSupply", "supplyId": data2['SupplyId'] },
                        orderId: orderId,
                        error: function () {
                            alert("Failed to get Elements")
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            supply = data
                            if (supply['InStock'] == 1) {
                                InStock = "In Stock"
                            }
                            else {
                                InStock = "Out of Stock"
                            }
                            $('#'+ this.orderId).append('<div class="column"><div class="ui segment"><div class="ui grid"><div class="eight wide column"><img src="../img/' + supply['Picture'] + '" height="200" width="200"></div><div class="eight wide column"><h1>' + supply['Name'] + '</h1><h2>Price: $' + supply['Price'] + '</h2><button id="' + supply['SupplyId'] + '"onclick="showSupplyInfoOrder(this.id)" class="ui right small primary button">More Info</button><h2>' + InStock + '</h2></div></div></div>');
                        }
                    });
                }
            }
        }
    })
}

function showSupplyInfoOrder(supplyId) {
    $('.special.modal.supplyInfo')
        .modal({
            closable: false,
            centered: false,
            onApprove: function () {
                showOrders()
            }
        })
        .modal('show')
        ;
    supplyInfo(supplyId)
}