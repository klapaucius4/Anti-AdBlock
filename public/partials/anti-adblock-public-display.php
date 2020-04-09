<!-- The Modal -->
<div id="adbp" class="modal">

  <!-- Modal content -->
  <div class="adbp-content">
    <span class="adbp-close">&times;</span>

    <div id="adbp-tab-1" class="flex-section">
        <div class="text-section">
            <h2>We detected <strong>Ad blocker</strong> extension!</h2>
            <p>Your browser using extension to disable advertising on our website. Our page </p>
        </div>
        <div class="image-section">
            <img class="adbp-image" src="<?= $this->plugin_location; ?>public/img/sad-man.gif" alt="" />
        </div>
    </div>
    <div id="adbp-tab-2" class="flex-section">
        <div class="text-section">
            <h2>How to disable adblock in Firefox</h2>
            <p>dfasd</p>
        </div>
    </div>
    <div class="flex-section center">
      <button id="adbp-how-to-disable-button" class="button button3">How to disable ad blocker plugin in your browser?</button>
      <button id="adbp-reload-page-button" class="button button2">I disabled ad blocker extension. Reload page.</button>
    </div>
    
</div>

</div>

<script>

// const modal=document.getElementById("adbp"),closeButton=document.getElementsByClassName("adbp-close")[0],reloadButton=document.getElementById("reload-page-button");window.onload=function(){modal.style.display="block"},closeButton.onclick=function(){modal.style.display="none"},reloadButton.onclick=function(){location.reload()};

  const modal = document.getElementById("adbp");
  const closeButton = document.getElementsByClassName("adbp-close")[0];
  const reloadButton = document.getElementById("adbp-reload-page-button");
  const howToDisableButton = document.getElementById('adbp-how-to-disable-button');

  window.onload = function() {
    modal.style.display = "block";
  }

  closeButton.onclick = function() {
    modal.style.display = "none";
  }

  reloadButton.onclick = function() {
    location.reload();
  }

  howToDisableButton.onclick = function() {
    document.getElementById('adbp-tab-1').style.display = "none";
    document.getElementById('adbp-tab-2').style.display = "block";
  }
</script>