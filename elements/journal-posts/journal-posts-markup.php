<?php

function journal_post_markup($title, $excerpt, $link, $image)
{
?>
    <div class="journal-post">
        <div class="journal-post__inner">
            <div class="journal-post__media">
                <a href="<?= $link; ?>">
                    <?php if (isset($image) && $image) : ?>
                        <span style="background-image: url(<?= $image; ?>);"></span>

                    <?php endif; ?>
                </a>
            </div>
            <div class="journal-post__content">

                <h4><a href="<?= $link; ?>"><?= $title; ?></a></h4>
                <p class="truncate-overflow"><?= $excerpt; ?></p>
            </div>
            <div class="journal-post__readmore">
                <a href="<?= $link; ?>">Read More <span class="dashicons dashicons-arrow-right-alt2"></span></a>
            </div>
        </div>
    </div>
<?php
}



function journal_post_pagination_btn($current_page, $type = "page", $linked_page = null)
{
?>
    <div class="journal-post-pagination-btn journal-post-pagination-btn--<?= $type; ?>">
        <div class="journal-post-pagination-btn__inner <?= $type == "page" && $current_page == $linked_page ? "journal-post-pagination-btn__inner--active" : "" ?>">
            <a href="<?= get_pagenum_link($type == "page" ? $linked_page : ($type == "next" ? $current_page + 1 : ($type === "prev" ? max($current_page - 1, 1) : 1))); ?>" class="journal-post-pagination-btn__link">
                <?php if ($type == "page") : ?>
                    <small>
                        <?= $linked_page; ?>
                    </small>
                <?php elseif ($type === "next") : ?>
                    <span class="dashicons dashicons-arrow-right-alt2"></span>
                <?php elseif ($type === "prev") : ?>
                    <span class="dashicons dashicons-arrow-left-alt2"></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
<?php
}



function journal_posts_markup()
{
    global $wp_query;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged,
        "orderby" => "publish_date",
        "order" => 'DESC'
    );

    $query = new WP_Query($args);


    $current_pagination_range = range(min(max(1, $paged - 3), max($query->max_num_pages - 7, 1)), $query->max_num_pages <= 7 ? $query->max_num_pages : min(max(1, $paged - 3), max(1, $query->max_num_pages - 7)) + 6);
    wp_reset_postdata();
    wp_reset_query();
?>
    <div class="journal-posts">
        <div class="journal-posts__inner">
            <div class="journal-posts__posts">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?= journal_post_markup(get_the_title(), wp_trim_excerpt(), get_permalink(), get_the_post_thumbnail_url()); ?>
                <?php endwhile; ?>
            </div>
            <div class="journal-posts__pagination">
                <?php if ($paged > 1) : ?>
                    <?= journal_post_pagination_btn($paged, 'prev'); ?>
                <?php endif; ?>
                <?php foreach ($current_pagination_range as $page_index) : ?>
                    <?= journal_post_pagination_btn($paged, 'page', $page_index); ?>
                <?php endforeach; ?>

                <?php if ($paged < $query->max_num_pages) : ?>
                    <?= journal_post_pagination_btn($paged, 'next'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php

}



function mytheme_custom_excerpt_length($length)
{
    return 200;
}
add_filter('excerpt_length', 'mytheme_custom_excerpt_length', 999);



?>