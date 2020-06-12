
import requests
import json
import logging
from ljsmysql import Ljsmysql
import time
from common import JsonToDatetime, SameImage
import base64
import rsa
from Crypto.Cipher import AES


Ljsmysql.connect()


# 发送的信息格式
def sendMsg(tornadoSelf, msg, obj = ""):
    message = json.dumps({
        "msg": msg,
        "obj": obj
    }, cls=JsonToDatetime)
    tornadoSelf.write_message(message)
    # logging.info("Send message to {0}".format(message))


# request
# def requestUrl():
#     return "http://www.ljs.com/"



# public
# def publicPath():
#     return "../www/public/"


# request
def requestUrl():
    return "https://fams.ljscode.com/"



# public
def publicPath():
    return "../../fams/public/"



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


# 退出
def logout(tornadoSelf):
    Ljsmysql.table("fams_user").where("u_id", tornadoSelf.userid).update({"u_login_code": ""})
    sendMsg(tornadoSelf, "ok")


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
    if tornadoSelf.vcode == obj['vcode']:
        user = Ljsmysql.table("fams_user").where("u_phone", phone).select()
        if len(user) == 0:
            reg(phone)
        Ljsmysql.table("fams_user").where("u_phone", phone).update({"u_openid": openid})
        sendMsg(tornadoSelf, "bindPhoneSuccess")
    else:
        sendMsg(tornadoSelf, "vcodeError")


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
    funcList = [{
            'cuIcon': 'edit',
            'color': 'orange',
            'badge': 0,
            'name': '发布帖子',
            'action': 'insertBBS'
        }]
    if tornadoSelf.power == "VIP" or tornadoSelf.power == "SVIP":
        funcList += [{
            'cuIcon': 'deliver',
            'color': 'blue',
            'badge': 0,
            'name': '资产入库',
            'action': 'assetImport'
        }]
    if tornadoSelf.power == "VIP" or tornadoSelf.power == "SVIP" or tornadoSelf.power == "USER":
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
    no = qrDecode(obj['no'])
    sql = "select * from fams_asset ass, fams_category cate, fams_status sta, fams_local local where "
    sql += "ass.cate_id = cate.cate_id and ass.sta_no = sta.sta_no and ass.as_local_id = local.local_id and "
    sql += "ass.as_no = '{0}'".format(no)
    assetInfo = Ljsmysql.query(sql)
    if len(assetInfo) > 0:
        assetInfo = assetInfo[0]
        sendMsg(tornadoSelf, "assetInfo", assetInfo)
    else:
        sendMsg(tornadoSelf, "error")


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
    else:
        sendMsg(tornadoSelf, "error")


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
    else:
        sendMsg(tornadoSelf, "error")


# 获得盘点单
def getChecks(tornadoSelf):
    if tornadoSelf.power == "VIP" or tornadoSelf.power == "SVIP":
        dbData = Ljsmysql.table("fams_check").where([
            ["c_exist", 1],
            ["c_sta_no", "<>", "YWC"]
        ]).select()
    else:
        dbData = Ljsmysql.table("fams_check").where([
            ["c_exist", 1],
            ["c_sta_no", "<>", "YWC"],
            ["u_id", tornadoSelf.userid]
        ]).select()
    sendMsg(tornadoSelf, "checks", dbData)


# 读取密文数据
def loadData(data):
    jsonString = str(base64.b64decode(data))[2:-1]
    jsonData = json.loads(jsonString)
    n = jsonData['n']
    q1 = str(base64.b64decode(jsonData['r1']))[2:-1]
    q1 = base64.b64decode(jsonData['r1'])
    q2 = str(base64.b64decode(jsonData['r2']))[2:-1]
    return n, q1, q2


# AES解密
def aesDecode(data, aesM):
    aes = AES.new(aesM, AES.MODE_ECB)
    base64Dec = base64.decodebytes(data.encode(encoding='utf-8'))
    rst = str(aes.decrypt(base64Dec), encoding='utf-8')
    return rst


# RSA解密
def rsaDecode(data, rsaPublicKey):
    tmp = """-----BEGIN RSA PUBLIC KEY-----
    {0}
    -----END RSA PUBLIC KEY-----""".format(rsaPublicKey)
    # publicKey = rsa.PublicKey.load_pkcs1(tmp)
    publicKey = rsa.PublicKey.load_pkcs1_openssl_pem(tmp)
    content = rsa.decrypt(data, publicKey)
    rst = content.decode("utf-8")
    return rst


