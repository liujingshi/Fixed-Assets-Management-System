var nav_left_data = [{
    "title": "首页",
    "icon": "las la-home",
    "pull": false,
    "name": "home",
    "active": true,
    "up": "",
    "son": []
}, {
    "title": "资产管理",
    "icon": "las la-coins",
    "pull": true,
    "name": "asset",
    "active": false,
    "up": "",
    "son": [{
        "title": "资产入库",
        "icon": "las la-sign-in-alt",
        "pull": false,
        "name": "assetinsert",
        "active": false,
        "up": "asset",
        "son": []
    }, {
        "title": "领用退库",
        "name": "assetuse",
        "icon": "las la-sign-out-alt",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "借用归还",
        "name": "assetborrow",
        "icon": "las la-reply-all",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "资产调拨",
        "name": "assettransfer",
        "icon": "las la-share-square",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "实物信息更变",
        "name": "assetotherchange",
        "icon": "las la-edit",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "维保信息更变",
        "name": "assetmaintenancechange",
        "icon": "las la-pen-square",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "财务信息更变",
        "name": "assetfinance",
        "icon": "las la-pencil-alt",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "维修信息登记",
        "name": "assetrepair",
        "icon": "las la-keyboard",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "清理报废",
        "name": "assetclear",
        "icon": "las la-trash-alt",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }, {
        "title": "盘点管理",
        "name": "assetcheck",
        "icon": "las la-calculator",
        "up": "asset",
        "pull": false,
        "active": false,
        "son": []
    }]
}, {
    "title": "系统管理",
    "icon": "lab la-windows",
    "pull": true,
    "name": "system",
    "active": false,
    "up": "",
    "son": [{
        "title": "用户管理",
        "icon": "las la-user",
        "pull": false,
        "name": "users",
        "active": false,
        "up": "system",
        "son": []
    }, {
        "title": "功能测试",
        "icon": "las la-vial",
        "pull": false,
        "name": "test",
        "active": false,
        "up": "system",
        "son": []
    }]
}];

var nav_html = `
<ul class="nav-ul" id="nav_left">
    <li class="nav-li-header"></li>
    <li class="nav-li" v-for="nav in navs">
        <a :data-name="nav.name" @click="goto" :class="{'nav-li-a': true, 'nav-active': nav.active}" href="javascript:;">
            <i :class="nav.icon"></i>
            <span v-html="nav.title"></span>
            <i v-show="nav.pull" :class="{'las': true, 'la-angle-right': nav.active == false, 'la-angle-down': nav.active}"></i>
        </a>
        <ul v-show="nav.pull" class="nav-ul nav-ul-son">
            <li v-for="n in nav.son" class="nav-li nav-li-son">
                <a :data-name="n.name" @click="goto" :class="{'nav-li-a nav-li-a-son': true, 'nav-active nav-son-active': n.active}" href="javascript:;">
                    <i :class="n.icon"></i>
                    <span v-html="n.title"></span>
                    <i v-show="n.pull" class="{'las': true, 'la-angle-right': n.active == false, 'la-angle-down': n.active}"></i>
                </a>
                <ul v-show="n.pull" class="nav-ul nav-ul-grandson">
                    <li v-for="ng in n.son" class="nav-li nav-li-grandson">
                        <a :data-name="ng.name" @click="goto" :class="{'nav-li-a nav-li-a-grandson': true, 'nav-active nav-son-active': ng.active}" href="javascript:;">
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
            open_iframe(e.currentTarget.dataset.name);
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

function open_iframe(name) {
    if (name != "") {
        var data = find_data_by_name(name);
        if (data) {
            $(".main-iframe").attr("src", "./app/" + name + "/" + name + ".html?icon=" + data.icon + "&title=" + data.title);
        } else {
            $(".main-iframe").attr("src", "./app/" + name + "/" + name + ".html");
        }
        
    }
    update_navs(name);
}

function goto_active(data) {
    for (var i in data) {
        if (data[i].pull) {
            goto_active(data[i].son);
        } else if (data[i].active) {
            open_iframe(data[i].name);
        }
    }
}

goto_active(nav_left_data);