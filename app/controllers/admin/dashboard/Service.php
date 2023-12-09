<?php
class Service extends Controller {
    private $serviceModel;

    public function __construct() {
        $this->serviceModel = $this->model('ServiceModel', 'admin');
    }

    // Lấy danh sách bài viết 
    public function getListService() {
        $request = new Request();

        if ($request->isGet()): // Kiểm tra get
            
            $result = $this->serviceModel->handleGetListService(); // Gọi xử lý ở Model

            if (!empty($result)):
                $response = $result;
            else:
                $response = [
                    'message' => 'Đã có lỗi xảy ra'
                ];
            endif;

            echo json_encode($response);
        endif;
    }

    

}