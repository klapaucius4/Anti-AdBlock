<!-- The Modal -->
<div id="adbp" class="modal">

  <!-- Modal content -->
  <div class="adbp-content">
    <span class="adbp-close">&times;</span>
    <div class="flex-section">
        <div class="text-section">
            <h2>Wyłącz tego AdBlocka!<br />Bo powiemy Martusi...</h2>
            <p>Some text in the Modal..</p>
        </div>
        <div class="text-section">
            <img class="adbp-image" src="<?= $this->plugin_location; ?>public/img/angry-cat.png" alt="" />
        </div>
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