<?php


// Element Class



class JournalPosts extends WPBakeryShortCode
{
    public function __construct()
    {
        add_action('init', array($this, 'journal_posts_mapping'));
        add_shortcode('yogi_journal_posts', array($this, 'journal_posts_html'));
    }

    public function journal_posts_mapping()
    {
        // Stop all if VC is not enabled
        if (!defined('WPB_VC_VERSION')) {
            return;
        }

        vc_map(
            array(
                "name" => __("Journal Posts", ""),
                "base" => "yogi_journal_posts",
                "class" => "",
                "category" => "YogiSurprise Elements",
                "params" => array(
                    array()
                )
            ),
        );
    }

    public function journal_posts_html($atts)
    {
        // Params extraction
        extract(
            shortcode_atts(
                array(),
                $atts
            )
        );



        require_once 'journal-posts-markup.php';
        ob_start();
        journal_posts_markup();
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}









new JournalPosts();
