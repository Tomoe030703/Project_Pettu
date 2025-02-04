<?php
class ServiceModel extends Model {
    public function tableFill()
    {
        return '';
    }

    public function fieldFill()
    {
        return '';
    }

    public function primaryKey()
    {
        return '';
    }

    // Lấy thông tin chi tiết của dịch vụ
    public function handleGetDetail() {
        $queryGet = $this->db->table('services')
            ->select('services.*, staff_position.name as staff_position_name')
            ->join('staff_position', 'staff_position.position_id = services.teamid')
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)):
            foreach ($queryGet as $key => $item):
                foreach ($item as $subKey => $subItem):
                    if ($subItem === NULL || empty($subItem)):
                        $checkNull = true;
                    endif;
                endforeach;
            endforeach;
        else:
            $response = [
                'message' => 'Chưa có dịch vụ'
            ];
            $checkNull = true;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;

        return $response;
    }

     // Xử lý lấy thời gian làm việc
     public function handleGetTimeWorking($timeWorkingId) {
        $queryGet = $this->db->table('timeworking')
            ->where('id', '=', $timeWorkingId)
            ->first();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)):
            foreach ($queryGet as $key => $item):
                if ($item === NULL || $item === ''):
                    $checkNull = true;
                endif;
            endforeach;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;

        return $response;
    }

    // Lấy thông tin chi tiết của dịch vụ
    public function handleGetListService() {
        $queryGet = $this->db->table('services')
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)):
            foreach ($queryGet as $key => $item):
                foreach ($item as $subKey => $subItem):
                    if ($subItem === NULL || $subItem === ''):
                        if ($subKey !== 'update_at'):
                            $checkNull = true;
                        endif;
                    endif;
                endforeach;
            endforeach;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;

        return $response;
    }

    // Xử lý thêm dịch vụ
    public function handleAddService($data) {
        $dataInsert = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'icon' => $data['icon'],
            'descr' => $_POST['descr'],
            'content' => $_POST['content'],
            'cost' => $data['cost'],
            'teamid' => $data['teamid'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $insertStatus = $this->db->table('services')
            ->insert($dataInsert);

        if ($insertStatus):
            return true;
        endif;

        return false;
    }

    // Xử lý xoá dịch vụ
    public function handleDeleteService($serviceId) {
        $checkEmpty = $this->db->table('services')
            ->select('id')
            ->where('id', '=', $serviceId)
            ->first();

        if (!empty($checkEmpty)):
            $deleteStatus =  $this->db->table('services')
                ->where('id', '=', $serviceId)
                ->delete();

            if ($deleteStatus):
                return true;
            endif;
        endif;

        return false;
    }

    // Xử lý sửa dịch vụ
    public function handleUpdateService($data, $serviceId) {
        $checkEmpty = $this->db->table('services')
            ->select('id')
            ->where('id', '=', $serviceId)
            ->first();

        if (!empty($checkEmpty)):
            $dataUpdate = [
                'name' => $data['name'],
                'slug' => $data['slug'],
                'icon' => $data['icon'],
                'descr' => $_POST['descr'],
                'content' => $_POST['content'],
                'cost' => $data['cost'],
                'teamid' => $data['teamid'],
                'update_at' => date('Y-m-d H:i:s'),
            ];
    
            $updateStatus = $this->db->table('services')
                ->where('id', '=', $serviceId)
                ->update($dataUpdate);
    
            if ($updateStatus):
                return true;
            endif;
        endif;
        
        return false;
    }
    
}