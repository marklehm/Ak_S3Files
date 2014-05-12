<?php

use Aws\S3\S3Client;

class Ak_S3files_Model_Observer
{

    const XML_PATH_AWS_KEY = "ak_s3files_aws/api/key";
    const XML_PATH_AWS_SECRET = "ak_s3files_aws/api/secret";

    const XML_PATH_AWS_MEDIABUCKET = "ak_s3files_aws/s3/media_bucket";

    public function initStream()
    {
        $key = Mage::getStoreConfig(self::XML_PATH_AWS_KEY);
        $secret = Mage::getStoreConfig(self::XML_PATH_AWS_SECRET);

        // Create an Amazon S3 client object
        $client = S3Client::factory(array(
            'key'    => $key,
            'secret' => $secret
        ));

        // Register the stream wrapper from a client object
        $client->registerStreamWrapper();
    }



    public function setAssetDirectories()
    {

        $mediaBucket = Mage::getStoreConfig(self::XML_PATH_AWS_MEDIABUCKET);


        //set the media dir to an s3 url so that
        if ($mediaBucket) { //@todo && isValidBucket($mediaBucket) && s3StreamRegistered()
            Mage::getConfig()->getOptions()->setMediaDir('s3://'.$mediaBucket);
        }

//        if (true) {
//            Mage::getConfig()->getOptions()->setMediaDir('s3://andrewketttestmagento/media');
//        }

       // Mage::getConfig()->getOptions()->setLogDir('s3://andrewketttestmagento/log');

        //Mage::getConfig()->getOptions()->setExportDir('s3://andrewketttestmagento/media');
//        'app_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/app' (length=73)
//      'base_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html' (length=69)
//      'code_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/app/code' (length=78)
//      'design_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/app/design' (length=80)
//      'etc_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/app/etc' (length=77)
//      'lib_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/lib' (length=73)
//      'locale_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/app/locale' (length=80)
//      'media_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/media' (length=75)
//      'skin_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/skin' (length=74)
//      'var_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/var' (length=73)
//      'tmp_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/var/tmp' (length=77)
//      'cache_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/var/cache' (length=79)
//      'log_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/var/log' (length=77)
//      'session_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/var/session' (length=81)
//      'upload_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/media/upload' (length=82)
//      'export_dir' => string '/Users/andrewkett/Sites/dev/magentodevsites/community_1.8/public_html/var/export' (length=80)
    }


    public function includeOverrides()
    {
        require(realpath(dirname(__FILE__)).'/../lib/Io/File.php');
        require(realpath(dirname(__FILE__)).'/../lib/File/Uploader.php');
    }

}