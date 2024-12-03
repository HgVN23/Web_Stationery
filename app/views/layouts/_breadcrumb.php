<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $index => $item) {
                if ($index == count($breadcrumbs) - 1) {
                    echo '<li class="breadcrumb-item active">' . $item['name'] . '</li>';
                } else {
                    echo '<li class="breadcrumb-item"><a href="' . $item['url'] . '">' . $item['name'] . '</a></li>';
                }
            } ?>
        </ul>
    </div>
</div>