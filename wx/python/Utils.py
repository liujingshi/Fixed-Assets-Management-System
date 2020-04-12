
import requests
import json
import logging


# 获取openid
def getOpenid(code):
    return "admin"


# 发送的信息格式
def sendMsg(tornadoSelf, msg, obj):
    message = json.dumps({
        "msg": msg,
        "obj": obj
    })
    tornadoSelf.write_message(message)
    logging.info("Send meaage to {0} => {1}".format(tornadoSelf.openid, message))
