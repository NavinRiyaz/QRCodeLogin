<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    // 登录页
    public function index(){
        $_SESSION["username"] = "test";
        echo "username = ".$_SESSION["username"];
        $this->display(T('login'));
    }
    
//    public function test(){
////        $this->qrcode();
//        $_SESSION['deviceUUID'] = "ABCDESDASDEFSDSDA";
//        
//    }
//    
//    
    public function write() {
        $count = 0;
        while(1) {
            echo "a";
            $count++;
            if (count > 10) {
                break;
            }
            usleep(1000);
        }
    }
    
//    // 设备获取验证 (如果获取到)
//    public function deviceCheck() {
//        if (I("post.deviceUUID")) {
//            $_SESSION['deviceUUID'] = I("post.deviceUUID");
//            $result['code'] = TRUE;
//            echo $result;
//        }else {
//            $result['code'] = FALSE;
//            echo $result;
//        }
//    }
    
    // 移动端确认登录
    public function deviceLogin() {
        $sid = I("post.sessionId");
        $result;
        if ($sid) {
            // 先销毁当前 session
            session('[destroy]');
            // 再获取 sessionId 对应的 session
            Session_id($sid);
            Session_start();
            // 设置登录状态(只要 deviceUUID 字段的值存在则视为已经登录)
            $_SESSION['deviceUUID'] = "ABCDESDASDEFSDSDA";
            $result["code"] = 1;
            $result["username"] = $_SESSION["username"];
//            session_write_close();
        }else {
            $result["code"] = 0;
        }
        echo json_encode($result);
    }
    
    // web 前端 ajax 请求确认登录状态方法
    public function login(){
        // 设置脚本超时时间为无限, 不然在超过了时间后, 脚本会自动关闭
//            set_time_limit(30);
        // 进入无限循环
//            while (TRUE) {
//                Session_start();
                if (isset($_SESSION['deviceUUID'])) {
                    echo $_SESSION['deviceUUID'];
//                    break;  // 输出信息后退出 while 循环, 结束当前脚本
                }
                else {
                    echo "no";
//                    break;
                }
//            //  每次循环完都等待1秒, 防止 PHP 因死循环假死
//                session_write_close();
//                usleep(1000);
//            }
        unset($_SESSION['deviceUUID']);
    }
    
    public function qrcode(){
        $message = session_id();
        if ($message) {
            // 引入第三方库文件
            // 真实路径为(Vendor/Phpqrcode/phpqrcode.php)
            Vendor('Phpqrcode.phpqrcode');
            \QRcode::png($message, false, QR_ECLEVEL_L, 4, 2, false, 0xFFFFFF, 0x000000);
        }else {
            echo "error";
        }
    }
}
