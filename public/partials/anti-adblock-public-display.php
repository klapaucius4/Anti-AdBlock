<?php if($this->options['general_plugin_enabled']): ?>
<!-- The Modal -->
<div id="adbp" class="modal">

  <!-- Modal content -->
  <div class="adbp-content">
    <span class="adbp-close">&times;</span>

    <div id="adbp-tab-1" class="flex-section">
        <div class="adbp-text-section">
            <h2><?= $this->options['general_popup_title']; ?></h2>
            <p><?= $this->options['general_popup_content']; ?></p>
            <div class="adbp-flexbox w-100">
              <?php foreach(EXTENSION_LIST as $ext): ?>
              <div class="w-15">
                <?php require plugin_dir_path( __FILE__ ) . '../img/icons/'.$ext.'.svg'; ?>
              </div>
              <?php endforeach; ?>
            </div>
        </div>
        <div class="image-section">
            <img class="adbp-image" src="<?= $this->options['files_popup_image']; ?>" alt="<?= $this->plugin_name; ?>" />
        </div>
    </div>
    <div id="adbp-tab-2" class="flex-section">
        <div class="adbp-text-section">
            <h2><?= $this->options['general_button_how_to_disable']; ?> <strong><?= $this->browser->getBrowser(); ?></strong></h2>
        </div>
        <div class="adbp-flexbox">
            <?php foreach(EXTENSION_LIST as $ext): ?>
            <div class="adbp-flex-item">
              <?php /*
              <div class="w-25">
                <?php require plugin_dir_path( __FILE__ ) . '../img/icons/'.$ext.'.svg'; ?>
              </div>
              */ ?>
              <div class="extension-icon">
                <?php require plugin_dir_path( __FILE__ ) . '../img/icons/'.$ext.'.svg'; ?>
              </div>
              <div class="w-100">
                <video autoplay loop>
                  <source src="<?= $this->plugin_location; ?>public/movies/<?= $ext; ?>.mp4" type="video/mp4">
                  <!-- <source src="movie.ogg" type="video/ogg"> -->
                </video>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        <div class="bg-container"><?php require_once plugin_dir_path( __FILE__ ) . '../img/icons/'.$this->browser_slug.'.svg'; ?></div>
    </div>
    <div class="flex-section center mt-20">
      <button id="adbp-how-to-disable-button" class="button button3"><?= $this->options['general_button_how_to_disable']; ?> <?= $this->browser->getBrowser(); ?>?</button>
      <button id="adbp-reload-page-button" class="button button2"><?= $this->options['general_button_reload_page']; ?></button>
    </div>
    
</div>

</div>

<script>
  "use strict";

  document.addEventListener('DOMContentLoaded', init, false);
  
  function init(){

    // constants
    const modal = document.getElementById("adbp");
    const closeButton = document.getElementsByClassName("adbp-close")[0];
    const reloadButton = document.getElementById("adbp-reload-page-button");
    const howToDisableButton = document.getElementById('adbp-how-to-disable-button');

    // detect adblock
    adsBlocked(function(blocked){
      if(blocked){
        modal.style.display = "block";
      }
    });

    // popup actions
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

  }
  function adsBlocked(callback){
    var testURL = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';
    var testURL = 'https://www.google.com/adsense/';
    var myInit = {
      method: 'HEAD',
      mode: 'no-cors'
    };
    var myRequest = new Request(testURL, myInit);
    fetch(myRequest).then(function(response) {
      return response;
    }).then(function(response) {
      callback(false)
    }).catch(function(e){
      callback(true)
    });
  }

  
</script>
<?php endif;