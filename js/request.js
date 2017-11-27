new Request.HTML({
    url: 'C:/Users/User/Documents/Tozsde/MT4ek/XM1/Statement.html',
    data: {
        html: "<p>Text echoed back to request</p>" + "<script type='text/javascript'>$('target').highlight();<\/script>",
        delay: 3
    },
    method: 'post',
    update: 'target'
}).send();