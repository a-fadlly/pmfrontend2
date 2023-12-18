<?php
function active($currect_page)
{
  $url_array =  explode('/', $_SERVER['REQUEST_URI']);
  $url = end($url_array);
  if ($currect_page == $url) {
    echo 'active'; //class name in css 
  }
}
?>
<div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
  <div class="card card-custom">
    <div class="card-body px-5">
      <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
        <div class="navi-item my-2">
          <a href="index" class="navi-link <?php active('index') ?>">
            <span class="navi-icon mr-2">
              <span class="svg-icon svg-icon-lg">
                <i class="fa-solid fa-inbox"></i>
              </span>
            </span>
            <span class="navi-text font-weight-bolder font-size-lg">Inbox</span>
            <span class="navi-label">
              <span class="label label-rounded label-light-success font-weight-bolder"><?php echo $inbox->cases->total ?></span>
            </span>
          </a>
        </div>
        <div class="navi-item my-2">
          <a href="draft" class="navi-link <?php active('draft') ?>">
            <span class="navi-icon mr-2">
              <span class="svg-icon svg-icon-lg">
                <i class="fa-solid fa-pen-to-square"></i>
              </span>
            </span>
            <span class="navi-text font-weight-bolder font-size-lg">Draft</span>
            <span class="navi-label">
              <span class="label label-rounded label-light-warning font-weight-bolder"><?= $draft->cases->total ?></span>
            </span>
          </a>
        </div>
        <div class="navi-item my-2">
          <a href="participated" class="navi-link <?php active('participated') ?>">
            <span class="navi-icon mr-2">
              <span class="svg-icon svg-icon-lg">
                <i class="fas fa-arrow-alt-circle-right"></i>
              </span>
            </span>
            <span class="navi-text font-weight-bolder font-size-lg">Participated</span>
            <span class="navi-label">
              <span class="label label-rounded label-light-warning font-weight-bolder"><?= $participated->cases->total ?></span>
            </span>
          </a>
        </div>
        <div class="navi-item my-10"></div>
      </div>
    </div>
  </div>
</div>