# 二维码解密
def qrcodeDecode(data):
    result = "error"
    resPublicKey = Ljsmysql.table("fams_cms").where("cms_key", "publicKey").select()[0]['cms_value']
    n, q1, q2 = loadData(data)
    if (isSS(n)):
        aesM = rsaDecode(q1, resPublicKey)
        result = aesDecode(q2, aesM)
    return result

def qrDecode(data):
    url = "{0}utils/qrcode/decode".format(requestUrl())
    postData = {
        "data": data
    }
    html = requests.post(url, postData)
    result = html.text
    return result


# 是质数
def isSS(n):
    for i in range(2, n):
       if (n % i) == 0:
           return False
    return True


# 发布帖子
def insertBBS(tornadoSelf, obj):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        obj['u_id'] = tornadoSelf.userid
        obj['up_bbs_id'] = 0
        obj['bbs_time'] = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
        Ljsmysql.table("fams_bbs").insert(obj)
        sendMsg(tornadoSelf, "insertBBSSuccess")
    else:
        sendMsg(tornadoSelf, "error")


# 回复帖子
def recoveryBBS(tornadoSelf, obj):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        obj['u_id'] = tornadoSelf.userid
        obj['bbs_time'] = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
        Ljsmysql.table("fams_bbs").insert(obj)
        sendMsg(tornadoSelf, "recoveryBBSSuccess")
    else:
        sendMsg(tornadoSelf, "error")


# 删除回复
def deleteRecovery(tornadoSelf, obj):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        Ljsmysql.table("fams_bbs").where("bbs_id", obj['id']).update({'bbs_exist': 0})
        sendMsg(tornadoSelf, "deleteRecoverySuccess")
    else:
        sendMsg(tornadoSelf, "error")


# 删除帖子
def deleteBBS(tornadoSelf, obj):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        Ljsmysql.table("fams_bbs").where("bbs_id", obj['id']).update({'bbs_exist': 0})
        Ljsmysql.table("fams_bbs").where("up_bbs_id", obj['id']).update({'bbs_exist': 0})
        sendMsg(tornadoSelf, "deleteBBSSuccess")
    else:
        sendMsg(tornadoSelf, "error")


# 获取帖子
def selectBBS(tornadoSelf):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        dbData = Ljsmysql.table("fams_bbs").where("up_bbs_id", '0').order("bbs_time desc").select()
        sendMsg(tornadoSelf, "bbs", dbData)
    else:
        sendMsg(tornadoSelf, "error")


# 获取回复
def selectRecovery(tornadoSelf, obj):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        dbData = list(Ljsmysql.table("fams_bbs").where("bbs_id", obj['id']).order("bbs_time desc").select())
        dbData += list(Ljsmysql.table("fams_bbs").where("up_bbs_id", obj['id']).order("bbs_time desc").select())
        sendMsg(tornadoSelf, "recovery", dbData)
    else:
        sendMsg(tornadoSelf, "error")


# 得到盘点单内容
def getCheckList(tornadoSelf, obj):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        sql = "select * from fams_check_content cc, fams_check_content_status sta, fams_asset asset, "
        sql += "fams_category cate, fams_status fsta, fams_local local where "
        sql += "cc.c_c_sta_no = sta.c_c_sta_no and cc.as_no = asset.as_no and cc.c_c_exist = 1 and asset.as_exist = 1 and "
        sql += "asset.cate_id = cate.cate_id and asset.as_local_id = local.local_id and asset.sta_no = fsta.sta_no and "
        sql += "cc.c_id = {0}".format(obj['id'])
        dbData = Ljsmysql.query(sql)
        sendMsg(tornadoSelf, "checks", dbData)
    else:
        sendMsg(tornadoSelf, "error")


# 资产盘点
def checkAsset(tornadoSelf, obj):
    if tornadoSelf.userid and tornadoSelf.userid > 0:
        imagePath = "{0}image/{1}".format(publicPath(), obj['assetImage'])
        newPath = "{0}image/{1}".format(publicPath(), obj['newImage'])
        ccid = obj['ccid']
        cid = obj['cid']
        sImage = SameImage(imagePath, newPath)
        if sImage.canPass():
            Ljsmysql.table("fams_check_content").where("c_c_id", ccid).update({
                "c_c_sta_no": "YWC",
                "c_c_image": obj['newImage']
            })
        else:
            Ljsmysql.table("fams_check_content").where("c_c_id", ccid).update({
                "c_c_sta_no": "SHZ",
                "c_c_image": obj['newImage']
            })
        Ljsmysql.table("fams_check").where("c_id", cid).update({
                "c_sta_no": "SPZ"
            })
        sendMsg(tornadoSelf, "checkSuccess")
    else:
        sendMsg(tornadoSelf, "error")