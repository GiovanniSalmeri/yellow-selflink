<?php
// SelfLink plugin
// Copyright (c) 2018-2019 Giovanni Salmeri
// This file may be used and distributed under the terms of the public license.

class YellowSelfLink {
    const VERSION = "0.8.3";
    const TYPE = "feature";
    public $yellow;         //access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
    }
    
    // Handle page content parsing of custom block
    public function onParseContentShortcut($page, $name, $text, $shortcut) {
        $output = null;
        if ($name=="a" && $shortcut) {
            list($slug, $atext) = explode(" ", $text, 2);
            $slug = '/' . $slug;
            if (substru($atext, 0, 2) == "- ") $atext = trim(substru($atext, 2));
            $pages = $this->yellow->content->index();
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
                $output = "<a href=\"" . htmlspecialchars($loc) . "\">" . htmlspecialchars($atext) . "</a>";
            } else {
                $slug = htmlspecialchars(ltrim($slug, '/'));
                $output = "<a class=\"missing\" href=\"" . $slug . "\">" . $slug . "</a>";
            }
        }
        return $output;
    }

    // Handle page extra HTML data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name == "header") {
            $output = "<style>a.missing, a.missing:hover { color: red }</style>\n";
        }
        return $output;
    }
}
