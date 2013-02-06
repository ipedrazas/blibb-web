<?php

require_once(__DIR__.'/../system/config.php');

class ShortApplication extends lib {

    public function run() {

        $this->setRedirect();
        $shortid = $this->gt("id");
        if(!empty($shortid)){
            $pos = strpos($shortid,'/go');
            if($pos===0){
                $shortid = substr($shortid, 4);
            }
        }

        $view_mode = $this->gt("v", false);
        $url_api = '/blibb/short/' . $shortid;

        $pest = new Pest(REST_API_URL);
        $jbid = $pest->get($url_api);
        $bid = json_decode($jbid);

        $url_api = '/blibb/object/' . $bid->id . '?fields=n,d,s,u,c,t.v';
        $jb = $pest->get($url_api);
        $bli = json_decode($jb);

        $bid = $bli->id;
        $current_user = current_user();

        // print_r($bli);

        $bname = $bli->name;
        $bdesc = $bli->description;
        $author = $bli->owner;
        $date = $bli->date;

        $btags = array();

        if(isset($bli->tags)){
            $btags = $bli->tags;
        }

        if($view_mode){
            if(isset($bli->template->v->$view_mode)){
                $view = $bli->template->v->$view_mode;
            }else{
                $view = $bli->template->v->default;
            }
        }else{
            $view = $bli->template->v->default;
        }

        $blibbBox = stripcslashes($view->rb);
        $wb = stripcslashes($view->wb);


        $fTags = __DIR__."/templates/taglist.html";
        $cTags = file($fTags);
        $taglist = implode($cTags);

        if($current_user!==0){
            $fComments = __DIR__."/templates/comments.html";
        }else{
            $fComments = __DIR__."/templates/comments-nologin.html";
        }
        $cComments = file($fComments);
        $comments = implode($cComments);


        $blibbBox = str_replace('<blibb:tags/>', $taglist, $blibbBox);
        $blibbBox = str_replace('<blibb:comments/>', $comments, $blibbBox);

        // $css = '<style>' . $view->sb . chr(10) . $view->si . '</style>';
        $css = '';

        $owner = false;

        if($author === $current_user){
            $owner = true;
        }

        $bItems = $pest->get('/blitem/'. $bid .'/items');
        $bItems = str_replace('$oid', "oid", $bItems);
        $its = json_decode($bItems);

        // print_r($bItems);

        $results = $its->count;


        // print_r($its);

        if($results > 0){
            $rs = $its->items;
            $itemsResult =  array();
            foreach ($rs as $eRs) {
                // print_r($eRs);
                $_blitem = array();
                $_blitem['id'] =  $eRs->id;
                $fields = $eRs->fields;

                foreach ($fields as $field) {
                    $f = explode("-", $field);
                    $type = $f[0];
                    $field = $f[1];

                    if($type=='15'){
                        $slug = $field;
                        $obj = $eRs->$field;
                        $value =  $obj->oid;
                        $_blitem[$slug] = $value;
                    }
                    else if($type=='1f'){
                        $slug = $field;
                        $obj = $eRs->$field;
                        $song_id = $obj->id->oid;
                        $value =  $song_id;
                        $_blitem[$field] = $value;
                    }else if($type=='33'){
                        $url = $eRs->$field;
                        if(isset($url->url)){
                            $_blitem['BOOKMARK'] = $url;
                        }else{
                            $tArray['title'] = 'Processing...';
                            $tArray['domain'] = 'Processing...';
                            $_blitem['BOOKMARK'] = $tArray;
                        }
                    }else if ($type=='3d') {
                            if(isset($eRs->$field->name)){
                                $twitter = $eRs->$field;
                                $_blitem[$field] = $twitter->name . '<br>' . $twitter->screen_name . '<br>' . $twitter->description . '<br><img src="' . $twitter->profile_image_url . '"><br>' . $twitter->location;
                            }else{
                                $_blitem[$field] = $eRs->$field;
                            }

                    }else{
                            $_blitem[$field] = $eRs->$field;

                    }
                }
                // print_r($eRs);
                // Comments
                if(isset($eRs->comments)){
                    $_blitem['COMMENTS'] =  $eRs->comments;
                }
                if (isset($eRs->tags)){
                    $_blitem['TAGS'] = $eRs->tags;
                }
                $_blitem['key'] = getKey();
                $itemsResult[] = $_blitem;
            }

            // print_r($itemsResult);

            $blibb['name'] = $bname;
            $blibb['desc'] = $bdesc;
            $blibb['owner'] = $author;
            $blibb['created'] = $date;
            $blibb['ENTRIES'] = $itemsResult;
            $blibb['css'] = $css;
            $blibb['id'] = $bid;
            $blibb['TAGLIST'] = $btags;

            $m = new Mustache();
            // print_r($blibb);
            $content =  $m->render($blibbBox, $blibb);


        }else{
            $content = "There are no blitems yet";
        }


        $view = 'viewBlibb';


        $a11y = $this->gt('a11y');
        if($a11y==1){
            $view='a11y';
        }

        // print_r($this->getMenuBar());
        $title = $bname;


        $this->render($view, compact('content','css', 'owner','bid', 'entries', 'current_user', 'blibb', 'title','wb'));


    }


}

$app = new ShortApplication();
$app->run();

