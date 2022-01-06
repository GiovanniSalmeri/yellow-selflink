<?php
// SelfLink extension, https://github.com/GiovanniSalmeri/yellow-selflink

class YellowSelfLink {
    const VERSION = "0.8.16";
    public $yellow;         //access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
    }
    
    // Handle page content parsing of custom block
    public function onParseContentShortcut($page, $name, $text, $type) {
        $output = null;
        if ($name=="a" && ($type=="block" || $type=="inline")) {
            list($slug, $atext) = explode(" ", $text, 2);
            list($slug, $fragment) = explode("#", $slug);
            $slug = '/' . $slug;
            if (substru($atext, 0, 2) == "- ") $atext = trim(substru($atext, 2));
            $pages = $this->yellow->content->index(true);
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
                $output = "<a href=\"" . htmlspecialchars($loc) . ($fragment ? "#$fragment" : "") . "\">" . htmlspecialchars($atext) . "</a>";
            } else {
                $slug = htmlspecialchars(ltrim($slug, '/'));
                $output = "<a class=\"missing\" href=\"" . htmlspecialchars($slug) . "\">" . htmlspecialchars($slug) . "</a>";
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
