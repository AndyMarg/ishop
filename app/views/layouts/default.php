<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?= $this->getMetaHtml(); ?>
    </head>
    <body> 
        <h1>Layout DEFAULT</h1>
        <?= $content; ?> 
        
        <?php
        // отладочная информация по запросам
        if (core\base\Application::getConfig()->db->debug) {
            $logs = R::getDatabaseAdapter()->getDatabase()->getLogger();
        }
        ?>

    </body>
</html>