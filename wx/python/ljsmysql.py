
import pymysql

class Ljsmysql:

    db = ""
    cursor = ""

    @staticmethod
    def connect(localhost="127.0.0.1", username="root", password="", dbname="fams", encoding="utf8"):
        Ljsmysql.db = pymysql.connect(localhost, username, password, dbname, charset=encoding)
        Ljsmysql.cursor = Ljsmysql.db.cursor(pymysql.cursors.DictCursor)

    @staticmethod
    def table(tableName):
        return Table(tableName)

    @staticmethod
    def query(sql):
        if Ljsmysql.exec(sql):
            Ljsmysql.db.commit()
            return Ljsmysql.cursor.fetchall()
        else:
            return []

    @staticmethod
    def exec(sql):
        print(sql)
        try:
            Ljsmysql.cursor.execute(sql)
            return True
        except:
            Ljsmysql.db.rollback()
            print("sql error: {0}".format(sql))
            return False


class Table:

    def __init__(self, tableName):
        self.tableName = tableName
        self.whereSql = ""

    def where(self, p1, p2 = False, p3 = False):
        if p2 == False:
            if isinstance(p1, dict):
                tmpList = []
                for k, v in p1.items():
                    tmpList.append("{0} = '{1}'".format(k, v))
                self.whereSql = "where {0}".format(",".join(tmpList))
            if isinstance(p1, list):
                tmpList = []
                for p in p1:
                    if len(p) == 2:
                        tmpList.append("{0} = '{1}'".format(p[0], p[1]))
                    if len(p) == 3:
                        tmpList.append("{0} {1} '{2}'".format(p[0], p[1], p[2]))
                self.whereSql = "where {0}".format(",".join(tmpList))
        if p2 != False and p3 == False:
            self.whereSql = "where {0} = '{1}'".format(p1, p2)
        if p3 != False:
            self.whereSql = "where {0} {1} '{2}'".format(p1, p2, p3)
        return self

    def find(self):
        rst = self.select()
        if len(rst) > 0:
            return True
        else:
            return False

    def select(self):
        sql = "select * from {0} {1}".format(self.tableName, self.whereSql)
        return Ljsmysql.query(sql)

    def delete(self):
        sql = "delete from {0} {1}".format(self.tableName, self.whereSql)
        Ljsmysql.exec(sql)
        Ljsmysql.db.commit()

    def update(self, p1, p2 = False):
        if p2 != False:
            updateSql = "set {0} = '{1}'".format(p1, p2)
        else:
            tmpList = []
            for k, v in p1.items():
                tmpList.append("{0} = '{1}'".format(k, v))
            updateSql = "set {0}".format(",".join(tmpList))
        sql = "update {0} {1} {2}".format(self.tableName, updateSql, self.whereSql)
        Ljsmysql.exec(sql)
        Ljsmysql.db.commit()

    def insert(self, datas):
        fields = []
        values = []
        for k, v in datas.items():
            fields.append(k)
            values.append("'{0}'".format(v))
        sql = "insert into {0}({1}) values({2})".format(self.tableName, ",".join(fields), ",".join(values))
        Ljsmysql.exec(sql)
        insertId = Ljsmysql.db.insert_id()
        Ljsmysql.db.commit()
        return insertId

