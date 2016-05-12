<?php

class FolderAndFileTreeDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        global $options;

        $jr = array();

        //$id = getGETParameter('id');
        //debug(":$id:");

        $sp = $this->SPF->getSP('content_folder_list_all');
        $folderList = $sp->execute();


        foreach ($folderList as $folder) {
            $r = array(
                'id' => 'F' . $folder['id'],
                'text' => $folder['name'],
                'parent' => $folder['parent_id'] == 0 ? '#' : 'F' . $folder['parent_id'],
                'icon' => 'f'
            );
            $jr[] = $r;
        }

        $sp = $this->SPF->getSP('content_file_list_all');
        $songList = $sp->execute();

        foreach ($songList as $song) {
            $r = array(
                'id' => 'S' . $song['fileid'],
                'text' => $song['name'],
                'parent' => 'F' . $song['folderid'],
                'icon' => (($song['content_type'] == 'chord') ? 'c' : 'l'),
                /*'a_attr' => array(
                    "href" => '/song/' . $song['fileid']
                )*/
            );
            $jr[] = $r;
        }

        $this->setView('jsonResponse', $jr);
    }

}

?>
