<?php
class Ext_Image
{

    protected $_filename = null;

    function __construct($filename)
    {
        $this->_filename = $filename;
    }

    /**
     * 获取图片宽度
     */
    function getImageWidth()
    {
        try
        {
            $image = new Imagick($this->_filename);
            $width = $image->getImageWidth();
            $image->clear();
            $image->destroy();
            return $width;
        }
        catch(Exception $e)
        {
            return 0;
        }
    }

    /**
     * 获取图片高度
     */
    function getImageHeight()
    {
        try
        {
            $image = new Imagick($this->_filename);
            $height = $image->getImageHeight();
            $image->clear();
            $image->destroy();
            return $height;
        }
        catch(Exception $e)
        {
            return 0;
        }
    }

    /**
     * 转换图片为JPEG格式
     */
    function convertToJPEG($destname,$quality)
    {
        try
        {
            $image=new Imagick($this->_filename);
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($quality);
            
            $bg= new Imagick();
            $bg->newImage($image->getImageWidth(),$image->getImageHeight(),'white');
            $bg->setImageCompression(Imagick::COMPRESSION_JPEG);
            $bg->setImageCompressionQuality($quality);
            $bg->compositeImage($image, Imagick::COMPOSITE_OVER, 0, 0);
            $bg->setImageFormat("jpg");
            $bg->writeImage($destname);
            $image->clear();
            $image->destroy();
            $bg->clear();
            $bg->destroy();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
    /*
     * 缩放，自动裁剪图片，不变形
     */
    function cropThumbnailImage($destname,$width,$height,$quality)
    {
        try
        {
            $image=new Imagick($this->_filename);
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($quality);
            $image->cropThumbnailImage($width,$height);
            
            $bg= new Imagick();
            $bg->newImage($width,$height,'white');
            $bg->setImageCompression(Imagick::COMPRESSION_JPEG);
            $bg->setImageCompressionQuality($quality);
            $bg->compositeImage($image, Imagick::COMPOSITE_OVER, 0, 0);
            $bg->setImageFormat("jpg");
            $bg->writeImage($destname);

            $image->clear();
            $image->destroy();
            $bg->clear();
            $bg->destroy();
            return true;
        }
        catch(Exception $e)
        {
            return false;  
        }
    }

    /*
     * 缩放图片，不裁剪，可能变形
     */
    function thumbnailImage($destname,$size,$quality)
    {
        try
        {
            $image=new Imagick($this->_filename);
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($quality);
            $image->thumbnailImage($size,$size);

            $bg= new Imagick();
            $bg->newImage($size,$size,'white');
            $bg->setImageCompression(Imagick::COMPRESSION_JPEG);
            $bg->setImageCompressionQuality($quality);
            $bg->compositeImage($image, Imagick::COMPOSITE_OVER, 0, 0);
            $bg->setImageFormat("jpg");
            $bg->writeImage($destname);

            $image->clear();
            $image->destroy();
            $bg->clear();
            $bg->destroy();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
    function thumbnailImageWithBlank($destname, $size, $quality)//店铺、品牌，小图，补白
    {
        try
        {
            $im = new Imagick($this->_filename);
            $im->setImageCompression(Imagick::COMPRESSION_JPEG);
            $im->setImageCompressionQuality($quality);
            $width = $im->getImageWidth();
            $height = $im->getImageHeight();
            $length = $width > $height ? $width : $height;
            $startWidth = 0;
            $startHeight = 0;
            if($width > $height)
            {
                $startHeight = ($width - $height) / 2;
            }
            else
            {
                $startWidth = ($height - $width) / 2;
            }

            $bg = new Imagick();
            $bg->newImage($length, $length, 'white');
            $bg->setImageCompression(Imagick::COMPRESSION_JPEG);
            $bg->setImageCompressionQuality($quality);
            if($width > $height)
            {
                $bg->compositeImage($im, Imagick::COMPOSITE_OVER, 0, $startHeight);
            }
            else
            {
                $bg->compositeImage($im, Imagick::COMPOSITE_OVER, $startWidth, 0);
            }
            $bg->thumbnailImage($size, $size);
            $bg->setImageFormat("jpg");
            $bg->writeImage($destname);

            $im->clear();
            $im->destroy();
            $bg->clear();
            $bg->destroy();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
      /**
     * 截取用户上传头像，大图
     */
    function cropUserImage($destname,$quality)
    {
        try
        {
            $image=new Imagick($this->_filename);
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($quality);
            $width=$image->getImageWidth();
            $height=$image->getImageHeight();

            if($width<$height)
            {
                if($width>200)
                {
                    $image->ThumbnailImage(200,0);
                }
            }
            else
            {
                if($height>200)
                {
                    $image->ThumbnailImage(0,200);
                }
            }

            $bg= new Imagick();
            $bg->newImage($image->getImageWidth(),$image->getImageHeight(),'white');
            $bg->setImageCompression(Imagick::COMPRESSION_JPEG);
            $bg->setImageCompressionQuality($quality);
            $bg->compositeImage($image, Imagick::COMPOSITE_OVER, 0, 0);
            $bg->setImageFormat("jpg");
            $bg->writeImage($destname);
            $size['width']=$bg->getImageWidth();
            $size['height']=$bg->getImageHeight();

            $image->clear();
            $image->destroy();
            $bg->clear();
            $bg->destroy();
            return $size;
        }
        catch(Exception $e)
        {
            return false;
        }
    }

   /**
     * 从大图截取用户icon
     */
    function cropUserIcon($destname,$quality,$size,$width,$height,$x1,$y1)
    {
        try
        {
            $image=new Imagick($this->_filename);
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($quality);
            $image->cropImage($width,$height,$x1,$y1);
            $image->thumbnailImage($size,$size);
            $image->setImageFormat( "jpg" );
            $image->writeImage($destname);
            $image->clear();
            $image->destroy();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
   /**
     * 定宽裁剪图片
     * $destname 目标文件路径
     * 
     */
    function thumbnailImageFixWidth($destname,$width,$quality)
    {
        try
        {
            $image=new Imagick($this->_filename);
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($quality);
            if($image->getImageWidth()>$width)
            {
                $image->thumbnailImage($width,0);
            }

            $width=$image->getImageWidth();
            $height=$image->getImageHeight();

            $bg= new Imagick();
            $bg->newImage($width,$height,'white');
            $bg->setImageCompression(Imagick::COMPRESSION_JPEG);
            $bg->setImageCompressionQuality($quality);
            $bg->compositeImage($image, Imagick::COMPOSITE_OVER, 0, 0);
            $bg->setImageFormat("jpg");
            $bg->writeImage($destname);

            $image->clear();
            $image->destroy();
            $bg->clear();
            $bg->destroy();
            return $height;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}

?>
