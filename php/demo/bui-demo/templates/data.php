<?php
$array = '[{"id" : "1","text":"山东","children":[
    {"id":"11","text":"济南","leaf":false},
    {"id":"12","text":"淄博","leaf":false,"children":[
      {"id":"121","text":"淄川区","leaf":true}
    ]}
]}]';

echo $array;
