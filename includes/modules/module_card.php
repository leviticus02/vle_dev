<?php

echo '<div id="moduleCardCont">';
echo '<div id="moduleCard">';
echo '<a href="vle.php?module=' . $row->module_code . '#/feed" target="blank"><p class="modName">' . $row->name . '</p></a>';
echo '<p class="modCode">' . $row->module_code . '</p>';
echo '</div>';
echo '</div>';