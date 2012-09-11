<?php

    require_once(__DIR__.'/../../system/config.php');
    header("Content-Type: application/javascript");
    echo("// Offline");

    $bid = $_GET['b'];

    $pest = new Pest(REST_API_URL);
    $url_api = '/blibb/object/' . $bid . '?fields=t.i,n,s,u,at,t.v.default.ri' ;
    $jb = $pest->get($url_api);
    $bli = json_decode($jb);
    // print_r($bli);

    $url = REST_API_URL . '/' . $bli->owner . '/' . $bli->slug;
    echo "\n\nvar API_URL = \"" . $url . "\"\n\n";
    $template = $bli->template;
    echo "var Item = function(){\n";
    foreach ($template->i as $control) {
        echo  "\tthis." . $control->s . " = document.querySelector('input[name=\"" . $control->s . "\"]').value;\n";
    }
    echo "};\n\n";

    echo "\n\nfunction sendDataToServer(item) {\n";

    // parameters:
    $params= "app_token: '" . $bli->app_token . "', ";
    $ctrls = array();
    foreach ($bli->template->i as $control) {
        $params .=  $control->s . ": item." . $control->s . ", ";
        $ctrls[$control->s] = "\" + item." . $control->s . " + \"";
    }
    $ctrls['class'] = "\\\"item \"+ status + \"\\\"";
    $params .= " tags: item.tags ";
    $m = new Mustache();
    $content =  $m->render($template->v->default->ri, $ctrls);
?>

    $.post(API_URL, { <?php echo $params ?>},
            function(data) {
                console.log(data);
                item.id = data.id;
                renderItem(item);
            }
        );
}

function renderItem(item){
    var status = "";
    if(navigator.onLine){
        status = "online";
    }else{
        status = "offline";
    }
    var ihtml = "<?php echo htmlspecialchars($content); ?>";

    $("#results").append(ihtml);
}



function getItems(){
    $.get(API_URL, function(data) {
        items = data.items;
        items.forEach(function(item){
            renderItem(item);
        });
    });
}

//main function to be called on submit
function processData() {
    var item = new Item();
    console.log(item);
    if (navigator.onLine) {
        sendDataToServer(item);
    }else{
        saveDataLocally(item);
    }
}


function saveDataLocally(item) {
    var dataString = JSON.stringify(item);
    var timeStamp = new Date();
    timeStamp.getTime();
    try {
        localStorage.setItem(timeStamp, dataString);
    } catch (e) {

        if (e == QUOTA_EXCEEDED_ERR) {
            console.log('Quota exceeded!');
        }
    }
    var length = window.localStorage.length;
    document.querySelector('#local-count').innerHTML = length;
    renderItem(item);
}


function sendLocalDataToServer() {

    var status = document.querySelector('#status');
    status.className = 'online';
    status.innerHTML = 'Online';

    var i = 0,
        dataString = '';
    while (i <= window.localStorage.length - 1) {
        dataString = localStorage.key(i);
        if (dataString) {
            var json_item = localStorage.getItem(dataString);
            sendDataToServer(JSON.parse(json_item));
            window.localStorage.removeItem(dataString);
        }
        else { i++; }
    }

    document.querySelector('#local-count').innerHTML = window.localStorage.length;
}


function notifyUserIsOffline() {
    var status = document.querySelector('#status');
    status.className = 'offline';
    status.innerHTML = 'Offline';
}

function loaded() {
    var length = window.localStorage.length;
    document.querySelector('#local-count').innerHTML = length;

    if (navigator.onLine) {
        var status = document.querySelector('#status');
        status.className = 'online';
        status.innerHTML = 'Online';
        // getItems();
        if (length !== 0) {
            sendLocalDataToServer();
        }
    }

    window.addEventListener('online', sendLocalDataToServer, false);
    window.addEventListener('offline', notifyUserIsOffline, false);

    document.querySelector('#submit').addEventListener('click', processData, false);
    $( "#datepicker" ).datepicker();
}

window.addEventListener('load', loaded, true);
