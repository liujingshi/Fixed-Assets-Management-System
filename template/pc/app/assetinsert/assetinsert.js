var url_data = get_url();
new Vue({
    el: "#header_title",
    data: {
        icon: url_data.icon,
        title: url_data.title
    }
});