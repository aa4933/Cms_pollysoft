<?php
if($_FILES['file_input']){  
    $uploads = UpFilesTOObj($_FILES['file_input']);  
      
    $fileUploader=new FileUploader($uploads);  
}  
  
  
class FileUploader{  
    public function __construct($uploads,$uploadDir='uploads/'){  
        foreach($uploads as $current)  
        {  
            $this->uploadFile=$uploadDir.$current->name.".".get_file_extension($current->name);  
            if($this->upload($current,$this->uploadFile)){  
                echo "Successfully uploaded ".$current->name."\n";  
            }  
        }  
    }  
      
    public function upload($current,$uploadFile){  
        if(move_uploaded_file($current->tmp_name,$uploadFile)){  
        return true;  
        }  
    }  
}  
  
  
  
function UpFilesTOObj($fileArr){  
    foreach($fileArr['name'] as $keyee => $info)  
    {  
        $uploads[$keyee]->name=$fileArr['name'][$keyee];  
        $uploads[$keyee]->type=$fileArr['type'][$keyee];  
        $uploads[$keyee]->tmp_name=$fileArr['tmp_name'][$keyee];  
        $uploads[$keyee]->error=$fileArr['error'][$keyee];  
    }  
    return $uploads;  
}  
  
  
function get_file_extension($file_name)  
{  
  return substr(strrchr($file_name,'.'),1);  
}  