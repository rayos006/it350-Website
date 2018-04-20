import pymongo
from pymongo import MongoClient
import datetime
import requests
import random
import json


#MongoDb location
client = MongoClient('localhost', 27017)

db = client.dunder

messages = db['messages']

carts = db['carts']

def getMessages(username, receiver):
    messageList = []
    for message in messages.find({"$or":[{"$and": [{"sender": username}, {"receiver": receiver}]}, {"$and": [{"sender": receiver}, {"receiver": username}]}]}).sort("time", pymongo.ASCENDING):
        result = {
            "sender": message['sender'],
            "messageId": message['messageId'],
            "receiver": message['receiver'],
            "text": message['text'],
            "time": message['time'].strftime('%m/%d/%Y %H:%M')
        }
        messageList.append(result)
        if messageList.count == 0:
            return "No Messages"
    return json.dumps(messageList)


def addMessage(text, receiver, sender):
    t = datetime.datetime.now()
    newMessage = {
        "sender" : sender,
        "messageId": str(random.randint(1000000, 9999999)),
        "receiver": receiver,
        "text": text,
        "time": t
    }

    messages.insert_one(newMessage)
    return str(newMessage)


def deleteMessages(messageId):
    messages.delete_one({'messageId': messageId})
    return messageId


def getCart(username):
    cart = carts.find_one({"username": username})
    if cart != None:
        result = {
            "supplies": cart['supplies'],
            "username": cart['username'],
            "time": cart['time'].strftime('%m/%d/%Y %H:%M')
        }
        return json.dumps(result)
    else:
        return "Not Found"


def addCart(supply, username):
    if carts.find({"username": username}).count() == None or carts.find({"username": username}).count() < 1:
        t = datetime.datetime.now()
        newCart = {
            "supplies": [supply],
            "username": username,
            "time": t
        }
        carts.insert_one(newCart)
    else:
        updateCart(supply, username)
    return "returned"


def updateCart(supply, username):
    carts.update_one({"username": username}, {"$push": {"supplies": supply}})
    return "returned"


def deleteCart(username):
    carts.delete_one({'username': username})
    return username

def mongoStatus():
    statusDic = db.command("serverStatus")
    return str(statusDic)
