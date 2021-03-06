var nav_left_data = [{
    "title": "首页",
    "icon": "las la-home",
    "pull": false,
    "name": "home",
    "active": false,
    "up": "",
    "son": []
}, {
    "title": "资产管理",
    "icon": "las la-desktop",
    "pull": true,
    "name": "assetmanage",
    "active": false,
    "up": "",
    "son": [{
        "title": "资产入库",
        "icon": "las la-sign-in-alt",
        "pull": false,
        "name": "assetimport",
        "active": false,
        "up": "assetmanage",
        "son": []
    }, {
        "title": "领用&归还",
        "icon": "las la-plus-square",
        "pull": false,
        "name": "assetborrowlend",
        "active": false,
        "up": "assetmanage",
        "son": []
    }, {
        "title": "盘点管理",
        "icon": "las la-check-square",
        "pull": false,
        "name": "assetcheck",
        "active": false,
        "up": "assetmanage",
        "son": []
    }, {
        "title": "设置",
        "icon": "las la-cog",
        "pull": true,
        "name": "assetsetting",
        "active": false,
        "up": "assetmanage",
        "son": [{
            "title": "资产分类",
            "icon": "las la-th-list",
            "pull": false,
            "name": "assetcategory",
            "active": false,
            "up": "assetsetting",
            "son": []
        }]
    }]
}, {
    "title": "我的审批",
    "icon": "las la-stamp",
    "pull": true,
    "name": "myapprove",
    "active": false,
    "up": "",
    "son": [{
        "title": "领用归还",
        "icon": "las la-stamp",
        "pull": false,
        "name": "blapprove",
        "active": false,
        "up": "myapprove",
        "son": []
    }, {
        "title": "盘点审批",
        "icon": "las la-stamp",
        "pull": false,
        "name": "checkapprove",
        "active": false,
        "up": "myapprove",
        "son": []
    }]
}, {
    "title": "系统管理",
    "icon": "lab la-windows",
    "pull": true,
    "name": "systemmanage",
    "active": false,
    "up": "",
    "son": [{
        "title": "组织架构",
        "icon": "las la-building",
        "pull": true,
        "name": "organizemanage",
        "active": false,
        "up": "systemmanage",
        "son": [{
            "title": "部门管理",
            "icon": "las la-city",
            "pull": false,
            "name": "departmentmanage",
            "active": false,
            "up": "organizemanage",
            "son": []
        }, {
            "title": "职位管理",
            "icon": "las la-chalkboard-teacher",
            "pull": false,
            "name": "positionmanage",
            "active": false,
            "up": "organizemanage",
            "son": []
        }, {
            "title": "人员管理",
            "icon": "las la-user-graduate",
            "pull": false,
            "name": "personmanage",
            "active": false,
            "up": "organizemanage",
            "son": []
        }]
    }, {
        "title": "用户管理",
        "icon": "las la-user",
        "pull": false,
        "name": "usermanage",
        "active": false,
        "up": "systemmanage",
        "son": []
    }, {
        "title": "查看日志",
        "icon": "las la-file-excel",
        "pull": false,
        "name": "syatemlog",
        "active": false,
        "up": "systemmanage",
        "son": []
    }]
}];

var nav_html = `
<ul class="nav-ul" id="nav_left">
    <li class="nav-li-header"></li>
    <li class="nav-li" v-for="nav in navs">
        <a :data-name="nav.name" @click="goto" :class="{'nav-li-a': true, 'nav-active': nav.active}" :href="nav.pull == true ? 'javascript:;' : '/app/' + nav.name">
            <i :class="nav.icon"></i>
            <span v-html="nav.title"></span>
            <i v-show="nav.pull" :class="{'las': true, 'la-angle-right': nav.active == false, 'la-angle-down': nav.active}"></i>
        </a>
        <ul v-show="nav.pull" class="nav-ul nav-ul-son">
            <li v-for="n in nav.son" class="nav-li nav-li-son">
                <a :data-name="n.name" @click="goto" :class="{'nav-li-a nav-li-a-son': true, 'nav-active nav-son-active': n.active}" :href="n.pull == true ? 'javascript:;' : '/app/' + n.name">
                    <i :class="n.icon"></i>
                    <span v-html="n.title"></span>
                    <i v-show="n.pull" :class="{'las': true, 'la-angle-right': n.active == false, 'la-angle-down': n.active}"></i>
                </a>
                <ul v-show="n.pull" class="nav-ul nav-ul-grandson">
                    <li v-for="ng in n.son" class="nav-li nav-li-grandson">
                        <a :data-name="ng.name" @click="goto" :class="{'nav-li-a nav-li-a-grandson': true, 'nav-active nav-son-active': ng.active}" :href="'/app/' + ng.name">
                            <i :class="ng.icon"></i>
                            <span v-html="ng.title"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
`;

$(".nav-left-content").html(nav_html);

function find_data_by_name_to_do_something(data, name, found_do_something, not_found_do_something) {
    var found = false;
    for (var i in data) {
        if (data[i].name == name) {
            found_do_something(data[i]);
            found = true;
        } else {
            not_found_do_something(data[i]);
        }
    }
    if (found) {
        return;
    }
    for (var i in data) {
        find_data_by_name_to_do_something(data[i].son, name, found_do_something, not_found_do_something);
    }
}

function find_data_by_name(name) {
    for (var i in nav_left_data) {
        var data = nav_left_data[i];
        if (data.name == name) {
            return data;
        } else {
            for (var j in data.son) {
                var data1 = data.son[j];
                if (data1.name == name) {
                    return data1;
                } else {
                    for (var k in data1.son) {
                        var data2 = data1.son[k];
                        if (data2.name == name) {
                            return data1;
                        }
                    }
                }
            }
        }
    }
}

var nav_left = new Vue({
    el: "#nav_left",
    data: {
        navs: nav_left_data
    },
    methods: {
        goto: function (e) {
            update_navs(e.currentTarget.dataset.name);
        }
    }
});

function update_navs(name) {
    find_data_by_name_to_do_something(nav_left.navs, name, function (data) {
        if (data.pull) {
            data.active = !data.active;
        } else {
            data.active = true;
        }
        if (data.up != "") {
            update_navs(data.up);
        }
    }, function (data) {
        data.active = false;
    });
}
