<style>
/* upgrade modal.xl */
@media (min-width: 768px) {
        .modal-xl {
         width: 90%;
         max-width:1200px;
         }
        }
</style>

<!-- MODALS.START -->

<!-- Alert Modal -->
<div class="modal fade" id="myAlert">
 <div class="modal-dialog modal-sm">
  <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header d-flex flex-row justify-content-center">
     <h3 class="text-success">Purchase Successful!</h3>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer d-flex flex-row justify-content-center">
    <button class="btn btn-primary" data-dismiss="modal">OK</button>
    </div>

  </div>
 </div>
</div>

<!-- Buy Now Modal -->
<div class="modal fade" id="Buy_Now_Modal" data-backdrop="static">
 <div class="modal-dialog modal-md">
  <div class="modal-content d-flex">


    <!-- Modal Header -->
    <div class="modal-header d-flex flex-row justify-content-center">
     <h2 class="text-info" id="Buy_Now_msg">Buy This Item?</h2>
    </div>

    <div id="Buy_Now_remover">
     <!-- Modal body -->
     <div class="modal-body d-flex justify-content-center">
      <img id="Buy_Now_Inc"/>
     </div>

     <!-- Modal footer -->
     <div class="modal-footer d-flex flex-row justify-content-center">
      <div class="btn-group">
       <button class="btn btn-success" data-toggle="modal" data-target="#myAlert"
                                       data-dismiss="modal" onclick="product_buy_now()">Buy</button>
       <button class="btn btn-danger" data-dismiss="modal" onclick="product_buy_cancel()">Cancel</button>
      </div>
     </div>
    </div>

  </div>
 </div>
</div>



<!-- cart Modal -->
<div class="modal fade" id="myModal">
 <div class="modal-dialog modal-xl">
  <div class="modal-content d-flex">

   <!-- Modal Header -->
   <div class="modal-header">
    <span class="col-sm-5"></span>
    <h1 class="col-sm-6">Your Items</h1>
    <button class="close" data-dismiss="modal" onclick="close_cart()">&times;</button>
   </div>

   <!-- Modal body -->
   <div id="modal_body" class="modal-body d-flex flex-column"></div>

   <!-- Modal footer -->
   <div id="contorl_BuyRemove_all_footer" class="modal-footer">
    <button class="btn btn-success" onclick="product_buy_all()">Buy All</button>
    <button class="btn btn-danger" onclick="product_remove_all()">Remove All</button>
   </div>

  </div>
 </div>
</div>


<!-- MODALS.END -->

<!-- cart -->
<div class="container-fluid d-flex flex-row align-items-center" style="background: #e6ffe6;">
 <span id="cart" class="material-icons" style="cursor: cell; font-size: 28px;"
       data-toggle="modal" data-target="#myModal" onclick="show_cart()">shopping_cart</span> <i>&nbsp &nbsp</i>
 <span id="item" class="c_i">items: <span id="item_num" class="c_i"></span></span> <i>&nbsp &nbsp</i>
 <span id="cost" class="c_i">cost:
  <span id="cost_val" class="c_i"></span> <span style="color: #00b300; font-size: 20px;">USD</span>
 </span>
 <button id="inbox" class="btn btn-primary btn-sm" style="margin-left: auto;" data-toggle="popover" data-placement="left"
         data-html="true" title="" data-content=""><span id="inbox_news" class="badge badge-danger"></span>  inbox
 </button>
 <style>.c_i { font-size: 22px; }</style>
</div>

<!-- product container -->
<div id="product_container" class="container-fluid" style="background-color: #ccccff;">
 <div id="stuff" class="d-flex justify-content-around"></div>
</div>

<!-- Dot container -->
<div id="con" class="container-fluid d-flex justify-content-center" style="background:; margin: 4px 0 4px;">
 <span class="dot active"></span>
 <span class="dot"></span>
 <span class="dot"></span>
 <span class="dot"></span>
 <span class="dot"></span>
</div>

<!-- Script -->
<script>
// inbox
var inbox = document.getElementById("inbox");
var inbox_news = document.getElementById("inbox_news");

var news_from_to = []; // 0, 2, 3, 5
var number_of_news = []; // 2, 1, 2, 3
var news_price_data = []; // 10, 20, 30, 40, 50, 800, 400, 9000


/*
var news_from_to = [0, 2, 3, 5];
var number_of_news = [2, 1, 2, 3];
var news_price_data = [10, 20, 30, 40, 50, 800, 400, 9000];
*/

