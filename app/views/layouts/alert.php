<div class="alert-overlay">
    <?php
    if (isset($result)) {
    ?>
        <div class="alert alert-<?php echo $result['class'] ?> alert-dismissible fade show" role="alert" id="autoDismissAlertError">
            <i class="fas <?php echo $result['icon'] ?>"></i>
            <strong><?php echo $result['title'] ?></strong>
            <div><?php echo $result['msg'] ?></div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
    }
    ?>
</div>