function get_url() {
    var url = document.location.href;
    var urls = url.split("?");
    if (urls.length > 1) {
        var ps = urls[1].split("&");
        var data = {};
        for (var i in ps) {
            var item = ps[i].split("=");
            data[item[0]] = decodeURI(item[1]);
        }
        return data;
    }
    return false;
}