<?php
$this->beginContent('@app/views/layouts/base.php');

echo $content;

$this->registerCss("body { background-color: transparent; }");
$this->registerJs('$(parent.document).find("iframe.iframe-modal").css("height", $("#modal-content").height());');

$this->endContent();

?>

