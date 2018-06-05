<script>
/* OOP button.set */

var btn = {
 btn : function(btn, link) {
  // reference
  var me = this;

  // get data
  this.btn = btn;
  me.link = link;

  // create button
  var b = document.createElement("button");

  b.className = "b";
  b.innerHTML = this.btn;

  // add event
  function r() { window.location = me.link; }
  b.addEventListener("click", function() { r(); });

  // display button
  $("#tape_data").append(b);
  }
 };
</script>
