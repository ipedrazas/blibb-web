<?php

require_once(__DIR__.'/../../system/config.php');


/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }
}

class qqFileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        // if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
        //     $size = max(1, $this->sizeLimit / (1024 * 1024)) . 'M';             
        //     die("{'error':'current size: $this->sizeLimit increase post_max_size and upload_max_filesize to $size - pot: $postSize  - upload: $uploadSize'}");    
        // }        
    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE, $filename){
        // Check if the dir exists, if not, create it
        
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory ".$uploadDirectory." isn't writable.");
        }
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        // $filename = $pathinfo['filename'];
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        $filepath = $uploadDirectory . $filename . '.' . $ext;
        
        if ($this->file->save($filepath)){
            $data =  analyzeImage($filepath);
            $data['file'] = $pathinfo['filename'] . '.' . $ext;
            $data['path'] = $uploadDirectory;
            // Thumbnail Generation
            // $image = new SimpleImage();
            // $image->load($filepath);
            // $image->resizeToWidth(260);
            // $image->save($thumbpath);
            $imageName = $filename . '.' . strtolower($ext);
            $thumbnails = array();
            $thumbnails[] = '60';
            $thumbnails[] = '160';
            $thumbnails[] = '220';
            $thumbnails[] = '260';

            $image = new SimpleImage();
            $image->load($filepath);

            // $this->thumbnail_box($image, $uploadDirectory, $uploadDirectory . '260/',  $imageName);
            // $this->thumbnail_box($image, $uploadDirectory, $uploadDirectory . '220/',  $imageName);
            // $this->thumbnail_box($image, $uploadDirectory, $uploadDirectory . '160/',  $imageName);
            // $this->thumbnail_box($image, $uploadDirectory, $uploadDirectory . '60/',  $imageName);
            

            $this->resizeImage($image, '260', $uploadDirectory, $imageName);
            $this->resizeImage($image, '220', $uploadDirectory, $imageName);
            $this->resizeImage($image, '160', $uploadDirectory, $imageName);
            //$this->thumbnail_box($image, $uploadDirectory, $imageName);
            $this->resizeImage($image, '60', $uploadDirectory, $imageName);
            
            
            
            $data['thumb'] = $thumbnails;

            return $data;
        } else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
        
    }

     function thumbnail_box($image, $path, $imagename){
        $img = imagecreatefromjpeg($path . '260/'. $imagename);
        $thumbnail = $image->thumbnail_box($img,160,120);
        imagedestroy($img);
         $imagePath = $path . '160x120/';
        if (!is_dir($imagePath)) {
            mkdir($imagePath ,0755,true);
        }
        imagejpeg( $thumbnail, $imagePath. $imagename);
    }

    function resizeImage($image, $size, $path, $imagename){
        $imagePath = $path . $size . '/';
        if (!is_dir($imagePath)) {
            mkdir($imagePath ,0755,true);
        }

        // if($size==160){
        //     $image->resize($size, 120);
        // }else{
        //     $image->resizeToWidth($size);    
        // }
        $image->resizeToWidth($size);
        
        $image->save($imagePath . $imagename);
    }

    
}

// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array();
// max file size in bytes
$sizeLimit = 10 * 1024 * 1024 * 1024;


$key = $_GET['k'];
$b = $_GET['bid'];
$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

if (strlen($b)<1){
    $b = '101'; 
}

$pest = new Pest(REST_API_URL);
$imgId = $pest->post('/picture',array(
            'b' => $b,
            'k' => $key
        ));

//echo __DIR__.'/../../uploads/images/';

if(strlen($imgId)>0){

    $result['i'] = $uploader->handleUpload(UPLOAD_DIR.'/images/', true, $imgId);
    $result['b'] = $b;
    $result['u'] = current_user();
    $result['id'] = $imgId;

    // to pass data through iframe you will need to encode all html tags
    $jsonData =  htmlspecialchars(json_encode($result), ENT_NOQUOTES);

    $img = $pest->post('/picture/data',array(
                'p' => $jsonData
            ));

    echo $img;    
}else{
     die("{'error':'Image could not be uploaded'}");    
}

