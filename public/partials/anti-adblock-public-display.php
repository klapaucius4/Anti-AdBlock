<!-- The Modal -->
<div id="adbp" class="modal">

  <!-- Modal content -->
  <div class="adbp-content">
    <span class="adbp-close">&times;</span>
    <div class="flex-section">
        <div class="text-section">
            <h2>We detected <strong>Ad blocker</strong> extension!</h2>
            <p>Your browser using extension to disable advertising on our website. Our page </p>
        </div>
        <div class="image-section">
            <img class="adbp-image" src="<?= $this->plugin_location; ?>public/img/sad-man.gif" alt="" />
        </div>
    </div>
    <div class="flex-section center">
      <button class="button button3">How to disable ad blocker plugin in your browser?</button>
      <button class="button button2">I disabled ad blocker extension. Reload page.</button>
    </div>
</div>

</div>

<script>
var modal = document.getElementById("adbp");

var span = document.getElementsByClassName("adbp-close")[0];

window.onload = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
</script>