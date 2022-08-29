<?php
// Selflink extension, https://github.com/GiovanniSalmeri/yellow-selflink

class YellowSelflinkPatch {
    public $yellow;         //access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
    }

    // Check patches for Link 0.8.20
    public function onStartup() {
        $patch = false;
        if ($this->yellow->extension->isExisting("selflink") && $this->yellow->extension->isExisting("link")) {
            $path = $this->yellow->system->get("coreContentDirectory");
            foreach ($this->yellow->toolbox->getDirectoryEntriesRecursive($path, "/^.*\.(md|txt)$/", true, false) as $entry) {
                $fileData = $fileDataNew = $this->yellow->toolbox->readFile($entry);
                // Update Selflink shortcut
                $fileDataNew = preg_replace('/\[a\s+([^]\s]+)\s*\]/i', "[link $1]", $fileDataNew);
                $fileDataNew = preg_replace('/\[a\s+([^]\s]+)\s+-\s+([^]\s]+)\s*\]/i', "[link $1 $2]", $fileDataNew);
                $fileDataNew = preg_replace('/\[a\s+([^]\s]+)\s+-\s+([^]\s](?:.*[^]\s])?)\s*\]/i', "[link $1 \"$2\"]", $fileDataNew);
                // Update generic markdown links; if you want to leave them alone, delete the following two lines
                $fileDataNew = preg_replace('/(?<!!)\[([^]\s]+)\]\(([^\s)]+)\)/', "[link $2 $1]", $fileDataNew);
                $fileDataNew = preg_replace('/(?<!!)\[([^]]+)\]\(([^\s)]+)\)/', "[link $2 \"$1\"]", $fileDataNew);
                if ($fileData!=$fileDataNew && !$this->yellow->toolbox->createFile($entry, $fileDataNew)) {
                    $this->yellow->log("error", "Can't write file '$entry'!");
                }
                if ($fileData!=$fileDataNew) $patch = true;
            }
            $extensionDirectory = $this->yellow->system->get("coreExtensionDirectory");
            $this->yellow->toolbox->deleteFile("{$extensionDirectory}selflinkpatch.php");
        }
        if ($patch) $this->yellow->log("info", "Apply patches for Link 0.8.20");
    }
}
