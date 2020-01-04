function test() {
    ljspopup({
        el: "#popup",
        title: "刘叔的弹出层"
    });
    ljspopup({
        el: "<p>Hello World!</p>",
        title: "刘叔的弹出层",
        widrh: 500,
        left: 300,
        top: 300
    });
    ljspopup({
        el: "<p>Hello Popup!</p>",
        title: "刘叔的弹出层",
        left: 0,
        top: 0
    });
    ljspopup({
        el: "<p>Hello JavaScript!</p>",
        title: "刘叔的弹出层",
        left: 0,
        top: 600
    });
}