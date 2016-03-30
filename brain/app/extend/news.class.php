<?php
    //Banner扩展类     edited by wangzb
    class Extend_News{
        /*
         * 保存banner
         * @param type $fileHash string 文件hash
         * @param type $element string  文件对象
         * @param type $message string 错误提示信息
         */
        public function saveNewsImage($fileHash, $element, &$message) {
            $uploader = new Ext_Uploader();  //self::$_files[$field_name] = new Ext_Uploader_File($postinfo, $field_name);         
            //验证$_FLES['bannerImage']是否存在
            if (!$uploader->existsFile($element)) {
                $message = '上传图片失败';
                return FALSE;
            }
            
            //对文件类型进行绝对验证
            $file = $uploader->file($element);
            //此验证方法从图片二进制下手，即使修改文件扩展名也能正确验证
            if (!$file->isValid("jpg,jpeg,png,gif,bmp")) {
                $message = '上传图片的类型不在允许范围';
                return FALSE;
            }  
            //使用图像处理类对图片进行处理，验证
            $image = new Ext_Image($file->filepath());
            $width = $image->getImageWidth();
            $height = $image->getImageHeight();
            //图片尺寸验证
            if ($width == 0 || $height == 0) {
                $message = '非图片文件，或图片文件损坏';
                return FALSE;
            }

            if ($width < 10 || $height < 10) {
                $message = '图片尺寸太小，允许最小尺寸为180×180像素';
                return FALSE;
            }

            if ($width > 8000 || $height > 8000) {
                $message = '图片尺寸超过限制，允许最大尺寸为8000×8000像素';
                return FALSE;
            }
            $imgDir = C('img_dir');
            $dir_original = $imgDir . "/news/original/" ;
            $dir_width_200 = $imgDir . "/news/width_200/";
            Ext_Filesys::mkdirs($dir_original);
            Ext_Filesys::mkdirs($dir_width_200);
            $path_original = $dir_original . '/' . $fileHash . ".jpg";
            $path_width_200 = $dir_width_200 . '/' . $fileHash . ".jpg";
            //文件格式处理
            if (!$image->convertToJPEG($path_original, 100)) {
                $message = "图片处理出现异常";
                return FALSE;
            }
            if ($width > 200) {
                if (!$image->thumbnailImageFixWidth($path_width_200, 200, 100)) {
                    $message = "图片处理出现异常";
                    return FALSE;
                }
            } else {
                if (!$image->convertToJPEG($path_width_200, 100)) {
                    $message = "图片处理出现异常";
                    return FALSE;
                }
            }

            return TRUE;
        }
        
        
        
        public function getList($option){
            $sql = 'select id,title,update_time from news where status="'.$option['status'].'" order by '.$option['orderby'].' limit '.$option['offset'].','.$option['limit'];
            $newsList = importModel('News')->query($sql)->findAll();
            if(!$newsList){
                return null;
            }else{
                return $this->formatList($newsList);
            }
        }
        
        public function formatList($newsList){
            foreach ($newsList as &$newsInfo){
                $newsInfo['update_time'] = date('Y-m-d H:i:s',$newsInfo['update_time']);
            }
            return $newsList;
        }
        
        public function getInfo($id){
            $newsInfo = importModel('News')->getBy(array('id'=>$id));
            if(!$newsInfo){
                return null;
            }else{
                return $this->formatInfo($newsInfo);
            }
        }
        
        public function formatInfo($newsInfo){
            $hashArr = explode(',', $newsInfo['hash']);
            unset($newsInfo['hash']);
            foreach($hashArr as $hash){
                $newsInfo['src'][] = "http://".C('img_host')."/news/width_200/".$hash.".jpg";
            }
            return $newsInfo;
        }
        
    }