// inbox.open
function inbox_open(news_from_to, number_of_news, news_price_data) {
 // set number of news in inbox
 if(inbox_news.innerHTML.length == 0) { inbox_news.innerHTML = 1; }
 else { inbox_news.innerHTML = (parseInt(inbox_news.innerHTML) + 1);}

 // escape double printing
 inbox.setAttribute("data-original-title", "");
 inbox.setAttribute("data-content", "");

 $(inbox).data('bs.popover').setContent();

 // create popover header/content holders
 var poH = document.createElement("span");
 var poC = document.createElement("span");

 // create popover
 for(var i = 0; i < news_from_to.length; i++) {
  // create header/content components
  var b = document.createElement("button");
  var c = document.createElement("span");

  b.innerHTML = (i + 1);
  b.className = "poH";

  c.className = "poC";
  c.style = "display: none;";

  // set price
  var news_price_of_items = 0;
  for(var j = news_from_to[i]; j < (news_from_to[i] + number_of_news[i]); j++) { news_price_of_items += news_price_data[j]; }

  // insert data
  c.innerHTML = "You Bought: <br />"+
                number_of_news[i]+ " items <br />"+
                "for $"+ news_price_of_items;

  // store popover header/content
  poH.appendChild(b);
  poC.appendChild(c);
  }
 inbox.setAttribute("data-original-title", poH.innerHTML);
 inbox.setAttribute("data-content", poC.innerHTML);

 console.log("Craft as Crafted:")
 console.log(poH.innerHTML);
 console.log(poC.innerHTML);
 }

// run inbox_open()
//inbox_open(news_from_to, number_of_news, news_price_data);

// cart
var cart = document.getElementById("cart");
var cost = document.getElementById("cost");
var item_num = document.getElementById("item_num");
var cost_val = document.getElementById("cost_val");

// data for Buy Now
var now_cart_item = [];
var now_cart_in_item = [];

// data for cart Modal & removal
var data_remove = [];

var cart_item = [];
var cart_in_item = [];
var cart_item_price = [];

