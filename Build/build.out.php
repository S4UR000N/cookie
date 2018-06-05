<div class="jumbotron jumbotron-fluid d-flex justify-content-center">
 <span style="font-size: 100px; font-family: Germania One; color: red;">Sale</span>
</div>

<div id="slide_show" class="container-fluid d-flex justify-content-around" style="background-color: #ccccff;">
 <img src="Build/cookie_man/cookie_man_golden_hat.png"/>
 <img src="Build/cookie_man/cookie_man_round_glasses.png"/>
</div>

<!-- Script -->
<script>
// get slide_show
var sh = document.getElementById("slide_show");

/* Slide items */
var img = ["Build/cookie_man/cookie_man_golden_hat.png",
           "Build/cookie_man/cookie_man_round_glasses.png",
           "Build/cookie_man/cookie_man_scarf.png",
           "Build/cookie_man/cookie_man_winter_hat.png",
           "Build/cookie_man/cookie_man_pinky_gloves.png"];

// counter
var n = 0;

// slide show!
function show() {
 // content.set
 var inner_con = "";
 if(n < (img.length - 1)) {
   inner_con += "<img src="+ '"'+ img[n]+ '"'+ "/>";
   inner_con += "<img src="+ '"'+ img[n + 1]+ '"'+ "/>";

	 // value.get
   sh.innerHTML = inner_con;

	 // value.reSet
	 inner_con = "";

   // set.upgrade
   n++;
   }

 // if end
 if(n == (img.length - 1)) {
	 inner_con += "<img src="+ '"'+ img[n]+ '"'+ "/>";
	 inner_con += "<img src="+ '"'+ img[0]+ '"'+ "/>";

	 // value.get
   sh.innerHTML = inner_con;

	 // value.reSet
	 inner_con = "";

	 // re.set
	 n = 0;
	 }
 }

// show.display
setInterval(show, 2500);
</script>

<!-- Style -->
<style>
body { background-color: #3d3d29; }
</style>
