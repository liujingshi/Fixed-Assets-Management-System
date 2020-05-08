
import requests
import json
import logging
from ljsmysql import Ljsmysql
import time
from common import JsonToDatetime
import base64

Ljsmysql.connect()


# 发送的信息格式
def sendMsg(tornadoSelf, msg, obj = ""):
    message = json.dumps({
        "msg": msg,
        "obj": obj
    }, cls=JsonToDatetime)
    tornadoSelf.write_message(message)
    logging.info("Send message to {0}".format(message))


# appid
def AppID():
    return "wx17d9ecca3f159009"


# secret
def AppSecret():
    return "2e7e31e83e73dca48b55f4ae4b7be669"


# 通过code获取openid
def getOpenidByCode(code):
    url = "https://api.weixin.qq.com/sns/jscode2session?appid={0}&secret={1}&js_code={2}&grant_type=authorization_code".format(
        AppID(), AppSecret(), code
    )
    res = requests.get(url)
    errcode = res.json().get("errcode")
    # print(errcode)
    if errcode == 0 or errcode is None:
        openid = res.json().get('openid')
        # session_key = res.json().get('session_key')
        return openid
    else:
        return "noopenid"


# 用户登录
def login(tornadoSelf, obj):
    userid = 0
    code = obj['code']
    openid = code
    loginCode = code
    power = "VISIT"
    if code[-1:] == "=":
        user = Ljsmysql.table("fams_user").where("u_login_code", code).select()
        if len(user) > 0:
            userid = user[0]['u_id']
            power = user[0]['power_no']
    elif len(code) == 11:
        if tornadoSelf.vcode == obj['vcode']:
            if not Ljsmysql.table("fams_user").where("u_phone", code).find():
                reg(code)
            user = Ljsmysql.table("fams_user").where("u_phone", code).select()
            userid = user[0]['u_id']
            power = user[0]['power_no']
            loginCode = setLoginCode(user[0]['u_phone'])
    elif len(code) > 11:
        openid = getOpenidByCode(code)
        if openid == "noopenid":
            openid = code
        user = Ljsmysql.table("fams_user").where("u_openid", openid).select()
        if len(user) > 0:
            userid = user[0]['u_id']
            power = user[0]['power_no']
            loginCode = setLoginCode(user[0]['u_phone'])
        else:
            userid = -1
    return userid, openid, loginCode, power


# 设置登录码
def setLoginCode(phone):
    tStr = "{0}{1}".format(phone, time.time())
    code = base64.b64encode(tStr.encode("utf-8"))
    code = str(code, "utf-8")
    Ljsmysql.table("fams_user").where("u_phone", phone).update({
        "u_login_code": code
    })
    return code


# 微信小程序绑定手机
def bindPhone(tornadoSelf, obj):
    phone = obj['phone']
    openid = obj['openid']
    user = Ljsmysql.table("fams_user").where("u_phone", phone).select()
    if len(user) == 0:
        reg(phone)
    Ljsmysql.table("fams_user").where("u_phone", phone).update({"u_openid": openid})
    sendMsg(tornadoSelf, "bindPhoneSuccess")


# 三无注册
def reg(phone):
    Ljsmysql.table("fams_user").insert({
        "u_phone": phone
    })


# 获取我的页面信息
def getMineInfo(tornadoSelf):
    sendMsg(tornadoSelf, "mineInfo", {})


# 得到功能列表
def getFuncList(tornadoSelf):
    funcList = []
    user = Ljsmysql.table("fams_user").where("u_id", tornadoSelf.userid).select()
    if len(user) > 0:
        if user[0]['power_no'] == "VIP" or user[0]['power_no'] == "SVIP":
            funcList += [{
                'cuIcon': 'deliver',
                'color': 'blue',
                'badge': 0,
                'name': '资产入库',
                'action': 'assetImport'
            }]
        if user[0]['power_no'] == "VIP" or user[0]['power_no'] == "SVIP" or user[0]['power_no'] == "USER":
            funcList += [{
                'cuIcon': 'roundadd',
                'color': 'green',
                'badge': 0,
                'name': '领用&退库',
                'action': 'borrowlend'
            }]
    sendMsg(tornadoSelf, "funcList", funcList)


