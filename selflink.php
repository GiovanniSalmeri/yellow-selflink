<?php
// SelfLink plugin
// Copyright (c) 2018 Giovanni Salmeri
// This file may be used and distributed under the terms of the public license.

class YellowSelfLink {
    const VERSION = "0.7.6";
    public $yellow;         //access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
    }
    
    // Handle page content parsing of custom block
    public function onParseContentBlock($page, $name, $text, $shortcut) {
        $output = null;
        if ($name=="a" && $shortcut) {
            list($slug, $atext) = explode(" ", $text, 2);
            $slug = '/' . $slug;
            if (substru($atext, 0, 2) == "- ") $atext = trim(substru($atext, 2));
            $pages = $this->yellow->pages->index();
            $found = false; $loc = null;
            foreach($pages as $page) {
                $loc = $page->getLocation(true);
                if (substr(rtrim($loc, '/'), -strlen($slug)) == $slug) {
                    $atext = $atext ? $atext : $page->getHtml("title");
                    $found = true;
                    break;
                }
            }
            if ($found) {
                $output = "<a  rel=\"nofollow\" href=\"" . htmlspecialchars($loc) . "\"target=\"_blank\">" . htmlspecialchars($atext) . "</a>";
            } else {
                $slug = htmlspecialchars(ltrim($slug, '/'));
                $output = "<a rel=\"nofollow\"  class=\"missing\" href=\"" . $slug . "\" target=\"_blank\">" . $slug . "</a>";
            }
        }
        return $output;
    }

    // Handle page extra HTML data
    public function onExtra($name) {
        $output = null;
        if ($name == "header") {
            $output = "<style>a.missing, a.missing:hover { background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAV0lEQVR4Xq2QwQ2AAAwC3cmd2Kk7sRP64CEJ9qOX8OPatMc/QKppnEPhTmJh23CLiwAqIw21CybKQ28qQi37WGFYBJcwfJQpP8LlEHKyZMF0IdmF13zlAjZ/6H4wb+mUAAAAAElFTkSuQmCC') center right no-repeat; vertical-align:middle;  margin-right 18px; padding-right:12px;}</style>\n";
        }
        return $output;
    }
}

$yellow->plugins->register("a", "YellowSelfLink", YellowSelfLink::VERSION);