/* OOP product.set */
var product = {
 product : function(inx, i_1, p_1, i_2, p_2) {
  // reference
  var me = this;

  // get.index
  me.index = inx;

  // get.img & price
  this.img_1 = i_1;
  this.img_2 = i_2;

  this.price_1 = p_1;
  this.price_2 = p_2;

  // new stuff
  var p_c = document.getElementById("product_container");
  var stuff = document.getElementById("stuff");
  stuff.remove();

  var stuff = document.createElement("div");
  stuff.id = "stuff";
  stuff.className = "d-flex justify-content-around";

  p_c.appendChild(stuff);

  // create.img
  var img_1 = document.createElement("img");
  img_1.setAttribute("src", this.img_1);

  var img_2 = document.createElement("img");
  img_2.setAttribute("src", this.img_2);

  // price
  var price_1 = document.createElement("span");
	price_1.innerHTML = "$";
  price_1.innerHTML += this.price_1;

	var price_2 = document.createElement("span");
	price_2.innerHTML = "$";
  price_2.innerHTML += this.price_2;

  // create.sub_img -> buy_now/add_to_cart
  var sub_img_1 = document.createElement("div");
	var sub_img_2 = document.createElement("div");

  // /buy_now
	var buy_now_1 = document.createElement("button");
	buy_now_1.innerHTML = "Buy Now";

	var buy_now_2 = document.createElement("button");
	buy_now_2.innerHTML = "Buy Now";

	// /add_to_cart
  var add_to_cart_1 = document.createElement("button");
	add_to_cart_1.innerHTML = "Add to Cart";

	var add_to_cart_2 = document.createElement("button");
	add_to_cart_2.innerHTML = "Add to Cart";

	// end.sub_img -> buy_now/add_to_cart
	sub_img_1.appendChild(buy_now_1);
	sub_img_1.appendChild(add_to_cart_1);

	sub_img_2.appendChild(buy_now_2);
	sub_img_2.appendChild(add_to_cart_2);

  // create.items
  var item_1 = document.createElement("span");
  var item_2 = document.createElement("span");

  // items.[img, price]/[index, index]
  item_1.appendChild(img_1);
	item_1.appendChild(price_1);
	item_1.appendChild(sub_img_1);
  item_1.setAttribute("data-index", me.index);
  item_1.setAttribute("data-in_index", 0);
  item_1.setAttribute("data-price", this.price_1);

  item_2.appendChild(img_2);
	item_2.appendChild(price_2);
	item_2.appendChild(sub_img_2);
  item_2.setAttribute("data-index", me.index);
  item_2.setAttribute("data-in_index", 1);
  item_2.setAttribute("data-price", this.price_2);

  // stuff.items
  stuff.appendChild(item_1);
  stuff.appendChild(item_2);


  // Style
  // items.style
  item_1.className = "d-flex flex-column";
  item_2.className = "d-flex flex-column";

  // img.style
  img_1.style = "";
  img_2.style = "";

  // price.style
	price_1.style= "color: green; font-size: 20px; position: absolute; padding-top: 370px;";
	price_2.style= "color: green; font-size: 20px; position: absolute; padding-top: 370px;";

  // sub_img.style
  sub_img_1.className = "btn-group grid-container";
  sub_img_2.className = "btn-group grid-container";

  sub_img_1.style= "";
  sub_img_2.style= "";

  // buy_now.style
	buy_now_1.style = "";
  buy_now_2.style = "";

  buy_now_1.className = "btn btn-primary col-sm-6";
  buy_now_2.className = "btn btn-primary col-sm-6";

  // add_to_cart.style
	add_to_cart_1.style = "";
  add_to_cart_2.style = "";

  add_to_cart_1.className = "btn btn-primary col-sm-6";
  add_to_cart_2.className = "btn btn-primary col-sm-6";


  // get data
  var item_1_index = parseInt(item_1.getAttribute("data-index"));
  var item_2_index = parseInt(item_2.getAttribute("data-index"));

  var item_1_in_index = parseInt(item_1.getAttribute("data-in_index"));
  var item_2_in_index = parseInt(item_2.getAttribute("data-in_index"));

  var item_1_price = parseInt(item_1.getAttribute("data-price"));
  var item_2_price = parseInt(item_2.getAttribute("data-price"));


  // items.sub_img.buy_now/add_to_cart.event
	me.price_1 = this.price_1;
	me.price_2 = this.price_2;

  buy_now_1.setAttribute("data-toggle", "modal");
  buy_now_2.setAttribute("data-toggle", "modal");

  buy_now_1.setAttribute("data-target", "#Buy_Now_Modal");
  buy_now_2.setAttribute("data-target", "#Buy_Now_Modal");

	buy_now_1.addEventListener("click", function() {
   $("#Buy_Now_Inc").attr("src", product_img_data[me.index][0]);
   now_cart_item.push(me.index);
   now_cart_in_item.push(0);
   }
  );
	buy_now_2.addEventListener("click", function() {
   $("#Buy_Now_Inc").attr("src", product_img_data[me.index][1]);
   now_cart_item.push(me.index);
   now_cart_in_item.push(1);
   }
  );

  var total = 0;
  function add_to_cartPrice_hardCodeHandler(i) { total += cart_item_price[i]; cost_val.innerHTML = total; }

	add_to_cart_1.addEventListener("click", function() {
	 total = 0;
   cart_item.push(item_1_index);
   cart_in_item.push(item_1_in_index);
	 cart_item_price.push(item_1_price);
	 item_num.innerHTML = cart_item_price.length;
	 for(var i in cart_item_price) { add_to_cartPrice_hardCodeHandler(i); } });
	add_to_cart_2.addEventListener("click", function() {
	 total = 0;
   cart_item.push(item_2_index);
   cart_in_item.push(item_2_in_index);
	 cart_item_price.push(item_2_price);
	 item_num.innerHTML = cart_item_price.length;
   for(var i in cart_item_price) { add_to_cartPrice_hardCodeHandler(i); } });
  }
 };

 /* OOP product.get */
 function product_get(inx, i_1, p_1, i_2, p_2) {
  // reference
  var me = this;

  // get.index
  me.index = inx;

  // get.img & price
  me.img_1 = i_1;
  me.img_2 = i_2;

  me.price_1 = p_1;
  me.price_2 = p_2;

  product.product(me.index, me.img_1, me.price_1, me.img_2, me.price_2);
  } function product_get_hardCode_handler(i) { dots[i].addEventListener("click", function() {
                                               product_get(i, product_img_data[i][0], product_price_data[i][0],
                                                              product_img_data[i][1], product_price_data[i][1]);
                                                              }); }

