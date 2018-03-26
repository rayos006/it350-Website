from flask import Flask, jsonify, make_response, request
import customer

app = Flask(__name__)


@app.route("/messages")
def getMessages():
    username = request.args.get('username')
    receiver = request.args.get('receiver')
    return customer.getMessages(username, receiver)


@app.route("/messages", methods=['POST'])
def addMessage():
    sender = request.json['sender']
    receiver = request.json['receiver']
    text = request.json['text']
    return customer.addMessage(text, receiver, sender)


@app.route("/messages", methods=['DELETE'])
def deleteMessages():
    messageId = request.args.get('messageId')
    return customer.deleteMessages(messageId)


@app.route("/cart")
def getCart():
    username = request.args.get('username')
    return customer.getCart(username)

@app.route("/cart", methods=['POST'])
def addCart():
    username = request.json['username']
    supply = request.json['supply']
    return customer.addCart(supply, username)

@app.route("/cart", methods=['DELETE'])
def deleteCart():
    username = request.args.get('username')
    return customer.deleteCart(username)


if __name__ == "__main__":
    app.run()
