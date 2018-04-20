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

function supplyInfoCart(supplyId) {
    $.ajax({
        type: "GET",
        url: "../admin/admin.php",
        data: { "action": "getSupplyInfo", "supplyId": supplyId },
        error: function () {
            alert("Failed to get Elements")
        },
        success: function (data) {
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

function getCart(){
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
            if (supplies == "Not Found"){
                $('#supplyList').append('<h1>You do not have anything in your cart!</h1>')
                $('#PurchaseCartButton').addClass('disabled')
                $('#DeleteCartButton').addClass('disabled')
            }
            else{
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
                            $('#supplyList').append('<div class="column"><div class="ui segment"><div class="ui grid"><div class="eight wide column"><img src="../img/' + supply['Picture'] + '" height="200" width="200"></div><div class="eight wide column"><h1>' + supply['Name'] + '</h1><h2>Price: $' + supply['Price'] + '</h2><button id="' + supply['SupplyId'] + '"onclick="showSupplyInfoCart(this.id)" class="ui right small primary button">More Info</button><h2>' + InStock + '</h2><h2>Quantity: ' + this.quantity + '</h2></div></div></div>');
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


// ******************************************** MESSAGES SECTION ***************************************************

function showMessages() {
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
    messages = [{ "time": "03/25/2018 20:50", "text": "Is This Workin?", "receiver": "jimmyboy01", "sender": "rayos006", "messageId": "7871338" }, { "time": "03/25/2018 20:55", "text": "I hope So!", "receiver": "rayos006", "sender": "jimmyboy01", "messageId": "7437274" }, { "time": "03/25/2018 20:55", "text": "Hello? Did you get my last message?", "receiver": "rayos006", "sender": "jimmyboy01", "messageId": "1234567" }]
    if (messages == []) {
        $('#messageList').append('<h1>No messages!</h1>')
    }
    else {
        for (i = 0; i < messages.length; i++) {
            if(messages[i]['sender'] == username){
                $('#messageList').append('<div class="column"><div class="ui grey inverted raised segment"><button id="' + messages[i]['messageId'] + '" onclick="deleteMessage(this.id)" class="deleteMessageButton circular ui red icon button"><i class= "icon times"></i></button><p>' + messages[i]['text'] + '</p></div><p class="time">' + messages[i]['time'] + '</p></div><div class="column"></div>')
            }
            else{
                $('#messageList').append('<div class="column"></div><div class="column"><div class="ui blue inverted raised segment"><button id="' + messages[i]['messageId'] + '" onclick="deleteMessage(this.id)" class="deleteMessageButton circular ui red icon button"><i class= "icon times"></i></button><p>' + messages[i]['text'] + '</p></div><p class="time">' + messages[i]['time'] + '</p></div>')
            }
        }
    }
    //  }
    // });
}

function sendMessage(){
    text = $('messageText').val()
    receiver = $
    $.ajax({
        type: "POST",
        url: "http://localhost:5000/messages",
        data: {
            "receiver": receiver,
            "sender": username,
            "text": text
        },
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