<?php
namespace Home\Controller;
use Think\Controller;
class DatabackController extends BaseauthController {



 public function index() {
        $DataDir = "databak/";
        mkdir($DataDir);
        if (!empty($_GET['Action'])) {
            $config = array(
                'host' => C('DB_HOST'),
                'port' => C('DB_PORT'),
                'userName' => C('DB_USER'),
                'userPassword' => C('DB_PWD'),
                'dbprefix' => C('DB_PREFIX'),
                'charset' => 'UTF8',
                'path' => $DataDir,
                'isCompress' => 0, //是否开启gzip压缩
                'isDownload' => 0
            );
			$mr =new \OT\MySQLReback($config);
		
            $mr->setDBName(C('DB_NAME'));
            if ($_GET['Action'] == 'backup') {
                $mr->backup();
               $this->redirect('Databack/index');
            } elseif ($_GET['Action'] == 'RL') {
                $mr->recover($_GET['File']);

             $this->redirect('Databack/index');
            } elseif ($_GET['Action'] == 'Del') {
                if (@unlink($DataDir . $_GET['File'])) {
                 $this->redirect('Databack/index');
                } else {
                    $this->error('删除失败！');
                }
            }
            if ($_GET['Action'] == 'download') {

                function DownloadFile($fileName) {
                    ob_end_clean();
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Length: ' . filesize($fileName));
                    header('Content-Disposition: attachment; filename=' . basename($fileName));
                    readfile($fileName);
                }
                DownloadFile($DataDir . $_GET['file']);
                exit();
            }
        }
        $lists = $this->MyScandir('databak/');
        $this->assign("datadir",$DataDir);
        $this->assign("lists", $lists);
			  		$this->main_menu='数据库操作';
        $this->son_menu='备份及还原';	
        $this->display();
    }

    private function MyScandir($FilePath = './', $Order = 0) {
        $FilePath = opendir($FilePath);
        while (false !== ($filename = readdir($FilePath))) {
            $FileAndFolderAyy[] = $filename;
        }
        $Order == 0 ? sort($FileAndFolderAyy) : rsort($FileAndFolderAyy);
        return $FileAndFolderAyy;
    }














}
?>