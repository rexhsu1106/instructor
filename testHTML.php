
<html>
<head>
  <?php
    require('head.php');
  ?>
  <script src="loadDB.js?2" type="text/javascript"></script>
  <script src="common.js?1" type="text/javascript"></script>

  <link rel="stylesheet" href="nicepage/nicepage.css" media="screen">
  <link rel="stylesheet" href="nicepage/Home.css" media="screen">
  <script class="u-script" type="text/javascript" src="nicepage/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="nicepage/nicepage.js" defer=""></script>

</head>

<style type="text/css">
@media (max-width: 575px) {
  .u-section-1 .u-list-1 {
    width: 300px;
  }
}

  .u-section-1 .u-container-layout-1 {
    padding: 15px;
  }

  .u-section-1 .u-group-1 {
    width: 150px;
    height: 150px;
  }

  .u-section-1 .u-group-2 {
    height: 140px;
    margin: 0 auto;
  }

  .u-section-1 .u-text-2 {
    font-size: 1.75rem;
    margin-top: 10px; 
  }

  .blink {
    animation-duration: 1s;
    animation-name: blink;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
  }
  /*
  @keyframes blink {
      from {
          opacity: 1;
      }
      to {
          opacity: 0;
      }
  }
  */
  @keyframes blink {
    0% {
        opacity: 1;
    }
    20% {
        opacity: 0;
    }
    40% {
        opacity: 1;
    }
    60% {
        opacity: 0;
    }
    80% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
  }
</style>

<body>

  <section class="u-align-center u-clearfix u-valign-top-lg u-valign-top-md u-valign-top-xl u-white u-section-1" id="carousel_f140">
      <div class="u-list u-list-1" style="margin-top: 0px;">
        <div class="u-repeater u-repeater-1">
          <div class="u-align-center u-container-style u-list-item u-palette-3-base u-repeater-item u-shape-rectangle u-list-item-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1 blink">
              <div class="u-border-4 u-border-white u-container-style u-group u-palette-3-base u-shape-circle u-group-1">
                <div class="u-container-layout u-valign-middle u-container-layout-2">
                  <h3 class="u-align-center u-text u-text-body-alt-color u-text-default u-text-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">100%</h3>
                </div>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">基本</h5>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-palette-3-base u-repeater-item u-shape-rectangle u-list-item-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <div class="u-border-4 u-border-white u-container-style u-group u-palette-3-base u-shape-circle u-group-1">
                <div class="u-container-layout u-valign-middle u-container-layout-2">
                  <h3 class="u-align-center u-text u-text-body-alt-color u-text-default u-text-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">60%</h3>
                </div>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">綠線轉彎</h5>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-palette-3-base u-repeater-item u-shape-rectangle u-list-item-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <div class="u-border-4 u-border-white u-container-style u-group u-palette-3-base u-shape-circle u-group-1">
                <div class="u-container-layout u-valign-middle u-container-layout-2">
                  <h3 class="u-align-center u-text u-text-body-alt-color u-text-default u-text-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">30%</h3>
                </div>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">一般雪道</h5>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-palette-3-base u-repeater-item u-shape-rectangle u-list-item-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <div class="u-border-4 u-border-white u-container-style u-group u-palette-3-base u-shape-circle u-group-1">
                <div class="u-container-layout u-valign-middle u-container-layout-2">
                  <h3 class="u-align-center u-text u-text-body-alt-color u-text-default u-text-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">20%</h3>
                </div>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">進階雪道</h5>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-palette-3-base u-repeater-item u-shape-rectangle u-list-item-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <div class="u-border-4 u-border-white u-container-style u-group u-palette-3-base u-shape-circle u-group-1">
                <div class="u-container-layout u-valign-middle u-container-layout-2">
                  <h3 class="u-align-center u-text u-text-body-alt-color u-text-default u-text-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">10%</h3>
                </div>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">高級雪道</h5>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-palette-3-base u-repeater-item u-shape-rectangle u-list-item-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <div class="u-border-4 u-border-white u-container-style u-group u-palette-3-base u-shape-circle u-group-1">
                <div class="u-container-layout u-valign-middle u-container-layout-2">
                  <h3 class="u-align-center u-text u-text-body-alt-color u-text-default u-text-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">0%</h3>
                </div>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">Park</h5>
            </div>
          </div>

          <span class="u-gradient u-icon u-icon-circle u-text-white u-icon-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <div class="u-group-2">
                <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 51.997 51.997" style="">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-a731"></use>
                </svg>
                <svg class="u-svg-content" viewBox="0 0 51.997 51.997" x="0px" y="0px" id="svg-a731" style="enable-background:new 0 0 51.997 51.997;"><g><path d="M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014C52.216,18.553,51.97,16.611,51.911,16.242z M49.521,21.261c-0.984,4.172-3.265,7.973-6.59,10.985L25.855,47.481L9.072,32.25c-3.331-3.018-5.611-6.818-6.596-10.99c-0.708-2.997-0.417-4.69-0.416-4.701l0.015-0.101C2.725,9.139,7.806,3.826,14.158,3.826c4.687,0,8.813,2.88,10.771,7.515l0.921,2.183l0.921-2.183c1.927-4.564,6.271-7.514,11.069-7.514c6.351,0,11.433,5.313,12.096,12.727C49.938,16.57,50.229,18.264,49.521,21.261z"></path></g>
                </svg>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">高級</h5>
            </div>
          </span>
          <span class="u-gradient u-icon u-icon-circle u-text-white u-icon-1">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <div class="u-group-2">
                <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 51.997 51.997" style="">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-a731"></use>
                </svg>
                <p class="u-text u-text-default u-text-white u-text-1 blink" style="position: absolute; top: 25px; left: 15px; z-index: 1; color: red;" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">100%</p>
                <svg class="u-svg-content" viewBox="0 0 51.997 51.997" x="0px" y="0px" id="svg-a731" style="enable-background:new 0 0 51.997 51.997;"><g><path d="M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014C52.216,18.553,51.97,16.611,51.911,16.242z M49.521,21.261c-0.984,4.172-3.265,7.973-6.59,10.985L25.855,47.481L9.072,32.25c-3.331-3.018-5.611-6.818-6.596-10.99c-0.708-2.997-0.417-4.69-0.416-4.701l0.015-0.101C2.725,9.139,7.806,3.826,14.158,3.826c4.687,0,8.813,2.88,10.771,7.515l0.921,2.183l0.921-2.183c1.927-4.564,6.271-7.514,11.069-7.514c6.351,0,11.433,5.313,12.096,12.727C49.938,16.57,50.229,18.264,49.521,21.261z"></path></g>
                </svg>
              </div>
              <h5 class="u-text u-text-body-alt-color u-text-default u-text-2">高級</h5>
            </div>
          </span>
        </div>
      </div>
  </section>
</body>