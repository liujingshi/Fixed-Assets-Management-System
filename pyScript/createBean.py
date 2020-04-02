
import pymysql

class SQLgo(object):
    def __init__(self, ip=None, user=None, password=None, db=None, port=None):
        self.ip = ip
        self.user = user
        self.password = password
        self.db = db
        self.port = int(port)
        self.con = object

    @staticmethod
    def addDic(theIndex, word, value):
        theIndex.setdefault(word, []).append(value)

    def __enter__(self):
        self.con = pymysql.connect(
            host=self.ip,
            user=self.user,
            passwd=self.password,
            db=self.db,
            charset='utf8mb4',
            port=self.port
        )
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        self.con.close()

    def search(self, sql=None):
        data_dict = []
        id = 0
        with self.con.cursor(cursor=pymysql.cursors.DictCursor) as cursor:
            sqllist = sql
            cursor.execute(sqllist)
            result = cursor.fetchall()
            for field in cursor.description:
                if id == 0:
                    data_dict.append({'title': field[0], "key": field[0], "fixed": "left", "width": 150})
                    id += 1
                else:
                    data_dict.append({'title': field[0], "key": field[0], "width": 200})
            len = cursor.rowcount
        return {'data': result, 'title': data_dict, 'len': len}

    def showtable(self, table_name):
        with self.con.cursor() as cursor:
            sqllist = '''
                    select aa.COLUMN_NAME,
                    aa.DATA_TYPE,aa.COLUMN_COMMENT, cc.TABLE_COMMENT 
                    from information_schema.`COLUMNS` aa LEFT JOIN 
                    (select DISTINCT bb.TABLE_SCHEMA,bb.TABLE_NAME,bb.TABLE_COMMENT 
                    from information_schema.`TABLES` bb ) cc  
                    ON (aa.TABLE_SCHEMA=cc.TABLE_SCHEMA and aa.TABLE_NAME = cc.TABLE_NAME )
                    where aa.TABLE_SCHEMA = '%s' and aa.TABLE_NAME = '%s';
                    ''' % (self.db, table_name)
            cursor.execute(sqllist)
            result = cursor.fetchall()
            td = [
                {
                    'Field': i[0],
                    'Type': i[1],
                    'Extra': i[2],
                    'TableComment': i[3]
                } for i in result
            ]
        return td

    def gen_alter(self, table_name):
        with self.con.cursor() as cursor:
            sqllist = 'desc %s.%s;' % (self.db, table_name)
            cursor.execute(sqllist)
            result = cursor.fetchall()
            td = [
                {
                    'Field': i[0],
                    'Type': i[1],
                    'Null': i[2],
                    'Key': i[3],
                    'Default': i[4]
                } for i in result
            ]
            sqllist = 'show table status where NAME="%s";' % (table_name)
            cursor.execute(sqllist)
            result = cursor.fetchall()
            tablecomment = result[0][-1]
            [item.update(TableComment=tablecomment) for item in td]
            sqllist = 'show full columns from %s;' % (table_name)
            cursor.execute(sqllist)
            result = cursor.fetchall()
            for item in td:
                for item1 in result:
                    if item['Field'] == item1[0]:
                        item['Extra'] = item1[-1]
                        break
        return td

    def index(self, table_name):
        with self.con.cursor() as cursor:
            cursor.execute('show keys from %s' % table_name)
            result = cursor.fetchall()
            di = [
                {
                    'Non_unique': '是',
                    'key_name': i[2],
                    'column_name': i[4],
                    'index_type': i[10]
                }
                if i[1] == 0
                else
                {
                    'Non_unique': '否',
                    'key_name': i[2],
                    'column_name': i[4],
                    'index_type': i[10]
                }
                for i in result
            ]

            dic = {}
            c = []
            for i in di:
                self.addDic(dic, i['key_name'], i['column_name'])
            for t in dic:
                """
                初始化第一个value
                将value 数据变为字符串
                转为字典对象数组
                """
                str1 = dic[t][0]

                for i in range(1, len(dic[t])):
                    str1 = str1 + ',' + dic[t][i]

                temp = {}
                for g in di:
                    if t == g['key_name']:
                        temp.setdefault('Non_unique', g['Non_unique'])
                        temp.setdefault('index_type', g['index_type'])
                temp.setdefault('column_name', str1)
                temp.setdefault('key_name', t)
                c.append(temp)
            return c

    def baseItems(self, sql=None):

        with self.con.cursor() as cursor:
            cursor.execute(sql)
            result = cursor.fetchall()
            data = [c for i in result for c in i]
            return data

    def query_info(self, sql=None):
        with self.con.cursor(cursor=pymysql.cursors.DictCursor) as cursor:
            cursor.execute(sql)
            result = cursor.fetchall()
        return result


# f = SQLgo(ip="127.0.0.1", user="root", password="", port="3306", db="fams")
conn = pymysql.connect(
    host="127.0.0.1",
    user="root",password="",
    database="fams",
    charset="utf8")
cursor = conn.cursor()
cursor.execute("show tables")
result = cursor.fetchall()
res = [c for i in result for c in i]
for table in res:
    className = table[5:]
    classNameCap = className.capitalize()
    try:
        with SQLgo(
                ip="127.0.0.1",
                user="root",
                password="",
                port="3306",
                db="fams"
        ) as f:
            field = f.gen_alter(table_name=table)
    except Exception as e:
        print(e)
    getterAndSetter = ""
    for i in range(1, len(field)):
        fieldName = field[i]['Field']
        fieldNameCap = fieldName.capitalize()
        getterAndSetter += '''
    public function get{0}() {{
        $res = Db::name({2}::$className)->where({2}::$mainKey, $this->mainKeyValue)->select();
        try {{
            return $res[0]["{1}"];
        }} catch (Exception $e) {{
            return "";
        }}
    }}

    public function set{0}($value) {{
        Db::name({2}::$className)->where({2}::$mainKey, $this->mainKeyValue)->update(["{1}" => $value]);
    }}

'''.format(fieldNameCap, fieldName, classNameCap)

    fileContent = '''<?php
namespace app\\common\\model;

use think\\Db;

class {0} {{

    public static $className = "{1}";
    public static $mainKey = "{2}";
    private $mainKeyValue = "";

    public static function getAll() {{
        return Db::name(self::$className)->select();
    }}

    public static function getByPage($limit, $page) {{
        return Db::name(self::$className)->limit(($page-1)*$limit, $limit)->select();
    }}

    public static function insert($dic) {{
        Db::name(self::$className)->insert($dic);
    }}

    public function __construct($mkl) {{
        $this->mainKeyValue = $mkl;
    }}

    public function select() {{
       $res =  Db::name({0}::$className)->where({0}::$mainKey, $this->mainKeyValue)->select();
       try {{
           return $res[0];
       }} catch (Exception $e) {{
           return [];
       }}
    }}

    public function update($dic) {{
        Db::name({0}::$className)->where({0}::$mainKey, $this->mainKeyValue)->update($dic);
    }}

    {3}
}}
'''.format(classNameCap, className, field[0]['Field'], getterAndSetter)

    nF = open("www/application/common/model/{0}.php".format(classNameCap), 'w', encoding='UTF-8')
    nF.write(fileContent)
    nF.close()

