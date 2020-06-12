import tornado.websocket
import tornado.web
import tornado.ioloop
import logging
import Utils
import json
import random
# import threading
import time
from tornado.options import define, options


class MainSocketHandler(tornado.websocket.WebSocketHandler):

    clients = dict()  # 用于存放已登录的WebSocket连接
    guests = set()  # 用于存放来宾用户

    def check_origin(self, origin):  # 允许跨域
        return True

    def open(self):  # WebSocket建立时调用
        self.vcode = 0
        self.userid = 0
        self.power = "VISIT"
        MainSocketHandler.guests.add(self)
        logging.info("One guest user('{0}', '{1}', '{2}') connected".format(self.vcode, self.userid, self.power))

    def on_close(self):  # WebSocket断开连接时调用
        if self in MainSocketHandler.guests:
            MainSocketHandler.guests.remove(self)
            logging.info("One guest user disconnected")
        else:
            try:
                del MainSocketHandler.clients[self.userid]
                logging.info("User {0} disconnected".format(self.userid))
            except:
                pass

    def on_message(self, message):  # 收到WebSocket消息时调用
        data = json.loads(message)
        logging.info("Get message from {0}".format(message))
        action = data['msg']
        obj = data['obj']
        if action == "nothing":  # 测试命令
            Utils.sendMsg(self, "nothing", "Hello Socket")
        elif action == "login":  # 用户登录
            userid, openid, code, power = Utils.login(self, obj)
            if userid > 0:
                self.userid = userid
                self.power = power
                MainSocketHandler.clients[userid] = self
                # logging.info("User {0}('{1}', '{2}', '{3}') login".format(userid, self.vcode, self.userid, self.power))
                Utils.sendMsg(self, "loginSuccess", {"loginCode": code})
            elif userid < 0:
                Utils.sendMsg(self, "bindPhone", {"openid": openid})
            else:
                Utils.sendMsg(self, "loginError")
        elif action == "logout":  # 退出
            self.userid = 0
            self.power = 'VISIT'
            Utils.logout(self)
        elif action == "sendVcode":  # 发送验证码
            vcode = random.randint(100000, 999999)
            self.vcode = vcode
            Utils.sendMsg(self, "vcode", {"vcode": vcode})
        elif action == "bindPhone":  # 绑定手机
            Utils.bindPhone(self, obj)
        elif action == "getAssetInfo":  # 得到资产信息
            Utils.getAssetInfo(self, obj)
        elif action == "getFuncList":  # 得到功能列表
            Utils.getFuncList(self)
        elif action == "getCategory":  # 得到分类
            Utils.getCategory(self)
        elif action == "getStatus":  # 得到状态
            Utils.getStatus(self)
        elif action == "getLocal":  # 得到地点
            Utils.getLocal(self)
        elif action == "assetImport":  # 资产入库
            Utils.assetImport(self, obj)
        elif action == "isMe":  # 是我的资产
            Utils.isMe(self, obj)
        elif action == "assetBorrow":  # 资产领用
            Utils.assetBorrow(self, obj)
        elif action == "assetLend":  # 资产归还
            Utils.assetLend(self, obj)
        elif action == "getChecks":  # 得到盘点单
            Utils.getChecks(self)
        elif action == "insertBBS":  # 发布帖子
            Utils.insertBBS(self, obj)
        elif action == "recoveryBBS":  # 回复帖子
            Utils.recoveryBBS(self, obj)
        elif action == "selectBBS":  # 获取帖子
            Utils.selectBBS(self)
        elif action == "selectRecovery":  # 获取回复
            Utils.selectRecovery(self, obj)
        elif action == "deleteBBS":  # 删除帖子
            Utils.deleteBBS(self, obj)
        elif action == "deleteRecovery":  # 删除回复
            Utils.deleteRecovery(self, obj)
        elif action == "getCheckList":  # 得到盘点单详情
            Utils.getCheckList(self, obj)
        elif action == "checkAsset":  # 盘点
            Utils.checkAsset(self, obj)
        



def main():
    logging.basicConfig(level=logging.DEBUG, format='%(asctime)s - %(filename)s[line:%(lineno)d] - %(levelname)s: %(message)s')
    define("port", default=8888, type=int)
    define("host", default="0.0.0.0", type=str)
    app = tornado.web.Application([(r"/", MainSocketHandler)])
    app.listen(options.port, options.host)
    # threading.Thread(target=info).start()
    tornado.ioloop.IOLoop.instance().start()


if __name__ == "__main__":
    main()
