import tornado.websocket
import tornado.web
import tornado.ioloop
import logging
import Utils
import json
from tornado.options import define, options
from ljsmysql import Ljsmysql


class MainSocketHandler(tornado.websocket.WebSocketHandler):

    clients = {}  # 用于存放WebSocket连接
    db = Ljsmysql.connect()

    def check_origin(self, origin):  # 允许跨域
        return True

    def open(self):  # WebSocket建立时调用
        openid = Utils.getOpenid(self.get_argument("code"))
        self.openid = openid
        MainSocketHandler.clients[openid] = {"openid": openid, "object": self}
        logging.info("User {0} connected".format(openid))

    def on_close(self):  # WebSocket断开连接时调用
        if self.openid in MainSocketHandler.clients:
            del MainSocketHandler.clients[self.openid]
            logging.info("User {0} disconnected".format(self.openid))

    def on_message(self, message):  # 收到WebSocket消息时调用
        data = json.loads(message)
        if data['msg'] == "nothing":
            logging.info("Get message from {0} => {1}".format(self.openid, message))
            Utils.sendMsg(self, "nothing", "Hello Socket")



def main():
    logging.basicConfig(level=logging.DEBUG, format='%(asctime)s - %(filename)s[line:%(lineno)d] - %(levelname)s: %(message)s')
    define("port", default=8888, help="run on the given port", type=int)
    define("host", default="0.0.0.0", help="run on the given host", type=str)
    app = tornado.web.Application([(r"/", MainSocketHandler)])
    app.listen(options.port, options.host)
    tornado.ioloop.IOLoop.instance().start()


if __name__ == "__main__":
    main()