# 得到资产信息
def getAssetInfo(tornadoSelf, obj):
    sql = "select * from fams_asset ass, fams_category cate, fams_status sta, fams_local local where "
    sql += "ass.cate_id = cate.cate_id and ass.sta_no = sta.sta_no and ass.as_local_id = local.local_id and "
    sql += "ass.as_no = '{0}'".format(obj['no'])
    assetInfo = Ljsmysql.query(sql)
    if len(assetInfo) > 0:
        assetInfo = assetInfo[0]
        sendMsg(tornadoSelf, "assetInfo", assetInfo)


# 得到分类
def getCategory(tornadoSelf):
    dbData = Ljsmysql.table("fams_category").order("cate_id").select()
    sendMsg(tornadoSelf, "category", dbData)


# 得到状态
def getStatus(tornadoSelf):
    dbData = Ljsmysql.table("fams_status").order("sta_id").select()
    sendMsg(tornadoSelf, "status", dbData)


# 得到地点
def getLocal(tornadoSelf):
    dbData = Ljsmysql.table("fams_local").order("local_id").select()
    sendMsg(tornadoSelf, "local", dbData)


# 资产入库
def assetImport(tornadoSelf, obj):
    Ljsmysql.table("fams_asset").where("as_id", obj['as_id']).update({
        "as_name": obj['as_name'],
        "as_price": obj['as_price'],
        "cate_id": obj['cate_id'],
        "as_image": obj['as_image'],
        "as_local_id": obj['as_local_id']
    })
    sendMsg(tornadoSelf, "assetImportSuccess")


# 是我的资产
def isMe(tornadoSelf, obj):
    if Ljsmysql.table("fams_borrowlend").where({
        "u_id": tornadoSelf.userid,
        "as_no": obj['no'],
        "l_time": "0000-00-00 00:00:00"
    }).find():
        sendMsg(tornadoSelf, "isMe")


# 领用
def assetBorrow(tornadoSelf, obj):
    Ljsmysql.table("fams_borrowlend").insert({
        "as_no": obj["as_no"],
        "u_id": tornadoSelf.userid,
        "b_time": time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
    })
    if tornadoSelf.power == "VIP" or tornadoSelf.power == "SVIP":
        Ljsmysql.table("fams_asset").where("as_no", obj['as_no']).update({"sta_no": "ZY"})
    elif tornadoSelf.power == "USER":
        Ljsmysql.table("fams_asset").where("as_no", obj['as_no']).update({"sta_no": "SPZ"})
    sendMsg(tornadoSelf, "borrowSuccess")


# 归还
def assetLend(tornadoSelf, obj):
    if Ljsmysql.table("fams_borrowlend").where({
        "u_id": tornadoSelf.userid,
        "as_no": obj['as_no'],
        "l_time": "0000-00-00 00:00:00"
    }).find():
        Ljsmysql.table("fams_borrowlend").where({
            "u_id": tornadoSelf.userid,
            "as_no": obj['as_no'],
            "l_time": "0000-00-00 00:00:00"
        }).update({
            "l_time": time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
        })
        if tornadoSelf.power == "VIP" or tornadoSelf.power == "SVIP":
            Ljsmysql.table("fams_asset").where("as_no", obj['as_no']).update({"sta_no": "XZ"})
            Ljsmysql.table("fams_borrowlend").where({
                "u_id": tornadoSelf.userid,
                "as_no": obj['as_no'],
                "l_time": "0000-00-00 00:00:00"
            }).update({
                "bl_ok": 1
            })
        elif tornadoSelf.power == "USER":
            Ljsmysql.table("fams_asset").where("as_no", obj['as_no']).update({"sta_no": "SPZ"})
        sendMsg(tornadoSelf, "lendSuccess")
