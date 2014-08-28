<?php

// Google groups extension for Bolt

namespace GoogleGroup;

class Extension extends \Bolt\BaseExtension
{

    function info()
    {
        $data = array(
            'name' =>"Google Groups",
            'description' => "A small extension to add a Google Group iframe in your website.",
            'author' => "Valentin Ferriere",
            'link' => "http://v-labs.fr",
            'version' => "0.1",
            'required_bolt_version' => "1.0",
            'highest_bolt_version' => "1.6.9",
            'type' => "Twig function",
            'first_releasedate' => "2014-08-27",
            'latest_releasedate' => "2014-08-27",
        );

        return $data;
    }

    function initialize()
    {
        $this->addTwigFunction('google_group', 'googleGroup');
    }

    function googleGroup($forumName, array $options = array())
    {
        $defaultOptions = array(
            'showsearch' => true,
            'showtabs' => true,
            'hideforumtitle' => true,
            'hidesubject' => true,
            'fragments' => false,
            'width' => 700,
            'height' => 1000
        );

        $mergedOptions = array_merge($defaultOptions, $options);

        $html = <<< EOM
        <iframe id="forum_embed" src="javascript:void(0)" scrolling="no" frameborder="0" width="%width%" height="%height%"></iframe>

        <script type="text/javascript">
            document.getElementById("forum_embed").src =
            "https://groups.google.com/forum/embed/?place=forum/%forum-name%" +
            "&showsearch=%showsearch%&showtabs=%showtabs%&hideforumtitle=%hideforumtitle%&hidesubject=%hidesubject%&fragments=%fragments%";
        </script>
EOM;

        foreach($mergedOptions as $key => $value) {
            $html = str_replace('%' . $key . '%', is_bool($value) ? ($value ? "true":"false") : $value, $html);
        }

        $html = str_replace("%forum-name%", $forumName, $html);

        return new \Twig_Markup($html, 'UTF-8');
    }
}