// product data
var product_img_data = [
 // hats
 ["Build/cookie_man/cookie_man_golden_hat.png",
  "Build/cookie_man/cookie_man_classic_cap.png"],
 // gloves
 ["Build/cookie_man/cookie_man_pinky_gloves.png",
  "Build/cookie_man/cookie_man_orange_gloves.png"],
 // mix _._
 ["Build/cookie_man/cookie_man_scarf.png",
  "Build/cookie_man/cookie_man_shoes.png"],
 // mix _._
 ["Build/cookie_man/cookie_man_winter_hat.png",
  "Build/cookie_man/cookie_man_red_gloves.png"],
 // mix _._
 ["Build/cookie_man/cookie_man_round_glasses.png",
	"Build/cookie_man/cookie_man_diamond_shoes.png"]
 ];

var product_price_data = [
 // hats
 [9000, 50],
 // gloves
 [800, 20],
 // mix _._
 [1300, 110],
 // mix _._
 [2200, 700],
 // mix _._
 [7000, 4000000]
 ];

// Get the con element
var con = document.getElementById("con");

// Get all dots with class="dot" inside the con
var dots = con.getElementsByClassName("dot");

// Loop through the dots and add the active class to the current dot
for(var i = 0; i < dots.length; i++) {
 dots[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active"; });

 product_get_hardCode_handler(i);
 }

/* OOP product.get */
product_get(0, product_img_data[0][0], product_price_data[0][0],
 							 product_img_data[0][1], product_price_data[0][1]);


// show_cart.Inc
var modal_body = document.getElementById("modal_body");

// show_cart /* line: 23, 24; */
function show_cart() {
 var content_Container = document.createElement("div");
 content_Container.id = "modal_content_Container";
 content_Container.className = "d-flex flex-column";
 content_Container.style = "padding-top: 15px; padding-bottom: 15px;";

 if(cart_item.length % 2 == 0) {
  for(var i = 0; i < cart_item.length; i += 2) {
   var items_Container = document.createElement("div");
   items_Container.className = "d-flex flex-row justify-content-around";
   for(var y = i; y < (i + 2); y++) {
    var item_Container = document.createElement("span");
    item_Container.className = "d-flex flex-column";
    item_Container.setAttribute("data-remove", y);
    var sc = item_Container.getAttribute("data-remove");
    data_remove.push(sc);

    var product_item = document.createElement("img");
    product_item.setAttribute("src", product_img_data[cart_item[y]][cart_in_item[y]]);

    var product_close = document.createElement("button");
    product_close.innerHTML = "X";
    product_close.style = "font-size: 25px;";
    product_close.className = "btn btn-outline-danger";
    product_close.onclick = show_cart_btn_single_item_removal;


    item_Container.appendChild(product_item);
    item_Container.appendChild(product_close);
    items_Container.appendChild(item_Container);
    }
   items_Container.appendChild(item_Container);
   content_Container.appendChild(items_Container);
   }
  modal_body.appendChild(content_Container);
  }
 else {
  var i = 0;
  while((cart_item.length - i) != 1) {
   var items_Container = document.createElement("div");
   items_Container.className = "d-flex flex-row justify-content-around";

   for(var y = i; y < (i + 2); y++) {
    var item_Container = document.createElement("span");
    item_Container.className = "d-flex flex-column";
    item_Container.setAttribute("data-remove", y);
    var sc = item_Container.getAttribute("data-remove");
    data_remove.push(sc);

    var product_item = document.createElement("img");
    product_item.setAttribute("src", product_img_data[cart_item[y]][cart_in_item[y]]);

    var product_close = document.createElement("button");
    product_close.innerHTML = "X";
    product_close.style = "font-size: 25px;";
    product_close.className = "btn btn-outline-danger";
    product_close.onclick = show_cart_btn_single_item_removal;

    item_Container.appendChild(product_item);
    item_Container.appendChild(product_close);
    items_Container.appendChild(item_Container);
    }
   items_Container.appendChild(item_Container);
   content_Container.appendChild(items_Container);

   i += 2;
   }
  var ssss = parseInt(data_remove.slice(-1)) + 1;
  if(data_remove.length == 0) {
   var items_Container = document.createElement("div");
   items_Container.className = "d-flex flex-row justify-content-around";

   var item_Container = document.createElement("span");
   item_Container.className = "d-flex flex-column";
   item_Container.setAttribute("data-remove", 0);
   var sc = item_Container.getAttribute("data-remove");
   data_remove.push(sc);

   var product_item = document.createElement("img");
   product_item.setAttribute("src", product_img_data[cart_item[i]][cart_in_item[i]]);

   var product_close = document.createElement("button");
   product_close.innerHTML = "X";
   product_close.style = "font-size: 25px;";
   product_close.className = "btn btn-outline-danger";
   product_close.onclick = show_cart_btn_single_item_removal;

   item_Container.appendChild(product_item);
   item_Container.appendChild(product_close);
   items_Container.appendChild(item_Container);

   items_Container.appendChild(item_Container);
   content_Container.appendChild(items_Container);

   modal_body.appendChild(content_Container);
   }
  else {
   var items_Container = document.createElement("div");
   items_Container.className = "d-flex flex-row justify-content-around";

   var item_Container = document.createElement("span");
   item_Container.className = "d-flex flex-column";
   item_Container.setAttribute("data-remove", ssss);
   var sc = item_Container.getAttribute("data-remove");
   data_remove.push(sc);

   var product_item = document.createElement("img");
   product_item.setAttribute("src", product_img_data[cart_item[i]][cart_in_item[i]]);

   var product_close = document.createElement("button");
   product_close.innerHTML = "X";
   product_close.style = "font-size: 25px;";
   product_close.className = "btn btn-outline-danger";
   product_close.onclick = show_cart_btn_single_item_removal;

   item_Container.appendChild(product_item);
   item_Container.appendChild(product_close);
   items_Container.appendChild(item_Container);

   items_Container.appendChild(item_Container);
   content_Container.appendChild(items_Container);

   modal_body.appendChild(content_Container);
   }
  }
 for(var i = 0; i < data_remove.length; i++) {
  var shit = parseInt(data_remove[i]);
  data_remove.splice(i, 1, shit);
  }
 } function show_cart_btn_single_item_removal() {
    var rr = this.parentElement;
    var splc = this.parentElement.getAttribute("data-remove");

    data_remove.splice(splc, 1, "remove");

    cart_item.splice(splc, 1, "remove");
    cart_in_item.splice(splc, 1, "remove");
    cart_item_price.splice(splc, 1, "remove");

    rr.remove();
    }
   function close_cart() {
    $("#modal_content_Container").remove();

    data_remove = data_remove.filter(data => typeof data !== "string");

    cart_item = cart_item.filter(ci => typeof ci !== "string");
    cart_in_item = cart_in_item.filter(cii => typeof cii !== "string");
    cart_item_price = cart_item_price.filter(cip => typeof cip !== "string");

    // indexes back to 0+ values
    data_remove = [];

    // out of modal -> items in cart & price
    var total = 0;
    function add_to_cartPrice_hardCodeHandler(i) { total += cart_item_price[i]; cost_val.innerHTML = total; }

    item_num.innerHTML = cart_item_price.length;

    if(cart_item.length == 0) { cost_val.innerHTML = ""; }
    else { for(var i in cart_item_price) { add_to_cartPrice_hardCodeHandler(i); } }
    }

// product.buy_cancel
function product_buy_cancel() {
 now_cart_item = [];
 now_cart_in_item = [];
 }

// product.buy_now
function product_buy_now() {
 // inbox.update
 if(news_from_to.length == 0) {
  news_from_to = [0];
  number_of_news = [1];
  news_price_data = [product_price_data[now_cart_item[0]][now_cart_in_item[0]]];
  inbox_open(news_from_to, number_of_news, news_price_data);
  }
 else {
  news_from_to.push(news_price_data.length);
  number_of_news.push(1);
  news_price_data.push(product_price_data[now_cart_item[0]][now_cart_in_item[0]]);
  inbox_open(news_from_to, number_of_news, news_price_data);
  }

 // mail purchase info
 now_mail();

 // empty data holders for next purchase
 now_cart_item = [];
 now_cart_in_item = [];
 }

// product.buy_all
function product_buy_all() {
 // inbox.update
 if(news_from_to.length == 0) {
  news_from_to = [0];
  number_of_news.push(cart_item.length);
  for(var i = 0; i < cart_item.length; i++) { news_price_data.push(product_price_data[cart_item[i]][cart_in_item[i]]); }
  inbox_open(news_from_to, number_of_news, news_price_data);
  }
 else {
  news_from_to.push(news_price_data.length);
  number_of_news.push(cart_item.length);
  for(var i = 0; i < cart_item.length; i++) { news_price_data.push(product_price_data[cart_item[i]][cart_in_item[i]]); }
  inbox_open(news_from_to, number_of_news, news_price_data);
  }
 // clean up the modal
 $("#modal_content_Container").remove();

 // mail purchase info
 mail();

 /* IN DEVELOPMENT */
 // remove footer to prevent jam
 //$("#contorl_BuyRemove_all_footer").remove();

 // success message
 var content_Container = document.createElement("div");
 content_Container.id = "modal_content_Container";
 content_Container.className = "d-flex justify-content-center";
 content_Container.style = "padding-top: 15px; padding-bottom: 15px;";

 var cC_removal_msg = document.createElement("h1");
 cC_removal_msg.innerHTML = '<span class="badge badge-pill badge-success">Purchase Successful!</span>';

 content_Container.appendChild(cC_removal_msg);
 modal_body.appendChild(content_Container);

 item_num.innerHTML = "";
 cost_val.innerHTML = "";

 // empty data holders for next purchase
 data_remove = [];

 cart_item = [];
 cart_in_item = [];
 cart_item_price = [];
 }

// product.remove_all
function product_remove_all() {
 // clean up the modal
 $("#modal_content_Container").remove();

 /* IN DEVELOPMENT */
 // remove footer to prevent jam
 //$("#contorl_BuyRemove_all_footer").remove();

 // removal message
 var content_Container = document.createElement("div");
 content_Container.id = "modal_content_Container";
 content_Container.className = "d-flex justify-content-center";
 content_Container.style = "padding-top: 15px; padding-bottom: 15px;";

 var cC_removal_msg = document.createElement("h1");
 cC_removal_msg.innerHTML = '<span class="badge badge-pill badge-danger">Items Removed!</span>';

 content_Container.appendChild(cC_removal_msg);
 modal_body.appendChild(content_Container);

 item_num.innerHTML = "";
 cost_val.innerHTML = "";

 // empty data holders
 data_remove = [];

 cart_item = [];
 cart_in_item = [];
 cart_item_price = [];
 }

// auto-mailer for Buy Now
function now_mail() {
 // data
 var pre_ci = JSON.stringify(now_cart_item);
 var pre_cii = JSON.stringify(now_cart_in_item);

 // XML Http Request
 $.ajax({
  url: 'http://localhost/cookie/mail.php',
  type: 'POST',
  data: { ci:pre_ci, cii:pre_cii },
  success: function() {}
  });
 }

// auto-mailer for Buy All
function mail() {
 // data
 var pre_ci = JSON.stringify(cart_item);
 var pre_cii = JSON.stringify(cart_in_item);

 // XML Http Request
 $.ajax({
  url: 'http://localhost/cookie/mail.php',
  type: 'POST',
  data: { ci:pre_ci, cii:pre_cii },
  success: function() {}
  });
 }

// aloud BS 4 popover to run
$(document).ready(function() { $('[data-toggle="popover"]').popover(); });

// BS 4 popover header buttons.addEventListener
$('#inbox').on('shown.bs.popover', function () {
 // get header/content classes
 var poHs = document.getElementsByClassName("poH");
 var poCs = document.getElementsByClassName("poC");

 // add event listeners
 for(var i = 0; i < poHs.length; i++) {
  popover_hardCodeHandler(i);
  }
 poHs[0].className += " seen active";
 poCs[0].style = "display: block;";

 // preserve correct pop spot
 $(inbox).popover("update");
 }
); function popover_hardCodeHandler(i) {
    var poHs = document.getElementsByClassName("poH");
    var poCs = document.getElementsByClassName("poC");

    poHs[i].onclick = function() {
     // remove active class from all poHs and set display none for all poCs
     for(var j = 0; j < poHs.length; j++) { poHs[j].className = poHs[j].className.replace(" active", ""); }
     for(var j = 0; j < poCs.length; j++) { poCs[j].style = "display: none;"; }

     // add seen and active class to current element
     this.className += " seen active";

     // set content for current element
     poCs[i].style = "display: block;";
     }
    }

// BS 4 popover.close
$('#inbox').on('hidden.bs.popover', function () {
 news_from_to = [];
 number_of_news = [];
 news_price_data = [];

 // set news to 0
 inbox_news.innerHTML = "";
 }
);
</script>

<!-- Style -->
<style>
</style>
