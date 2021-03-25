var title;
var price;

function passItem(id) {
  var title = document.getElementById(id + "title").innerHTML;
  var price = document.getElementById(id + "price").innerHTML;
  url = 'http://localhost/Saving-Grace-Florist/items.html?title=' + encodeURIComponent(title) + '&price=' + encodeURIComponent(price);
  document.location.href = url;
}

function updateItemPage() {
  var url = document.location.href,
    params = url.split('?')[1].split('&'),
    data = {},
    tmp;
  for (var i = 0, l = params.length; i < l; i++) {
    tmp = params[i].split('=');
    data[tmp[0]] = tmp[1];
  }
  document.getElementById('title').innerHTML = data.title.replace(/%20/g, " ");
  document.getElementById('price').innerHTML = data.price.replace(/%24/g, "$");
}
